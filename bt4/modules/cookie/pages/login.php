<?php
session_start();
require_once __DIR__ . '/../_base.php';

$msg = '';

// Lấy sẵn cookie để tự điền
$lastUser = $_COOKIE['last_user'] ?? '';
$lastPass = $_COOKIE['last_pass'] ?? ''; // demo: để sẵn vào ô password (không khuyến nghị thực tế)

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
  $u = trim($_POST['username'] ?? '');
  $p = trim($_POST['password'] ?? '');

  if ($u === 'admin' && $p === 'admin') {
    // 1) Lưu session
    $_SESSION['username'] = $u;
    $_SESSION['role']     = 'admin';

    // 2) Lưu cookie tự điền lần sau + thời điểm đăng nhập gần nhất
    set_app_cookie('last_user', $u);
    set_app_cookie('last_pass', $p);
    set_app_cookie('last_login', (string)time());

    // 3) Sang khu admin của Cookie
    redirect('bt4/modules/cookie/admin/index.php');
  } else {
    $msg = 'Sai username hoặc password!';
  }
}
?>

<h3>Cookie – End user: Login</h3>

<?php if ($msg): ?>
  <p class="badge badge--error"><?= htmlspecialchars($msg) ?></p>
<?php endif; ?>

<form method="post" class="form">
  <div class="row">
    <label>Username</label>
    <input type="text" name="username" value="<?= htmlspecialchars($lastUser) ?>" required>
  </div>
  <div class="row">
    <label>Password</label>
    <input type="password" name="password" value="<?= htmlspecialchars($lastPass) ?>" required>
  </div>
  <div class="row">
    <button class="btn" type="reset">Reset</button>
    <button class="btn" type="submit">Login</button>
  </div>
  <p class="muted">Gợi ý: <code>admin / admin</code></p>
</form>
