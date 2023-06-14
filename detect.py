import sys
import os
from yolov5.segment import predict 

root_dir= ''
target_file_dir = ''
file_name = ''
def detect(path_main_file):
  global target_file_dir
  runPredict = "python yolov5/segment/predict.py --weights best.pt --img 416 --conf 0.25 --source "+ path_main_file +" --save-txt"
  result = os.system(runPredict)
  if result == 0:
    return True
  return False


import cv2
import numpy as np
def read_image_label(path_to_img: str, path_to_txt: str):
    # read image
    image = cv2.imread(path_to_img)
    image = cv2.cvtColor(image, cv2.COLOR_BGR2RGB)
    img_h, img_w = image.shape[:2]

    cls_obj = []
    obj_cnvrt_obj = []
    with open(path_to_txt, "r") as k:
      for x in k.readlines():
        info = x.split()
        cls_obj.append(info[0])
        obj_coords = info[1:]
        obj_cnvrt_obj.append((np.array([[eval(x), eval(y)] for x, y in zip(obj_coords[0::2], obj_coords[1::2])])).astype(np.float))
        #datas.append(x[2:-2])  

    for x in range(0,len(obj_cnvrt_obj)):
      obj_cnvrt_obj[x][:,0] = obj_cnvrt_obj[x][:,0]*img_w
      obj_cnvrt_obj[x][:,1] = obj_cnvrt_obj[x][:,1]*img_h
    return image, obj_cnvrt_obj

from sklearn.cluster import KMeans
def cropImg(listCoors : np.ndarray, path_main_file: str, ind : int):
  # original image
  # -1 loads as-is so if it will be 3 or 4 channel as the original
  image = cv2.imread(path_main_file, -1)
  # mask defaulting to black for 3-channel and transparent for 4-channel
  # (of course replace corners with yours)
  #mask = np.zeros(image.shape, dtype=np.uint8)
  mask = np.zeros(image.shape, dtype=np.uint8)
  roi_corners = np.array([listCoors], dtype=np.int32)
  
  # fill the ROI so it doesn't get wiped out when the mask is applied
  channel_count = image.shape[2]  # i.e. 3 or 4 depending on your image
  ignore_mask_color = (255,)*channel_count
  cv2.fillPoly(mask, roi_corners, ignore_mask_color)
  # from Masterfool: use cv2.fillConvexPoly if you know it's convex

  # apply the mask
  masked_image = cv2.bitwise_and(image, mask)

  tmp = cv2.cvtColor(masked_image, cv2.COLOR_BGR2GRAY)
  _, alpha = cv2.threshold(tmp, 0, 255, cv2.THRESH_BINARY)
  b, g, r = cv2.split(masked_image)
  rgba = [b, g, r, alpha]
  # Applying thresholding technique
  dst = cv2.merge(rgba, 4)
  # Writing and saving to a new image
  cv2.imwrite(root_dir+str(ind)+"gfg_white.png", dst)
  return dst
# END cropImg

def visualize_colors(cluster, centroids):
    # Get the number of different clusters, create histogram, and normalize
    labels = np.arange(0, len(np.unique(cluster.labels_)) + 1)
    (hist, _) = np.histogram(cluster.labels_, bins = labels)
    hist = hist.astype("float")
    hist /= hist.sum()

    # Create frequency rect and iterate through each cluster's color and percentage
    rect = np.zeros((50, 300, 3), dtype=np.uint8)
    colors = sorted([(percent, color) for (percent, color) in zip(hist, centroids)])
    start = 0

    domColors = []
    # len(colors)-1 olmalı
    for (percent, color) in colors[0:len(colors)]:
        domColors.append([color, "{:0.2f}%".format(percent*100)])
        #print(color, "{:0.2f}%".format(percent * 100))
        end = start + (percent * 300)
        cv2.rectangle(rect, (int(start), 0), (int(end), 50), \
                      color.astype("uint8").tolist(), -1)
        start = end

    return domColors

import shutil
# MAIN
lenOfSysArgv = len(sys.argv)
if lenOfSysArgv > 1:
   # sys.argv param: ["uploads\/97cad3990da070da0b45424e15bdbddaac41b104\/376a25cagfg_white.png","uploads\/97cad3990da070da0b45424e15bdbddaac41b104\/a4e1efedtest2.jpg"]
   path_main_files = sys.argv[1][1:-1].replace('\\', '').replace('"', '').split(',')
   root_dir = path_main_files[0][:49]
   #path_main_files = ["yolov5/test2.jpg"]
   for path_main_file in path_main_files:
    file_name = path_main_file.split('/')[2]
    # file_name = "test2.jpg"
    status = detect(path_main_file) 
    if status == False:
      print("failed")
      sys.exit()
   
   # path_to_text : uploads/97cad3990da070da0b45424e15bdbddaac41b104/376a25cagfg_white.png
   path_to_img = path_main_files[0]
   path_to_text = path_main_files[0][:49]+'labels/'+file_name.split('.')[0]+".txt"
   res = read_image_label(path_main_files[0], path_to_text)[1]
   
   for q in range(0, len(res)):
    cropImg(res[q], path_main_files[0], q)

   resultColors = []
   for i in range(0, len(res)):
    # Load image and convert to a list of pixels
    path= root_dir+"0gfg_white.png"
    #path = "yolov5/runs/predict-seg/exp/gfg_white.png"
    image = cv2.imread(path)
    image = cv2.cvtColor(image, cv2.COLOR_BGR2RGB)
    reshape = image.reshape((image.shape[0] * image.shape[1], 3))

    # Find and display most dominant colors
   cluster = KMeans(n_clusters=4).fit(reshape)
   visualize = visualize_colors(cluster, cluster.cluster_centers_)
   resultColors.append(visualize[0:3])
   #visualize = cv2.cvtColor(visualize, cv2.COLOR_RGB2BGR)

   ''' 
   for q in resultColors:
    print(q)
   '''
   print(resultColors)
   shutil.rmtree("yolov5/runs/predict-seg/exp") 
   #shutil.rmtree(target_file_dir)

