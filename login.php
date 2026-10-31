<?php
require 'config.php';
if (!empty($_SESSION['user_id'])) { header('Location: index.php'); exit; }
$error = '';
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    csrf_check();
    $u = trim($_POST['username'] ?? ''); $p = $_POST['password'] ?? '';
    if ($u === '' || $p === '') { $error = t('err_required'); }
    else {
        $st = $conn->prepare('SELECT id,password,nama FROM users WHERE username=?');
        $st->bind_param('s', $u); $st->execute();
        $row = $st->get_result()->fetch_assoc();
        if ($row && password_verify($p, $row['password'])) {
            session_regenerate_id(true);
            $_SESSION['user_id'] = $row['id']; $_SESSION['nama'] = $row['nama'];
            header('Location: index.php'); exit;
        } else { $error = t('login_fail'); }
    }
}
include 'header.php'; ?>
<div class="card small"><h2><?= e(t('login')) ?></h2>
<?php if ($error): ?><p class="alert err"><?= e($error) ?></p><?php endif; ?>
<form method="POST" action="login.php">
 <input type="hidden" name="csrf" value="<?= e(csrf_token()) ?>">
 <label><?= e(t('username')) ?></label><input type="text" name="username" value="<?= e($_POST['username'] ?? '') ?>" required>
 <label><?= e(t('password')) ?></label><input type="password" name="password" required>
 <button class="btn"><?= e(t('login')) ?></button>
</form>
<p class="hint"><strong><?= e(t('demo_acc')) ?></strong><br>
<?= e(t('demo_user')) ?>: <code>admin</code><br><?= e(t('demo_pass')) ?>: <code>admin123</code></p></div>
<?php include 'footer.php'; ?>
