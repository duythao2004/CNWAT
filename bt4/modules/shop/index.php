<?php
// bt4/modules/shop/index.php
if (session_status() === PHP_SESSION_NONE) session_start();

require __DIR__.'/db.php';
require __DIR__.'/helpers.php';

$page = $_GET['page'] ?? 'home';

include __DIR__.'/components/header.php';

switch ($page) {
  case 'list':    include __DIR__.'/pages/list.php';    break;
  case 'detail':  include __DIR__.'/pages/detail.php';  break;
  case 'search':  include __DIR__.'/pages/search.php';  break;
  case 'cart':    include __DIR__.'/pages/cart.php';    break;
  case 'login':   include __DIR__.'/pages/login.php';   break;
  case 'logout':  include __DIR__.'/pages/logout.php';  break;

  case 'admin':   include __DIR__.'/admin/index.php';   break;

  default:        include __DIR__.'/pages/home.php';
}

include __DIR__.'/components/footer.php';
if (!isset($_GET['p']) && isset($_GET['page'])) {
    $qs = $_GET;
    $qs['p'] = 'shop';
    header('Location: /CNWAT/bt4/index.php?' . http_build_query($qs));
    exit;
}