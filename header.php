<?php $self = htmlspecialchars(basename($_SERVER['PHP_SELF'])); ?>
<!DOCTYPE html>
<html lang="<?= e($_SESSION['lang']) ?>"><head><meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1">
<title><?= e(t('app')) ?></title><link rel="stylesheet" href="assets/style.css"></head><body>
<nav><strong><?= e(t('app')) ?></strong><span class="right">
<?php if (!empty($_SESSION['user_id'])): ?>
 <?= e(t('welcome')) ?>, <?= e($_SESSION['nama']) ?> |
<?php endif; ?>
 <?= e(t('language')) ?>:
 <a href="?<?= http_build_query(array_merge($_GET, ['lang'=>'id'])) ?>" class="<?= $_SESSION['lang']=='id'?'on':'' ?>">ID</a> /
 <a href="?<?= http_build_query(array_merge($_GET, ['lang'=>'en'])) ?>" class="<?= $_SESSION['lang']=='en'?'on':'' ?>">EN</a>
<?php if (!empty($_SESSION['user_id'])): ?> | <a href="logout.php"><?= e(t('logout')) ?></a><?php endif; ?>
</span></nav><main>
