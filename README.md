# Sistem Data Mahasiswa (PHP Native + MySQL)
CRUD data mahasiswa dengan login `$_SESSION` dan dual bahasa (ID/EN).

## Cara Menjalankan
1. Install XAMPP/Laragon, jalankan Apache & MySQL.
2. Salin folder ke `htdocs/siakad`.
3. Buka phpMyAdmin -> Import `database.sql`.
4. Sesuaikan kredensial di `config.php` bila perlu.
5. Buka `http://localhost/siakad/` -> login `admin` / `admin123`.

## Fitur
- Form POST + validasi if-else & switch, sanitasi (`htmlspecialchars`, `filter_var`, `strip_tags`)
- CRUD dengan prepared statement (anti SQL Injection) + token CSRF
- Login `$_SESSION` (password `password_hash`/`password_verify`), proteksi semua halaman CRUD
- Bahasa ID/EN disimpan di `$_SESSION['lang']`

## Struktur
config.php | lang.php | login.php | logout.php | index.php | create.php | edit.php | delete.php | form.php | header.php | footer.php | assets/style.css | database.sql
