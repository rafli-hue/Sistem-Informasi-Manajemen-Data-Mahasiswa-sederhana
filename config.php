<?php
// Konfigurasi, koneksi database, session, dan fungsi bantu
session_start();
mysqli_report(MYSQLI_REPORT_ERROR | MYSQLI_REPORT_STRICT);

$DB_HOST = 'localhost'; $DB_USER = 'root'; $DB_PASS = ''; $DB_NAME = 'db_mahasiswa';
try {
    $conn = new mysqli($DB_HOST, $DB_USER, $DB_PASS, $DB_NAME);
    $conn->set_charset('utf8mb4');
} catch (mysqli_sql_exception $ex) {
    die('Database connection failed. Check config.php');
}

require __DIR__ . '/lang.php';

function e($s) { return htmlspecialchars((string)$s, ENT_QUOTES, 'UTF-8'); }   // sanitasi output
function csrf_token() {
    if (empty($_SESSION['csrf'])) $_SESSION['csrf'] = bin2hex(random_bytes(32));
    return $_SESSION['csrf'];
}
function csrf_check() {
    if (!isset($_POST['csrf']) || !hash_equals($_SESSION['csrf'] ?? '', $_POST['csrf'])) {
        http_response_code(403); die('Invalid CSRF token');
    }
}
function require_login() {            // proteksi halaman berbasis $_SESSION
    if (empty($_SESSION['user_id'])) { header('Location: login.php'); exit; }
}
function validate_mhs(array $in): array {
    // Sanitasi input
    $d = [
        'nim'      => trim(strip_tags($in['nim'] ?? '')),
        'nama'     => trim(strip_tags($in['nama'] ?? '')),
        'email'    => trim(filter_var($in['email'] ?? '', FILTER_SANITIZE_EMAIL)),
        'prodi'    => trim($in['prodi'] ?? ''),
        'angkatan' => trim($in['angkatan'] ?? ''),
    ];
    $err = [];
    // Validasi dengan if-else
    if ($d['nim'] === '') $err['nim'] = t('err_required');
    elseif (!preg_match('/^[0-9]{5,15}$/', $d['nim'])) $err['nim'] = t('err_nim');

    if ($d['nama'] === '') $err['nama'] = t('err_required');
    elseif (mb_strlen($d['nama']) < 3 || mb_strlen($d['nama']) > 100) $err['nama'] = t('err_nama');

    if ($d['email'] === '') $err['email'] = t('err_required');
    elseif (!filter_var($d['email'], FILTER_VALIDATE_EMAIL)) $err['email'] = t('err_email');

    // Validasi dengan switch
    switch ($d['prodi']) {
        case '': $err['prodi'] = t('err_required'); break;
        case 'Teknik Informatika': case 'Sistem Informasi': case 'Teknik Elektro': case 'Manajemen': break;
        default: $err['prodi'] = t('err_prodi');
    }
    $y = filter_var($d['angkatan'], FILTER_VALIDATE_INT, ['options' => ['min_range' => 2000, 'max_range' => (int)date('Y')]]);
    if ($d['angkatan'] === '') $err['angkatan'] = t('err_required');
    elseif ($y === false) $err['angkatan'] = t('err_angkatan');
    else $d['angkatan'] = $y;
    return [$d, $err];
}
