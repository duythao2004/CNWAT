<?php
// danh sách nhiệm vụ – điều hướng ?p=
$items = [
  
  'tpl'         => 'template',
  'getpost'     => '4.3 Lấy/Gửi dữ liệu ',
  'calc'        => '4.4 GetForm ',
  'session'       => '4.5 Session',
  'cookie'      => '4.6 Cookie',
  'function'     => '4.7 Funcsion',
  'file'        => '4.8 Đọc/ghi file',
  'file-data'   => '4.9 Thao tác file',
  'web-langue'  => '4.10 web đa nn',
  'db-connect'  => '4.11 Kết nối DB',
  'db-query'    => '4.12 Truy vấn dữ liệu',
  'shop'   => '4.X Web bán laptop',
  
];
$cur = $_GET['p'] ?? '';
?>
<header class="inner-hero card">
  
  <nav class="chips" aria-label="Nhiệm vụ">
    <?php foreach ($items as $k => $label): 
      $href = $k === '' ? 'bt4/index.php' : 'bt4/index.php?p='.$k; ?>
      <a class="chip <?= $cur===$k?'active':'' ?>" href="<?= $href ?>"><?= $label ?></a>
    <?php endforeach; ?>
  </nav>
</header>


