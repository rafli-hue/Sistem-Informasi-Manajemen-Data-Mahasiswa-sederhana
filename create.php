<?php
require 'config.php'; require_login();
$data = []; $errors = [];
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    csrf_check();
    [$data, $errors] = validate_mhs($_POST);
    if (!$errors) {
        try {
            $st = $conn->prepare('INSERT INTO mahasiswa (nim,nama,email,prodi,angkatan) VALUES (?,?,?,?,?)');
            $st->bind_param('ssssi', $data['nim'], $data['nama'], $data['email'], $data['prodi'], $data['angkatan']);
            $st->execute();
            header('Location: index.php?msg=saved'); exit;
        } catch (mysqli_sql_exception $ex) {
            if ($ex->getCode() == 1062) $errors['nim'] = t('err_dup'); else throw $ex;
        }
    }
}
$title = t('add'); $action = 'create.php';
include 'header.php'; include 'form.php'; include 'footer.php';
