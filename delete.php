<?php
require 'config.php'; require_login();
if ($_SERVER['REQUEST_METHOD'] !== 'POST') { header('Location: index.php'); exit; }
csrf_check();
$id = (int)($_POST['id'] ?? 0);
$st = $conn->prepare('DELETE FROM mahasiswa WHERE id=?'); $st->bind_param('i', $id); $st->execute();
header('Location: index.php?msg=deleted');
