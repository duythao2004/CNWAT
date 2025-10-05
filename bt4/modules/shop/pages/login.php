<?php
// bt4/modules/shop/pages/login.php
$next = $_GET['next'] ?? url(['page'=>'home']);
if ($_SERVER['REQUEST_METHOD']==='POST') {
  $u = trim($_POST['u'] ?? ''); $p = trim($_POST['p'] ?? '');
  // Demo 2 tài khoản cứng
  if ($u==='admin' && $p==='admin') { login_user('admin','admin'); redirect(['page'=>'admin','tab'=>'dashboard']); }
  if ($u==='user'  && $p==='user')   { login_user('user','user');   header('Location: '.$next); exit; }
  $err = 'Sai tài khoản hoặc mật khẩu';
}
?>
<h2>Đăng nhập</h2>
<?php if (!empty($err)): ?><div class="alert"><?= htmlspecialchars($err) ?></div><?php endif; ?>

<form method="post" class="form" style="max-width:420px">
  <input type="hidden" name="next" value="<?= htmlspecialchars($next) ?>">
  <label>Tài khoản <input name="u" placeholder="user / admin" required></label>
  <label>Mật khẩu  <input type="password" name="p" placeholder="user / admin" required></label>
  <button class="btn">Đăng nhập</button>
</form>
<p class="muted">Demo: user/user (End-user), admin/admin (Admin)</p>
