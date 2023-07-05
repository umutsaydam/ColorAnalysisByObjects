# Color Analysis By Objects
### [TR](https://github.com/umutsaydam/ColorAnalysisByObjects/blob/main/README.md?plain=1#L9)
Bu proje ile obje bazında en çok kullanılan üç rengin belirlenerek veri tabanına kaydedilmesi ve böylece dönemlere göre insanların tercih ettiği renk alışkanlıklarının ortaya çıkarılması amaçlanmaktadır.
****
### EN
With this project, it is aimed to determine the three most used colors on the basis of objects and to save them in the database, thus revealing the color habits preferred by people according to the periods.

**1. Makineyi, kategorileştirilmiş veriler ile eğitmek**
 - Kategorilerine göre (giyim vs.) sınıflandırılmış verileri ayrı ayrı eğiterek nesneyi doğru tespit etme oranı artırıldı.

**2. Instance segmentation Region of interest**
 - Instance segmentation ile ilgili nesnenin tam konumlarını tespit edip, Region of interest algoritmasıyla tespit edilen nesnenin koordinatlarına göre kırpılması sağlandı.

**3. Ortalama renk analizi ve Kmeans**
 - Kırpılmış nesneler üzerinde ağırlıklı olarak bulunan üç renk tespit edilerek verilerin kategoriye gmre depolanması. 

**4. Depolanan veriler doğrultusunda kullanıcıların kategoriye ve zamana göre renk alışkanlıklarının tespiti**
 - Toplanan veriler sayesinde network grafiği ile kategorilere göre renk alışkanlıklarının tespiti.
