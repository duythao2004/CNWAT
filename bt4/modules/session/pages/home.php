<?php
// End-user Home
$logged = !empty($_SESSION['username']);
?>
<h3>Session – End user: Home</h3>
<p>Mô phỏng đăng nhập bằng <b>Session</b>. Tài khoản mẫu:
  <code>admin / admin</code>.</p>

<?php if ($logged): ?>
  <p class="badge">Đang đăng nhập: <b><?= htmlspecialchars($_SESSION['username']) ?></b></p>
  <p><a class="chip" href="<?= BASE ?>bt4/modules/session/admin/index.php">Vào khu Admin →</a></p>
<?php else: ?>
  <p><a class="chip" href="<?= BASE ?>bt4/index.php?p=session&page=login">Đến trang Login →</a></p>
<?php endif; ?>
