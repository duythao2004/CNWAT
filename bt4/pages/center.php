<?php $p = $_GET['p'] ?? ''; ?>
<style>
  /* tabs ngang – mượn phong cách chip/btn của Bài 2 */
  .bt4-tabs { display:flex; gap:8px; flex-wrap:wrap; margin-bottom:14px; }
  .bt4-tabs a {
    display:inline-block; padding:8px 12px; border:1px solid #e5e7eb;
    border-radius:999px; text-decoration:none; background:#fff;
  }
  .bt4-tabs a.active { background:#e0e7ff; border-color:#c7d2fe; font-weight:600; }
</style>

<h2>Bài 4 – PHP & CSDL</h2>
<nav class="bt4-tabs" aria-label="Nhiệm vụ bài 4">
  <?php
  $tabs = [
    '01-template'        => '7.1.1 Tạo template',
    '02-su-dung-template'=> '7.1.2 Tổ chức lại',
    '03-get-post'        => 'NV3 Lấy/Gửi dữ liệu',
    '04-getform'         => 'NV4 GetForm',
    '05-session'         => 'NV5 Session',
    '06-cookie'          => 'NV6 Cookie',
    '07-function'        => 'NV7 Function',
    '08-file-io'         => 'NV8 Đọc/Ghi file',
    '09-data-flow'       => 'NV9 Data flow',
    '10-i18n'            => 'NV10 Đa ngôn ngữ',
    '11-db-connect'      => 'NV11 Kết nối DB',
    '12-db-query'        => 'NV12 Truy vấn',
    '13-shop-enduser'    => 'NV13 Shop – User',
    '14-shop-admin'      => 'NV14 Shop – Admin',
    '15-cart'            => 'NV15 Giỏ hàng',
    '16-richtext'        => 'NV16 Richtext',
  ];
  foreach ($tabs as $k => $label) {
    $act = ($p === $k) ? 'active' : '';
    echo '<a class="'.$act.'" href="bt4/index.php?p='.$k.'">'.$label.'</a>';
  }
  ?>
</nav>

<section class="card">
  <?php if(!$p): ?>
    <p>Chọn một nhiệm vụ ở thanh menu ngang phía trên để xem nội dung.</p>
    <p>Toàn bộ Bài 4 được hiển thị trong vùng MAIN (khoanh đỏ), giữ nguyên layout & style của Bài 2/3.</p>
  <?php else: ?>
    <?php
      $file = __DIR__ . '/../modules/'.$p.'/index.php';
      if (is_file($file)) require $file;
      else echo '<p>Chưa có nội dung cho mục này.</p>';
    ?>
  <?php endif; ?>
</section>
