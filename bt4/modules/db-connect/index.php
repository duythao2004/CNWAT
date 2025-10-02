<?php
// bt4/modules/db-connect/index.php
require __DIR__ . '/db.php';
require __DIR__ . '/utils.php';

$tab = $_GET['tab'] ?? 'lop'; // 'lop' | 'hoso'
$op  = $_GET['op']  ?? 'list';// 'list' | 'add' | 'edit' | 'delete'

// Thanh tabs
$tabs = [
  'lop'  => 'Bảng LOP',
  'hoso' => 'Bảng HOSO',
];
?>
<section class="inner-hero card" style="display:flex;justify-content:space-between;align-items:center;gap:12px">
  <nav class="chips" aria-label="DB basic">
    <?php foreach ($tabs as $k=>$v): ?>
      <a class="chip <?= $tab===$k?'active':'' ?>" href="bt4/index.php?p=db-connect&tab=<?= $k ?>"><?= h($v) ?></a>
    <?php endforeach; ?>
  </nav>
  <div class="chips">
    <?php if ($tab==='lop'): ?>
      <a class="chip" href="bt4/index.php?p=db-connect&tab=lop&op=add">+ Thêm LOP</a>
    <?php else: ?>
      <a class="chip" href="bt4/index.php?p=db-connect&tab=hoso&op=add">+ Thêm HOSO</a>
    <?php endif; ?>
  </div>
</section>

<section class="card">
<?php
if ($tab==='lop') {
  if ($op==='add' || $op==='edit') include __DIR__.'/pages/lop_form.php';
  elseif ($op==='delete') include __DIR__.'/pages/lop_list.php'; // xử lý delete trong file list rồi quay lại
  else include __DIR__.'/pages/lop_list.php';
} else {
  if ($op==='add' || $op==='edit') include __DIR__.'/pages/hoso_form.php';
  elseif ($op==='delete') include __DIR__.'/pages/hoso_list.php';
  else include __DIR__.'/pages/hoso_list.php';
}
?>
</section>
