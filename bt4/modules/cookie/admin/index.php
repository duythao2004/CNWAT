<?php
// Admin shell cho Cookie – giống khung 4.5 Session
session_start();
require_once __DIR__ . '/../_base.php';

// CHẶN TRUY CẬP: bắt buộc đã login end-user
if (empty($_SESSION['username'])) {
  redirect('bt4/index.php?p=cookie&page=login');
}

$A = $_GET['a'] ?? 'links';
$allowed = ['links','logout'];
if (!in_array($A, $allowed, true)) $A = 'links';
$file = __DIR__ . '/pages/' . $A . '.php';
?>
<!doctype html>
<html lang="vi">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width,initial-scale=1">
  <base href="<?= BASE ?>">
  <title>Cookie – Admin</title>
  <link rel="stylesheet" href="ui/css/bundle.css">
</head>
<body>
  <div class="wrap">
    <!-- Cột trái: thông tin SV -->
    <section class="student">
      <div class="avatar"><img src="bt2/assets/img/me.jpg" alt="Ảnh của tôi"></div>
      <div>
        <h3>Khu Tự trị (Cookie)</h3>
        <p><strong>User:</strong> <?= htmlspecialchars($_SESSION['username']) ?></p>
      </div>
    </section>

    <!-- Banner VIDEO -->
    <header class="banner banner--video">
      <video class="banner-video" autoplay muted loop playsinline
             poster="bt2/assets/img/banner-poster.jpg">
        <source src="bt2/assets/video/banner.webm" type="video/webm">
        <source src="bt2/assets/video/banner.mp4"  type="video/mp4">
        Trình duyệt của bạn không hỗ trợ video.
      </video>
    </header>

    <!-- Menu trái (giống 4.5): có mục quay về Bài 4 và mục Admin Cookie -->
    <nav class="menu" aria-label="Menu">
      <h4>Menu</h4>
      <ul>
        <li><a href="bt4/index.php">← Về Bài 4</a></li>
        <li><a class="active" href="bt4/modules/cookie/admin/index.php?a=links">Cookie Admin</a></li>
      </ul>
    </nav>

    <!-- MAIN -->
    <main class="main card">
      <section class="inner-hero card">
        <nav class="chips" aria-label="Admin tabs">
          <a class="chip <?= $A==='links'?'active':'' ?>" href="bt4/modules/cookie/admin/index.php?a=links">Fav Links</a>
          <a class="chip <?= $A==='logout'?'active':'' ?>" href="bt4/modules/cookie/admin/index.php?a=logout">Logout</a>
        </nav>
      </section>

      <section class="card">
        <?php include $file; ?>
      </section>
    </main>

    <footer class="footer">Thông tin của tôi – © 2025</footer>
  </div>
</body>
</html>
