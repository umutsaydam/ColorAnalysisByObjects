# Color Analysis By Objects

<a href="#Amaç">
<img src="https://private-user-images.githubusercontent.com/69711134/251746733-ee1c10f3-2ad3-492b-b4a5-f4a32b85d37b.png?jwt=eyJhbGciOiJIUzI1NiIsInR5cCI6IkpXVCJ9.eyJrZXkiOiJrZXkxIiwiZXhwIjoxNjg4NzM4NjM0LCJuYmYiOjE2ODg3MzgzMzQsInBhdGgiOiIvNjk3MTExMzQvMjUxNzQ2NzMzLWVlMWMxMGYzLTJhZDMtNDkyYi1iNGE1LWY0YTMyYjg1ZDM3Yi5wbmc_WC1BbXotQWxnb3JpdGhtPUFXUzQtSE1BQy1TSEEyNTYmWC1BbXotQ3JlZGVudGlhbD1BS0lBSVdOSllBWDRDU1ZFSDUzQSUyRjIwMjMwNzA3JTJGdXMtZWFzdC0xJTJGczMlMkZhd3M0X3JlcXVlc3QmWC1BbXotRGF0ZT0yMDIzMDcwN1QxMzU4NTRaJlgtQW16LUV4cGlyZXM9MzAwJlgtQW16LVNpZ25hdHVyZT05NDRiNTIzN2EzZjEwMWI2NjY0NTQ5OTBlMjI5MTJlMDg3YTcxY2IzNzA4NThlNTAwNzMyZmU3OWJlMzY2MGRiJlgtQW16LVNpZ25lZEhlYWRlcnM9aG9zdCZhY3Rvcl9pZD0wJmtleV9pZD0wJnJlcG9faWQ9MCJ9.nU3qVgIhJjpyUf6hJgHKNaiHxN_PDWh1VZ1-zx_Amlw"/>
</a>
</br>

### <h2 id="#Amaç">Amaç</h2>
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


####

### Aim
With this project, it is aimed to determine the three most used colors on the basis of objects and to save them in the database, thus revealing the color habits preferred by people according to the periods.

### ![steps](https://github.com/umutsaydam/ColorAnalysisByObjects/assets/69711134/bb363b72-ac7b-49a7-a0b7-fbb9303d9a70) Steps-Taken
**1. Makineyi, kategorileştirilmiş veriler ile eğitmek**
 - Kategorilerine göre (giyim vs.) sınıflandırılmış verileri ayrı ayrı eğiterek nesneyi doğru tespit etme oranı artırıldı.

**2. Instance segmentation Region of interest**
 - Instance segmentation ile ilgili nesnenin tam konumlarını tespit edip, Region of interest algoritmasıyla tespit edilen nesnenin koordinatlarına göre kırpılması sağlandı.

**3. Ortalama renk analizi ve Kmeans**
 - Kırpılmış nesneler üzerinde ağırlıklı olarak bulunan üç renk tespit edilerek verilerin kategoriye gmre depolanması. 

**4. Depolanan veriler doğrultusunda kullanıcıların kategoriye ve zamana göre renk alışkanlıklarının tespiti**
 - Toplanan veriler sayesinde network grafiği ile kategorilere göre renk alışkanlıklarının tespiti.
