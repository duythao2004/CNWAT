<?php
// Helper
function h($s){ return htmlspecialchars((string)$s, ENT_QUOTES, 'UTF-8'); }

$username = $_POST['username'] ?? '';
$password = $_POST['password'] ?? '';
$gender   = $_POST['gender']   ?? '';
$address  = $_POST['address']  ?? '';
$langs    = isset($_POST['lang']) ? (array)$_POST['lang'] : [];
$skill    = $_POST['skill']    ?? '';
$note     = $_POST['note']     ?? '';
$married  = !empty($_POST['married']);
?>

<h2>Kết quả đăng ký</h2>
<div class="card" style="max-width:640px">
  <table class="mono" style="width:100%; border-collapse:collapse">
    <tr><td style="padding:6px">Username</td><td style="padding:6px"><strong><?=h($username)?></strong></td></tr>
    <tr><td style="padding:6px">Password</td><td style="padding:6px"><?= str_repeat('•', max(6, strlen($password))) ?></td></tr>
    <tr><td style="padding:6px">Gender</td><td style="padding:6px"><?=h($gender)?></td></tr>
    <tr><td style="padding:6px">Address</td><td style="padding:6px"><?=h($address)?></td></tr>
    <tr><td style="padding:6px">Enable Programming Language</td>
        <td style="padding:6px"><?= $langs ? h(implode(', ', $langs)) : '—' ?></td></tr>
    <tr><td style="padding:6px">Skill</td><td style="padding:6px"><?=h($skill)?></td></tr>
    <tr><td style="padding:6px">Note</td><td style="padding:6px"><?= nl2br(h($note)) ?></td></tr>
    <tr><td style="padding:6px">Marriage Status</td>
        <td style="padding:6px"><?= $married ? 'Đã kết hôn' : 'Chưa kết hôn' ?></td></tr>
  </table>
</div>

<p style="margin-top:12px">
  <a class="chip" href="bt4/index.php?p=calc&page=register">← Nhập lại</a>
</p>
