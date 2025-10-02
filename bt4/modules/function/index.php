<?php
// Router cho “Nhiệm vụ 7: Function”
$tab = $_GET['tab'] ?? 'arr1';                 // arr1 | matrix
$here = __DIR__;
$file = "$here/pages/$tab.php";
if (!is_file($file)) $file = "$here/pages/arr1.php";

// danh sách tab
$tabs = [
  'arr1'   => 'Mảng 1 chiều',
  'matrix' => 'Ma trận 2 chiều',
];
?>
<section class="inner-hero card">
  <nav class="chips" aria-label="Functions">
    <?php foreach ($tabs as $k=>$label): ?>
      <a class="chip <?= $tab===$k?'active':'' ?>"
         href="bt4/index.php?p=function&tab=<?= $k ?>"><?= $label ?></a>
    <?php endforeach; ?>
  </nav>
</section>

<section class="card">
  <?php include $file; ?>
</section>
