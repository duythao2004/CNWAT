<?php
// bt4/modules/shop/admin/login.php
if (is_admin()) { redirect(['view'=>'admin','tab'=>'dashboard']); }

if ($_SERVER['REQUEST_METHOD']==='POST') {
  $u = trim($_POST['u'] ?? '');
  $p = trim($_POST['p'] ?? '');
  // Demo: tài khoản admin mặc định
  if ($u==='admin' && $p==='admin') {
    login_user('admin','admin'); // set role=admin
    redirect(['view'=>'admin','tab'=>'dashboard']);
  } else {
    $err = 'Sai tài khoản hoặc mật khẩu';
  }
}
?>
<h2>Admin – Đăng nhập</h2>
<?php if (!empty($err)): ?><div class="alert"><?= htmlspecialchars($err) ?></div><?php endif; ?>

<form method="post" class="form" style="max-width:420px">
  <label>Tài khoản
    <input name="u" placeholder="admin" required>
  </label>
  <label>Mật khẩu
    <input type="password" name="p" placeholder="admin" required>
  </label>
  <button class="btn">Đăng nhập</button>
</form>
<p class="muted">Demo: admin / admin</p>
