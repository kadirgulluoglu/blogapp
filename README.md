<p align="center"><a href="https://laravel.com" target="_blank"><img src="https://raw.githubusercontent.com/laravel/art/master/logo-lockup/5%20SVG/2%20CMYK/1%20Full%20Color/laravel-logolockup-cmyk-red.svg" width="400" alt="Laravel Logo"></a></p>

## API Kullanımı

#### Giriş Yap

```http
  GET /api/login
```
#### Kayıt Ol
```http
  POST /api/register
```
| Parametre | Tip     | Açıklama                       |
| :-------- | :------- | :-------------------------------- |
| `name`      | `string` | **Gerekli**, Adı.|
| `email`      | `string` |  **Gerekli**, Mail.|
| `categoryids`      | `string` | **Gerekli**, Şifre.|



#### Tüm blogları getir

```http
  GET /api/blog
```
#### İstenilen Blog'u getirir

```http
  GET /api/blog/id
```

```http
  POST /api/blog
```
| Parametre | Tip     | Açıklama                       |
| :-------- | :------- | :-------------------------------- |
| `title`      | `string` | **Gerekli**, Başlık.|
| `description`      | `string` | Açıklama.|
| `categoryids`      | `string` | **Gerekli**, Kategori Id örn:"1,2".|


  
