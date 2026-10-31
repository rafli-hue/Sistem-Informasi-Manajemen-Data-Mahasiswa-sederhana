<?php
require 'config.php'; require_login();
$id = (int)($_POST['id'] ?? $_GET['id'] ?? 0); $errors = [];
$st = $conn->prepare('SELECT * FROM mahasiswa WHERE id=?'); $st->bind_param('i', $id); $st->execute();
$data = $st->get_result()->fetch_assoc();
if (!$data) { header('Location: index.php?msg=notfound'); exit; }
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    csrf_check();
    [$data, $errors] = validate_mhs($_POST);
    if (!$errors) {
        try {
            $st = $conn->prepare('UPDATE mahasiswa SET nim=?,nama=?,email=?,prodi=?,angkatan=? WHERE id=?');
            $st->bind_param('ssssii', $data['nim'], $data['nama'], $data['email'], $data['prodi'], $data['angkatan'], $id);
            $st->execute();
            header('Location: index.php?msg=updated'); exit;
        } catch (mysqli_sql_exception $ex) {
            if ($ex->getCode() == 1062) $errors['nim'] = t('err_dup'); else throw $ex;
        }
    }
}
$title = t('edit'); $action = 'edit.php?id=' . $id;
include 'header.php'; include 'form.php'; include 'footer.php';
