<?php
session_start();
require_once __DIR__ . '/../_base.php';

// Đọc cookie "last_login" nếu có
$lastLogin = !empty($_COOKIE['last_login'])
  ? date('d/m/Y H:i:s', (int)$_COOKIE['last_login'])
  : 'Chưa có';
?>
<h3>Cookie – End user: Home</h3>
<p>Cookie là dữ liệu nhỏ lưu tại trình duyệt. Server có thể ghi bằng <code>setcookie()</code> và đọc ở <code>$_COOKIE</code>.</p>

<ul>
  <li>Ghi nhớ tài khoản đã đăng nhập (để tự điền form Login).</li>
  <li>Lưu thời điểm đăng nhập gần nhất.</li>
  <li>Lưu danh sách “web link ưa thích” (ở khu Admin).</li>
</ul>

<p><strong>Lần đăng nhập gần nhất:</strong> <?= htmlspecialchars($lastLogin) ?></p>

<p>
  <a class="chip" href="bt4/index.php?p=cookie&page=login">Đến trang Login →</a>
</p>
