# Yandex-Metrica-API-Example-all-Properties
# Özellikler
- Günlük, Haftalık, Aylık ve Yıllık veriler
- Toplam Ziyaretçi, Toplam Ziyaret Sayısı, Hemen Çıkma Oranı, Sayfa Derinliği, Sitede Geçirilen Zaman Verileri
- Mobil ve Desktop Oranları
- Trafik Kaynakları (Organik, Sosyal Medya, Direk, Site içi, Yönlendirme Trafikleri Yüzdelik ve Sayıları)

# Kullanım için
> Öncelikle Yandex Metrica hesabı oluşturularak, Metrica üzerindeki adımlar izlenir ve bir sayaç oluşturulur. Sonrasında sayaç web sitenizin <head> bölümüne eklenir. Aktif olarak çalıştığı kontrol edildikten sonra Token alınması gerekir.
###### Yandex Metrica Token İşlemleri
- Öncelikle Yandex üzerinden Authorization işlemi yapılır ve sonrasında bir Client oluşturulur. Bu Client kullanılarak Sayaç için bir TOKEN alınır. İşlemlerin detayı için [BURAYI](https://tech.yandex.com/metrika/doc/api2/intro/authorization-docpage/) inceleyebilirsiniz.
- TOKEN alındıktan sonra, ajax/ajax.php[3] Sayaç ID, ajax/ajax.php[4] TOKEN tanımlanır.
- function.php üzerinde time zone ayarlanır.
- index.php üzerinden veriler izlenir.
  
# Fonksiyonlar ve Kullanımları
###### yandexozet_hit
Veriler trafik kaynaklarına göre ayrılır, ve listelenir.
```
yandexozet_hit($id,$token,"0","day"); //GÜNLÜK
// Veriler günlük olarak görüntülenir.
yandexozet_hit($id,$token,"-7","day"); //HAFTALIK
// Veriler günlük olarak görüntülenir.
yandexozet_hit($id,$token,"-30","day"); //AYLIK
// Veriler günlük olarak görüntülenir.
yandexozet_hit($id,$token,"-365","month"); //YILLIK
// Veriler aylık olarak görüntülenir.
```
###### yandexozet
Linechart üzerinde kullanılacak, günlük ziyaret verilerini çeker.
```
yandexozet($id,$token,"0","week"); //GÜNLÜK
// Line Chart üzerinde veriler haftalık olarak görüntülenir.
yandexozet($id,$token,"-7","week"); //HAFTALIK
// Line Chart üzerinde veriler haftalık olarak görüntülenir.
yandexozet($id,$token,"-30","month"); //AYLIK
// Line Chart üzerinde veriler aylık olarak görüntülenir.
yandexozet($id,$token,"-365","year"); //YILLIK
// Line Chart üzerinde veriler yıllık olarak görüntülenir.
```
###### yandexozet_platform
Mobil ve Desktop ziyaret verilerini çeker.
```
yandexozet($id,$token,"0"); //GÜNLÜK
// Veriler günlük olarak görüntülenir.
yandexozet($id,$token,"-7"); //HAFTALIK
// Veriler günlük olarak görüntülenir.
yandexozet($id,$token,"-30"); //AYLIK
// Veriler günlük olarak görüntülenir.
yandexozet($id,$token,"-365"); //YILLIK
// Veriler aylık olarak görüntülenir.
```
