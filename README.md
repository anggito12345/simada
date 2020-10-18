# Untuk menjalankan aplikasi ini

1. Download atau clone repo ini (di anjurkan untuk clone)
contoh clone:

```
git clone https://github.com/anggito12345/simada.git
```

2. Restore database di folder document/db

3. Install dependency, wajib untuk install [composer](https://getcomposer.org/download/) terlebih dahulu.
```
composer install
```

4. copy hasil clone atau download ke server php (xampp/htdocs)

5. jalankan server php dan postgresSQL lalu buka browser dan ketikan localhost/simada

#  Jalankan aplikasi via docker
### By: Ganjar Setia

Pastikan sudah terinstall **docker** & **docker-compose**

 1. clone repository git seperti cara diatas
 2. copy file `.env.docker` menjadi `.env`. Edit file nya, sesuaikan dengan keperluan. Contoh ubah `WEB_PORT` menjadi 8080 untuk menjalankan aplikasi di [http://localhost:8080](http://localhost:8080)
 3. `docker-compose build`
 4. `docker-compose up -d`
 5. `docker-compose exec app chmod -R 777 storage`
 6. `docker-compose exec app chmod -R 777 bootstrap/cache`
 7. `docker-compose exec app ./composer.phar install`
 8. `docker-compose exec app php artisan key:generate` selalu generate key baru, demi keamanan.
 9. `docker-compose exec app php artisan migrate:fresh --seed`

Buka Aplikasi di [http://localhost:8070](http://localhost:8070)

Jika selesai dengan development & ingin mematikan aplikasi, jalankan: `docker-compose down`

Untuk menghidupkan lagi, jalankan: `docker-compose up -d`

Tidak perlu di build ulang.
