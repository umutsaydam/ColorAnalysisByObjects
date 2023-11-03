import cv2
import os
from random import randint

def convertVideo2Frames(root_dir, file_name):
    vidcap = cv2.VideoCapture(root_dir+file_name)
    success,image = vidcap.read()
    frames_file_name = []
    count = 0
    while success:
        frame_name = "frame"+str(randint(1, 100))+"%d.jpg" % count
        cv2.imwrite(root_dir+frame_name, image) # save frame as JPEG file
        vidcap.set(cv2.CAP_PROP_POS_MSEC,(count*1000))
        success,image = vidcap.read()
        count += 1
        frames_file_name.append(root_dir+frame_name)
    return frames_file_name
    
def deleteSource(root_dir, file_name):
    os.remove(root_dir+file_name)

