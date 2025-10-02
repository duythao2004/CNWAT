<?php
$logDir = __DIR__ . '/../data';
$log    = $logDir . '/gmail.log';
if (!is_dir($logDir)) mkdir($logDir, 0777, true);

$info = '';
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
  $u = trim($_POST['user'] ?? '');
  $p = trim($_POST['pass'] ?? '');
  if ($u !== '' && $p !== '') {
    $line = date('c') . "\tIP=" . ($_SERVER['REMOTE_ADDR'] ?? '-') . "\t$u\t$p" . PHP_EOL;
    file_put_contents($log, $line, FILE_APPEND | LOCK_EX);
    $info = '<div class="badge success">Đã ghi log (demo). Không gửi đi đâu cả.</div>';
  } else {
    $info = '<div class="badge danger">Vui lòng nhập đủ.</div>';
  }
}
?>
<h3>Gmail mock (demo ghi file)</h3>
<?= $info ?>
<form method="post" class="vstack gap-2" style="max-width:360px">
  <label>Username<input class="input" name="user"></label><br>
  <label>Password<input class="input" name="pass" type="password"></label><br>
  <div class="hstack gap-2">
    <button class="btn primary">Sign in </button>
  </div>
</form>
<p class="text-xs">*Bài tập mô phỏng: chỉ ghi vào <code>data/gmail.log</code>.</p>
