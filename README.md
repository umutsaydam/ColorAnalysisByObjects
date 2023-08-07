# Color Analysis By Objects

<h3><a href="#user-content-amac">TR</a></h3>
<h3><a href="#user-content-aim">EN</a></h3>

<h2 id="user-content-amac">Amaç</h2>
Bu proje ile obje bazında en çok kullanılan üç rengin belirlenerek veri tabanına kaydedilmesi ve böylece dönemlere göre insanların tercih ettiği renk alışkanlıklarının ortaya çıkarılması amaçlanmaktadır.

### 🦶 Gerçekleştirilen-adımlar
 **1. Makineyi, kategorileştirilmiş veriler ile eğitmek**
  - Kategorilerine göre (giyim vs.) sınıflandırılmış verileri ayrı ayrı eğiterek nesneyi doğru tespit etme oranı artırıldı.
 
 **2. Instance segmentation Region of interest**
  - Instance segmentation ile ilgili nesnenin tam konumlarını tespit edip, Region of interest algoritmasıyla tespit edilen nesnenin koordinatlarına göre kırpılması sağlandı.
    
   ![stages_of_detection](https://github.com/umutsaydam/ColorAnalysisByObjects/assets/69711134/60ff8e88-36d8-434e-ae1a-78483b36ac3c)
 
 **3. Ortalama renk analizi ve Kmeans**
  - Kırpılmış nesneler üzerinde ağırlıklı olarak bulunan üç renk tespit edilerek verilerin kategoriye göre depolanması.

    ![result_of_detection](https://github.com/umutsaydam/ColorAnalysisByObjects/assets/69711134/8f1f31e4-d540-4ce1-b9fa-ff1d37563469)
 
 **4. Depolanan veriler doğrultusunda kullanıcıların kategoriye ve zamana göre renk alışkanlıklarının tespiti**
  - Toplanan veriler sayesinde network grafiği ile kategorilere göre renk alışkanlıklarının tespiti.

   ![graph](https://github.com/umutsaydam/ColorAnalysisByObjects/assets/69711134/b0238a8c-3272-42ae-843c-02f76c5ce96c)
    
  ![statistics](https://github.com/umutsaydam/ColorAnalysisByObjects/assets/69711134/f32f23d7-b7fc-4122-817f-da45c5ba73fc)


    
**5. Kurulum**
- requirements.txt içerisindekiler kurulmalı.
  ```
  pip install -r FILE_PATH/requirements.txt
  ```


***

<h2 id="user-content-aim">Aim</h2>
With this project, it is aimed to determine the three most used colors on the basis of objects and to save them in the database, thus revealing the color habits preferred by people according to the periods.



### 🦶 Steps-Taken
 **1. Makineyi, kategorileştirilmiş veriler ile eğitmek**
  - Kategorilerine göre (giyim vs.) sınıflandırılmış verileri ayrı ayrı eğiterek nesneyi doğru tespit etme oranı artırıldı.
 
 **2. Instance segmentation Region of interest**
  - Instance segmentation ile ilgili nesnenin tam konumlarını tespit edip, Region of interest algoritmasıyla tespit edilen nesnenin koordinatlarına göre kırpılması sağlandı.
    
   ![stages_of_detection](https://github.com/umutsaydam/ColorAnalysisByObjects/assets/69711134/60ff8e88-36d8-434e-ae1a-78483b36ac3c)
 
 **3. Ortalama renk analizi ve Kmeans**
  - Kırpılmış nesneler üzerinde ağırlıklı olarak bulunan üç renk tespit edilerek verilerin kategoriye gmre depolanması.

    ![result_of_detection](https://github.com/umutsaydam/ColorAnalysisByObjects/assets/69711134/8f1f31e4-d540-4ce1-b9fa-ff1d37563469)
 
 **4. Depolanan veriler doğrultusunda kullanıcıların kategoriye ve zamana göre renk alışkanlıklarının tespiti**
  - Toplanan veriler sayesinde network grafiği ile kategorilere göre renk alışkanlıklarının tespiti.
    
   ![graph](https://github.com/umutsaydam/ColorAnalysisByObjects/assets/69711134/b0238a8c-3272-42ae-843c-02f76c5ce96c)
    
  ![statistics](https://github.com/umutsaydam/ColorAnalysisByObjects/assets/69711134/f32f23d7-b7fc-4122-817f-da45c5ba73fc)


**5. Installation**
- requirements.txt contents must be installed.
  ```
  pip install -r FILE_PATH/requirements.txt
  ```
