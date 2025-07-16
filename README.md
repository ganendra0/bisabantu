

## <a id="fitur"></a>【 Fitur-Fitur 】

-   **Halaman Donasi**: Pengguna dapat melihat jumlah donasi yang terkumpul.
-   **Halaman Pembayaran**: Pengguna dapat memberikan donasi berupa nama, pesan, jumlah, dan jenis pembayaran.
-   **Halaman List Donatur**: Pengguna dapat melihat list pengguna yang telah berdonasi.
-   **Autentikasi Pengguna**: Registrasi dan login pengguna.
-   **Dashboard Admin**: Panel untuk mengelola donasi dan pengguna.
-   **CRUD Donasi**: Pengelolaan data donasi (Create, Read, Update, Delete).

<!------------>
</br>

## <a id="tools"></a>【 Tools yang Digunakan 】

-   **Framework**: Laravel 11
-   **Database**: MySQL
-   **Dependency Manager**: Composer
-   **Front-end**: Blade Template Engine, Bootstrap

<!------------>
</br>

Setelah Anda melakukan cloning atau mengunduh secara manual repositori ini, jalankan prompt-prompt ini berikut pada terminal agar proyek dapat dijalankan:

1. Clone repositori ini ke lokal Anda (skip step ini jika Anda mengunduh secara manual):
    ```bash
    git clone https://github.com/SirGhazian/website-donasi-laravel.git
    ```
2. Buka folder repository yang telah diclone:
    ```bash
    cd website-donasi-laravel
    ```
3. Instal dependensi PHP menggunakan Composer:
    ```bash
    composer install
    ```
4. Ubah nama file `.env.example` menjadi `.env` dan sesuaikan line 22-27:
    ```bash
    DB_CONNECTION=mysql
    DB_HOST=127.0.0.1
    DB_PORT=3306
    DB_DATABASE=donasi_database
    DB_USERNAME=root
    DB_PASSWORD=
    ```
5. Migrasi database (Saat diminta konfirmasi, enter `yes`)
    ```bash
    php artisan migrate
    ```
6. Buat seed database untuk akun login
    ```bash
    php artisan db:seed AkunLogin
    ```
7. Buat seed database untuk list donatur
    ```bash
    php artisan db:seed ListDonatur
    ```
8. Generate application key:
    ```bash
    php artisan key:generate
    ```

<!------------>
</br>

## <a id="jalankan"></a>【 Menjalankan Aplikasi 】

Setelah berhasil melakukan step-step instalasi diatas, sekarang jalankan aplikasi dengan prompt:

1. Jalankan server pengembangan Laravel:
    ```bash
    php artisan serve
    ```
2. Buka browser dan buka link:
    ```bash
    http://localhost:8000
    ```

<!------------>
</br>

