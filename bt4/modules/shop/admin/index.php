<?php
// bt4/modules/shop/admin/index.php
if (session_status() === PHP_SESSION_NONE) session_start();
require_once __DIR__.'/../helpers.php';
require_once __DIR__.'/../db.php';

if (!is_logged() || !is_admin()) { redirect(['page'=>'login']); }

// BẮT ĐẦU BUFFER — quan trọng để tránh “headers already sent”
ob_start();

$tab = $_GET['tab'] ?? 'dashboard';

// --- NAV / HEADER (vẫn có thể echo thoải mái) ---
echo '<h2>Quản trị Shop</h2>
<nav class="chips" style="margin-bottom:12px">
  <a class="chip '.($tab==='dashboard'?'active':'').'" href="'.url(['page'=>'admin','tab'=>'dashboard']).'">Dashboard</a>
  <a class="chip '.($tab==='categories'?'active':'').'" href="'.url(['page'=>'admin','tab'=>'categories']).'">Loại</a>
  <a class="chip '.($tab==='products'?'active':'').'" href="'.url(['page'=>'admin','tab'=>'products']).'">Sản phẩm</a>
  <a class="chip" href="'.url(['page'=>'logout']).'">Đăng xuất</a>
</nav>';

// --- LOAD TAB NỘI DUNG ---
$map = [
  'dashboard'  => __DIR__.'/dashboard.php',
  'categories' => __DIR__.'/categories.php',  // file này có redirect()
  'products'   => __DIR__.'/products.php',    // file này cũng có redirect()
];
include $map[$tab] ?? $map['dashboard'];

// KẾT THÚC BUFFER — gửi output một lần
ob_end_flush();
