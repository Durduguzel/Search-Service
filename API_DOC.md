# 📖 API Kullanım Dokümantasyonu

**Örnek API Kullanıcısı:**
```
email: second_user@example.com
şifre: 12345
```

Bu kullanıcıyla API kullanımını test edebilirsiniz.

## 🔑 Authentication (Login)
API istekleri **sadece admin tipindeki kullanıcılar** tarafından yapılabilir.  

**Endpoint:**  
```
POST http://localhost:8080/api/login
```

**Body (JSON):**
```json
{
  "email": "admin@example.com",
  "password": "secret"
}
```

**Response:**
```json
{
  "token": "d2f4a8f8f6b8474c9f0d5c4e2b1c9a6d...",
  "expires_at": "2025-09-16T18:20:00.000000Z"
}
```

> Bu token 15 dakika geçerlidir. Her istek için `Authorization: Bearer <token>` header’ı ile gönderilmelidir.  

---

## ⏳ Rate Limiting
Her kullanıcı için:  
- **Dakikada maksimum 60 istek** yapılabilir.  
- Limit aşıldığında `429 Too Many Requests` hatası döner.  

---

## 📚 Content API
### İçerik Arama & Listeleme
**Endpoint:**
```
POST http://localhost:8080/api/contents
```

**Headers:**
```
Authorization: Bearer <token>
Content-Type: application/json
```

**Body (opsiyonel filtreler):**
```json
{
  "title": ["Go", "Tutorial"],
  "type": ["video"],
  "tags": ["programming", "testing"],
  "page": 1
}
```

### Response:
```json
{
  "current_page": 1,
  "per_page": 10,
  "total": 4,
  "last_page": 1,
  "data": [
    {
      "row_number": 1,
      "id": 2,
      "data_source_id": 1,
      "external_id": "v2",
      "title": "Advanced Go Concurrency Patterns",
      "type": "video",
      "score": 74.84,
      "tags": ["programming", "advanced", "concurrency"],
      "views": 25000,
      "likes": 2100,
      "duration_seconds": 1365,
      "reading_time": 0,
      "reactions": 0,
      "comments": 0,
      "published_at": "2024-03-14T15:30:00.000000Z",
      "created_at": "2025-09-14T19:02:08.000000Z",
      "updated_at": "2025-09-14T20:29:46.000000Z"
    }
  ]
}
```

---

## 📝 Özet
- **POST /api/login** → Token al (sadece admin kullanıcılar)
- **POST /api/contents** → İçerik arama, filtreleme, sıralama
- **🔑 Token**: 15 dakika geçerli (Authorization header içinde gönderilmeli)
- **⚡ Rate Limit**: Dakikada max. 60 istek
- **📄 Pagination**: Sayfalama bilgileri (current_page, per_page, total, last_page) ile döner

