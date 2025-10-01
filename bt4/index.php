<?php
$mod = $_GET['p'] ?? '';                         // router cho menu ngang
$center = __DIR__.'/pages/center.php';          // mặc định trang giới thiệu BT4
if ($mod) {
  $f = __DIR__."/modules/$mod/index.php";
  if (is_file($f)) $center = $f;
}
?>
<!doctype html>
<html lang="vi">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width,initial-scale=1">
  <base href="/CNWAT/">
  <title>Bài 4 – PHP & CSDL</title>
  <link rel="stylesheet" href="ui/css/bundle.css"> <!-- tái dùng CSS bài 2 -->
</head>
<body>
  <div class="wrap">
    <!-- Cột trái: thông tin SV (y hệt Bài 2/3) -->
    <section class="student">
      <div class="avatar"><img src="bt2/assets/img/me.jpg" alt="Ảnh của tôi"></div>
      <div>
        <h3>Thông tin sinh viên</h3>
        <p><strong>Họ và tên:</strong> Nguyễn Duy Thảo</p>
        <p><strong>MSSV:</strong> AT190351</p>
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

    <!-- Menu trái TOÀN SITE: chỉ thêm 1 mục “Bài 4” -->
    <?php include __DIR__.'/pages/menu.php'; ?>

    <!-- MAIN: nơi hiển thị toàn bộ nội dung BT4 -->
    <main class="main card slide-up">
      <?php include $center; ?>
    </main>

    <footer class="footer">Thông tin của tôi – © 2025</footer>
  </div>
</body>
</html>
