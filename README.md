# Color Analysis By Objects
<h2 id="user-content-amac">Amaç</h2>
Bu proje ile obje bazında en çok kullanılan üç rengin belirlenerek veri tabanına kaydedilmesi ve böylece dönemlere göre insanların tercih ettiği renk alışkanlıklarının ortaya çıkarılması amaçlanmaktadır.

### ![steps](https://github.com/umutsaydam/ColorAnalysisByObjects/assets/69711134/bb363b72-ac7b-49a7-a0b7-fbb9303d9a70) Gerçekleştirilen-adımlar
 **1. Makineyi, kategorileştirilmiş veriler ile eğitmek**
  - Kategorilerine göre (giyim vs.) sınıflandırılmış verileri ayrı ayrı eğiterek nesneyi doğru tespit etme oranı artırıldı.
 
 **2. Instance segmentation Region of interest**
  - Instance segmentation ile ilgili nesnenin tam konumlarını tespit edip, Region of interest algoritmasıyla tespit edilen nesnenin koordinatlarına göre kırpılması sağlandı.
    
   ![stagesOfDetection](https://github.com/umutsaydam/ColorAnalysisByObjects/assets/69711134/3cb435b7-badd-47eb-a50c-233eae96ea04)
 
 **3. Ortalama renk analizi ve Kmeans**
  - Kırpılmış nesneler üzerinde ağırlıklı olarak bulunan üç renk tespit edilerek verilerin kategoriye gmre depolanması.

    ![renkTespitSonucu](https://github.com/umutsaydam/ColorAnalysisByObjects/assets/69711134/ba5508aa-6b27-4fac-861e-e7c21e153331)
 
 **4. Depolanan veriler doğrultusunda kullanıcıların kategoriye ve zamana göre renk alışkanlıklarının tespiti**
  - Toplanan veriler sayesinde network grafiği ile kategorilere göre renk alışkanlıklarının tespiti.
    
    ![istatistikGraf](https://github.com/umutsaydam/ColorAnalysisByObjects/assets/69711134/6cfc64ad-3809-431a-8b37-e07dc7826df8)
    
    ![istatistikYazi](https://github.com/umutsaydam/ColorAnalysisByObjects/assets/69711134/091597ee-8d0f-446a-abaf-8b4b0056ea98)

    
**5. Kurulum**
- requirements.txt içerisindekiler kurulmalı.
  ```
  pip install -r FILE_PATH/requirements.txt
  ```


***

<h2 id="user-content-aim">Aim</h2>
With this project, it is aimed to determine the three most used colors on the basis of objects and to save them in the database, thus revealing the color habits preferred by people according to the periods.



### ![steps](https://github.com/umutsaydam/ColorAnalysisByObjects/assets/69711134/bb363b72-ac7b-49a7-a0b7-fbb9303d9a70) Steps-Taken
 **1. Makineyi, kategorileştirilmiş veriler ile eğitmek**
  - Kategorilerine göre (giyim vs.) sınıflandırılmış verileri ayrı ayrı eğiterek nesneyi doğru tespit etme oranı artırıldı.
 
 **2. Instance segmentation Region of interest**
  - Instance segmentation ile ilgili nesnenin tam konumlarını tespit edip, Region of interest algoritmasıyla tespit edilen nesnenin koordinatlarına göre kırpılması sağlandı.
    
   ![stagesOfDetection](https://github.com/umutsaydam/ColorAnalysisByObjects/assets/69711134/3cb435b7-badd-47eb-a50c-233eae96ea04)
 
 **3. Ortalama renk analizi ve Kmeans**
  - Kırpılmış nesneler üzerinde ağırlıklı olarak bulunan üç renk tespit edilerek verilerin kategoriye gmre depolanması.

    ![renkTespitSonucu](https://github.com/umutsaydam/ColorAnalysisByObjects/assets/69711134/ba5508aa-6b27-4fac-861e-e7c21e153331)
 
 **4. Depolanan veriler doğrultusunda kullanıcıların kategoriye ve zamana göre renk alışkanlıklarının tespiti**
  - Toplanan veriler sayesinde network grafiği ile kategorilere göre renk alışkanlıklarının tespiti.
    
    ![istatistikGraf](https://github.com/umutsaydam/ColorAnalysisByObjects/assets/69711134/6cfc64ad-3809-431a-8b37-e07dc7826df8)
    
    ![istatistikYazi](https://github.com/umutsaydam/ColorAnalysisByObjects/assets/69711134/091597ee-8d0f-446a-abaf-8b4b0056ea98)


    **5. Installation**
- requirements.txt contents must be installed.
  ```
  pip install -r FILE_PATH/requirements.txt
  ```
