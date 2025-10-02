<?php
// Sửa đúng base theo XAMPP của bạn. Phải có dấu / đầu & cuối.
define('BASE', '/CNWAT/');

// Dùng chung để redirect với URL tuyệt đối (tránh ERR_UNSAFE_REDIRECT)
function redirect($path) {
  header('Location: ' . BASE . ltrim($path, '/'));
  exit;
}

// Thiết lập thông số Cookie dùng chung (path = BASE để mọi trang đọc được)
function set_app_cookie(string $name, string $value, int $days = 30): void {
  setcookie(
    $name,
    $value,
    [
      'expires'  => time() + 60*60*24*$days,
      'path'     => BASE,    // quan trọng!
      'secure'   => false,   // true nếu chạy HTTPS
      'httponly' => true,
      'samesite' => 'Lax',
    ]
  );
}
