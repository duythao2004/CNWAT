<?php
// Admin shell (home | upload | logout)
// Sửa TÙY MÁY BẠN nếu base khác:
define('BASE', '/CNWAT/');

session_start();

// Chặn truy cập nếu chưa login
if (empty($_SESSION['username'])) {
  // Thông báo rồi đưa về Login end-user
  header('Location: ' . BASE . 'bt4/index.php?p=session&page=login');
  exit;
}

$A = $_GET['a'] ?? 'home';
$allowed = ['home','upload','logout'];
if (!in_array($A, $allowed, true)) $A = 'home';

$file = __DIR__ . '/pages/' . $A . '.php';
?>
<!doctype html>
<html lang="vi">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width,initial-scale=1">
  <base href="<?= BASE ?>">
  <title>Session – Admin</title>
  <link rel="stylesheet" href="ui/css/bundle.css">
</head>
<body>
  <div class="wrap">
    <section class="student">
      <div class="avatar"><img src="bt2/assets/img/me.jpg" alt=""></div>
      <div>
        <h3>Khu Tự Trị</h3>
        <p>Xin chào: <b><?= htmlspecialchars($_SESSION['username']) ?></b></p>
      </div>
    </section>

    <header class="banner banner--video">
      <video class="banner-video" autoplay muted loop playsinline
             poster="bt2/assets/img/banner-poster.jpg">
        <source src="bt2/assets/video/banner.webm" type="video/webm">
        <source src="bt2/assets/video/banner.mp4"  type="video/mp4">
      </video>
    </header>

    <nav class="menu" aria-label="Menu Admin">
      <h4>Admin</h4>
      <ul>
        <li><a class="<?= $A==='home'?'active':'' ?>"   href="bt4/modules/session/admin/index.php?a=home">Home</a></li>
        <li><a class="<?= $A==='upload'?'active':'' ?>" href="bt4/modules/session/admin/index.php?a=upload">Upload</a></li>
        <li><a class="<?= $A==='logout'?'active':'' ?>" href="bt4/modules/session/admin/index.php?a=logout">Logout</a></li>
      </ul>
    </nav>

    <main class="main card">
      <?php include $file; ?>
    </main>

    <footer class="footer">Thông tin của tôi – © 2025</footer>
  </div>
</body>
</html>
