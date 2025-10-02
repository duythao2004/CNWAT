<?php
// Hiển thị thông tin user đã đăng nhập
?>
<h3>Admin • Home</h3>
<ul>
  <li>Username: <b><?= htmlspecialchars($_SESSION['username']) ?></b></li>
  <li>Role: <b><?= htmlspecialchars($_SESSION['role'] ?? 'admin') ?></b></li>
  <li>PHPSESSID: <code><?= session_id() ?></code></li>
</ul>
<p><a class="chip" href="bt4/modules/session/admin/index.php?a=upload">→ Sang trang Upload</a></p>
