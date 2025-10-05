<?php
$mod    = $_GET['p'] ?? '';
$center = __DIR__.'/pages/center.php';                 // mặc định hiển thị khối tab
if ($mod) {
  $f = __DIR__."/modules/$mod/index.php";             // p=tpl, getpost, …
  if (is_file($f)) $center = $f;
}
ini_set('display_errors', 1);
error_reporting(E_ALL);

?>
<!doctype html>
<html lang="vi">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width,initial-scale=1">
  <base href="/CNWAT/">
  <title>Bài 4 – PHP & CSDL</title>
  <link rel="stylesheet" href="ui/css/bundle.css">
</head>
<body>
  <div class="wrap">
    <?php include __DIR__.'/pages/left.php'; ?>     
    <?php include __DIR__.'/pages/head.php'; ?>    
    <?php include __DIR__.'/pages/menu.php'; ?>   

    <main class="main">
      
      <?php include $center; ?>                    
      <?php include __DIR__.'/pages/right.php'; ?>  
      
    </main>

    <?php include __DIR__.'/pages/footer.php'; ?>   
  </div>
</body>
</html>
