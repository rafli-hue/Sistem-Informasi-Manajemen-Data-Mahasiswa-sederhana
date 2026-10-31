<?php /* Partial form (dipakai create.php & edit.php). Variabel: $data, $errors, $action, $title, $id */
$prodiList = ['Teknik Informatika','Sistem Informasi','Teknik Elektro','Manajemen']; ?>
<div class="card"><h2><?= e($title) ?></h2>
<form method="POST" action="<?= e($action) ?>" novalidate>
<input type="hidden" name="csrf" value="<?= e(csrf_token()) ?>">
<?php if (!empty($id)): ?><input type="hidden" name="id" value="<?= (int)$id ?>"><?php endif; ?>
<?php foreach (['nim'=>'text','nama'=>'text','email'=>'email','angkatan'=>'number'] as $f => $type): ?>
 <label><?= e(t($f=='nama'?'name':($f=='angkatan'?'year':$f))) ?></label>
 <input type="<?= $type ?>" name="<?= $f ?>" value="<?= e($data[$f] ?? '') ?>">
 <?php if (isset($errors[$f])): ?><small class="msg"><?= e($errors[$f]) ?></small><?php endif; ?>
<?php endforeach; ?>
 <label><?= e(t('major')) ?></label>
 <select name="prodi"><option value=""><?= e(t('select')) ?></option>
 <?php foreach ($prodiList as $p): ?><option value="<?= e($p) ?>" <?= ($data['prodi'] ?? '')===$p?'selected':'' ?>><?= e($p) ?></option><?php endforeach; ?></select>
 <?php if (isset($errors['prodi'])): ?><small class="msg"><?= e($errors['prodi']) ?></small><?php endif; ?>
 <button class="btn"><?= e(t('save')) ?></button> <a class="btn gray" href="index.php"><?= e(t('cancel')) ?></a>
</form></div>
