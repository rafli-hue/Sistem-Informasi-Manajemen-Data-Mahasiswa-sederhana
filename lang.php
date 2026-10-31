<?php
// Dual bahasa (ID/EN) disimpan di $_SESSION['lang']
$LANG = [
'id' => [
 'app'=>'Sistem Data Mahasiswa','login'=>'Masuk','logout'=>'Keluar','username'=>'Nama Pengguna','password'=>'Kata Sandi',
 'login_fail'=>'Nama pengguna atau kata sandi salah.','welcome'=>'Halo','list'=>'Daftar Mahasiswa','add'=>'Tambah Mahasiswa',
 'edit'=>'Ubah Mahasiswa','nim'=>'NIM','name'=>'Nama Lengkap','email'=>'Email','major'=>'Program Studi','year'=>'Angkatan',
 'action'=>'Aksi','no'=>'No','select'=>'-- Pilih --','save'=>'Simpan','cancel'=>'Batal','delete'=>'Hapus','change'=>'Ubah',
 'confirm_del'=>'Yakin ingin menghapus data ini?','empty'=>'Belum ada data.','saved'=>'Data berhasil disimpan.',
 'updated'=>'Data berhasil diperbarui.','deleted'=>'Data berhasil dihapus.','notfound'=>'Data tidak ditemukan.',
 'err_required'=>'Wajib diisi.','err_nim'=>'NIM harus 5-15 digit angka.','err_nama'=>'Nama 3-100 karakter.',
 'err_email'=>'Format email tidak valid.','err_prodi'=>'Program studi tidak valid.','err_angkatan'=>'Angkatan tidak valid.',
 'err_dup'=>'NIM sudah terdaftar.','language'=>'Bahasa','demo_acc'=>'Akun uji coba','demo_user'=>'Nama pengguna','demo_pass'=>'Kata sandi'],
'en' => [
 'app'=>'Student Data System','login'=>'Login','logout'=>'Logout','username'=>'Username','password'=>'Password',
 'login_fail'=>'Incorrect username or password.','welcome'=>'Hello','list'=>'Student List','add'=>'Add Student',
 'edit'=>'Edit Student','nim'=>'Student ID','name'=>'Full Name','email'=>'Email','major'=>'Major','year'=>'Class Year',
 'action'=>'Actions','no'=>'No','select'=>'-- Select --','save'=>'Save','cancel'=>'Cancel','delete'=>'Delete','change'=>'Edit',
 'confirm_del'=>'Are you sure you want to delete this record?','empty'=>'No data yet.','saved'=>'Data saved successfully.',
 'updated'=>'Data updated successfully.','deleted'=>'Data deleted successfully.','notfound'=>'Record not found.',
 'err_required'=>'This field is required.','err_nim'=>'Student ID must be 5-15 digits.','err_nama'=>'Name must be 3-100 characters.',
 'err_email'=>'Invalid email format.','err_prodi'=>'Invalid major.','err_angkatan'=>'Invalid class year.',
 'err_dup'=>'Student ID already registered.','language'=>'Language','demo_acc'=>'Demo account','demo_user'=>'Username','demo_pass'=>'Password'],
];
if (isset($_GET['lang'])) {
    switch ($_GET['lang']) { case 'id': case 'en': $_SESSION['lang'] = $_GET['lang']; break; }
    $q = $_GET; unset($q['lang']);                       // kembali ke halaman yang sama
    header('Location: ' . strtok($_SERVER['REQUEST_URI'], '?') . ($q ? '?' . http_build_query($q) : '')); exit;
}
if (empty($_SESSION['lang'])) $_SESSION['lang'] = 'id';
function t($k) { global $LANG; return $LANG[$_SESSION['lang']][$k] ?? $k; }
