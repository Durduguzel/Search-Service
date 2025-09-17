# 📌 Arama Motoru Servisi – Laravel 11 + Docker

## 🚀 Proje Hakkında

**Örnek Portal Kullanıcısı:**
```
url: http://localhost:8080
email: first_user@example.com
şifre: 12345
```

Bu kullanıcıyla portal girişini deneyebilirsiniz.

Bu proje, farklı içerik sağlayıcılardan (JSON/XML) gelen içerikleri birleştirip, kullanıcı sorgusuna göre arayan, puanlayan ve sıralayan bir **Laravel 11 API & Portal** uygulamasıdır.

### Özellikler

* 🔍 İçerik arama ve filtreleme (anahtar kelime, içerik türü, etiket)
* ⭐ İçerik puanlama algoritması
  *(Final Skor = Temel Puan × Tür Katsayısı + Güncellik + Etkileşim)*
* 🔑 Token tabanlı API erişimi
* ⚡ Redis cache ile hızlı sorgu (30 dk)
* 📄 Pagination: **10 içerik / sayfa**
* 🕒 Scheduler ve Queue worker otomatik çalışıyor
* 🐳 Docker ile taşınabilir mimari

---

## 🔄 Proje Akışı

### 1. Veri Toplama ve İşleme

* Sistem, farklı **provider**’lardan sürekli veri çeker (XML/JSON).
* Her provider için özel **parser class** içerikleri işler, ortak yapıya dönüştürür ve veritabanına kaydeder.
* İçerik işlenirken **ScoreCalculator** sınıfı ile puan hesaplanır.
* Provider bilgileri **data\_sources** tablosunda tutulur; yeni provider eklemek için tabloya kayıt eklemek ve parser sınıfını tanımlamak yeterlidir.
* Veri çekme ve işleme süreçleri **schedule** ve **queue** mekanizmalarıyla yönetilir.

### 2. Portal (Arayüz)

* http://localhost:8080
* Kullanıcı, **login** ekranından giriş yapar ve iki ana ekran görür:

  * İçerikler listesi
  * Providerlar listesi
* Filtreleme ve sayfalama (pagination) desteklenir.
* **Kullanıcı tipleri:**

  * `portal` → sadece portal erişimi
  * `admin` → hem portal hem API erişimi

### 3. API

* İçeriklerin **çekilmesi, sıralanması ve filtrelenmesi** sağlanır.
* Tüm veri sonuçları **pagination** ile döner.
* Kullanım akışı:

  1. `POST /api/login` ile token alınır
  2. Token, `Authorization` header ile gönderilir
  3. Token geçerlilik süresi: 15 dk
  4. API rate limit: **dakikada 60 istek / kullanıcı**

* Detaylı API kullanımı için lütfen `API_DOC.md` dosyasını inceleyiniz.
---

## ⚙️ Kurulum – Docker

### Gereksinimler

* Docker ≥ 20.x
* Docker Compose ≥ 2.x

### Adımlar

1. Repository klonla:

   ```bash
   git clone <repo-url>
   cd <project-folder>
   ```
2. Composer ile bağımlılıkları yükle:

   ```bash
   composer install
   ```
3. .env dosyasını oluştur / ayarla:

   ```bash
   cp .env.example .env
   ```
   Eğer APP_KEY boş ise çalıştır:

   ```bash
   php artisan key:generate
   ```
4. Container’ları ayağa kaldır:

   ```bash
   docker-compose up --build -d
   ```
5. Database migrate ve seed çalıştır:

   ```bash
   docker-compose exec app php artisan migrate --force
   docker-compose exec app php artisan db:seed --class=DatabaseSeeder --force
   ```
6. Scheduler ve Queue worker Supervisor ile otomatik çalışır.
   Loglar: `storage/logs/`

---

## ⏱️ Job / Scheduler

* **Scheduler**: `php artisan schedule:run` → job’ları queue’ya ekler
* **Queue worker**: `php artisan queue:work` → job’ları işler

---

## ⚡ Cache & Rate Limiting

* Redis cache: `CACHE_DRIVER=redis`
* API rate limit: **dakikada 60 istek / kullanıcı**
* ContentController cache: sorgular **30 dk** tutulur

---

## 🧪 Quick Test – Unit Test Çalıştırma
* Projede ScoreCalculator ve diğer servislerin testlerini Docker ortamında çalıştırmak için:

   ```bash
    docker-compose exec app php artisan test
   ```

---

## 📑 Logs

* Scheduler: `storage/logs/scheduler.log` / `scheduler_err.log`
* Queue worker: `storage/logs/queue.log` / `queue_err.log`

---

## 🔧 Geliştirme Notları

* Docker içinde **MySQL & Redis** hazır gelir.
* Yeni **Data Source** eklemek kolay: `DataSource`, `RawEntry`, `Tag` modelleri ile genişletilebilir.
* Puanlama algoritması `ScoreCalculator` servis sınıfında bulunur.
