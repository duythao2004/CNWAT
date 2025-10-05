<?php
// bt4/modules/shop/components/header.php
$cats = $pdo->query("SELECT id,name FROM categories ORDER BY name")->fetchAll();
?>
<link rel="stylesheet" href="bt4/modules/shop/assets/css/shop.css">

<header class="shop-header">
  <h1 class="logo">🛒 LaptopShop</h1>
  <nav class="top-links">
    <a href="<?= url(['page'=>'home']) ?>">Trang chủ</a>
    <a href="<?= url(['page'=>'search']) ?>">Tìm kiếm</a>
    <a href="<?= url(['page'=>'cart']) ?>">Giỏ hàng</a>
    <?php if (is_logged()): ?>
      <?php if (is_admin()): ?><a href="<?= url(['page'=>'admin','tab'=>'dashboard']) ?>">Admin</a><?php endif; ?>
      <span class="muted">👤 <?= htmlspecialchars(user_name()) ?></span>
      <a href="<?= url(['page'=>'logout']) ?>">Đăng xuất</a>
    <?php else: ?>
      <a href="<?= url(['page'=>'login','next'=>current_url()]) ?>">Đăng nhập</a>
    <?php endif; ?>
  </nav>


</header>

<main class="container">
  <aside class="sidebar">
    <h3>Danh mục</h3>
    <ul>
      <?php foreach($cats as $c): ?>
        <li><a href="<?= url(['page'=>'list','cat'=>$c['id']]) ?>"><?= htmlspecialchars($c['name']) ?></a></li>
      <?php endforeach; ?>
    </ul>
  </aside>
  <section class="content">