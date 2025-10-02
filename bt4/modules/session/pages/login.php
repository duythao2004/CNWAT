<?php
// End-user Login
$msg = '';
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
  $u = trim($_POST['username'] ?? '');
  $p = trim($_POST['password'] ?? '');

  if ($u === 'admin' && $p === 'admin') {
    // Lưu session và chuyển hẳn vào khu admin
    $_SESSION['username'] = $u;
    $_SESSION['role']     = 'admin';

    // (để tương thích với đề: Session["Username"])
    $_SESSION['Username'] = $u;

    header('Location: ' . BASE . 'bt4/modules/session/admin/index.php');
    exit;
  } else {
    $msg = 'Sai username hoặc password!';
  }
}
?>

<h3>Đăng nhập</h3>
<?php if ($msg): ?><p class="badge warn"><?= htmlspecialchars($msg) ?></p><?php endif; ?>

<form method="post" class="form vstack gap-2" autocomplete="off">
  <label>Username
    <input name="username" required>
  </label><br>
  <label>Password
    <input name="password" type="password" required>
  </label>
  <div>
    <button class="btn" type="reset">Nhập lại</button>
    <button class="btn" type="submit">Đăng nhập</button>
  </div>
</form>
