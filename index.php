<?php
require 'config.php'; require_login();
$rows = $conn->query('SELECT * FROM mahasiswa ORDER BY id DESC')->fetch_all(MYSQLI_ASSOC);
$flash = ['saved'=>'saved','updated'=>'updated','deleted'=>'deleted','notfound'=>'notfound'][$_GET['msg'] ?? ''] ?? '';
include 'header.php'; ?>
<h2><?= e(t('list')) ?></h2>
<?php if ($flash): ?><p class="alert <?= $flash=='notfound'?'err':'ok' ?>"><?= e(t($flash)) ?></p><?php endif; ?>
<a class="btn" href="create.php">+ <?= e(t('add')) ?></a>
<table><thead><tr><th><?= e(t('no')) ?></th><th><?= e(t('nim')) ?></th><th><?= e(t('name')) ?></th>
<th><?= e(t('email')) ?></th><th><?= e(t('major')) ?></th><th><?= e(t('year')) ?></th><th><?= e(t('action')) ?></th></tr></thead><tbody>
<?php if (!$rows): ?><tr><td colspan="7" class="c"><?= e(t('empty')) ?></td></tr><?php endif; ?>
<?php foreach ($rows as $i => $r): ?>
<tr><td><?= $i+1 ?></td><td><?= e($r['nim']) ?></td><td><?= e($r['nama']) ?></td><td><?= e($r['email']) ?></td>
<td><?= e($r['prodi']) ?></td><td><?= e($r['angkatan']) ?></td>
<td class="act"><a class="btn sm" href="edit.php?id=<?= (int)$r['id'] ?>"><?= e(t('change')) ?></a>
<form method="POST" action="delete.php" onsubmit="return confirm('<?= e(t('confirm_del')) ?>')">
<input type="hidden" name="csrf" value="<?= e(csrf_token()) ?>"><input type="hidden" name="id" value="<?= (int)$r['id'] ?>">
<button class="btn sm danger"><?= e(t('delete')) ?></button></form></td></tr>
<?php endforeach; ?></tbody></table>
<?php include 'footer.php'; ?>
