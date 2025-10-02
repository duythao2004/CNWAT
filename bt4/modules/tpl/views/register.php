<?php
// xử lý submit để hiện kết quả ngay trên TRANG NÀY (không chuyển trang)
$ten = $diachi = $nghe = $ghichu = "";
if ($_SERVER['REQUEST_METHOD']==='POST'){
  $ten    = trim($_POST['ten'] ?? '');
  $diachi = trim($_POST['diachi'] ?? '');
  $nghe   = trim($_POST['nghe'] ?? '');
  $ghichu = trim($_POST['ghichu'] ?? '');
}
?>


<form method="post" class="stack" style="max-width:520px">
  <label>Ten:</label>
  <input name="ten" required value="<?= htmlspecialchars($ten) ?>">

  <label>Dia chi:</label>
  <input name="diachi" value="<?= htmlspecialchars($diachi) ?>">

  <label>Nghe:</label>
  <input name="nghe" value="<?= htmlspecialchars($nghe) ?>">

  <label>Ghi chu:</label>
  <textarea name="ghichu" rows="2"><?= htmlspecialchars($ghichu) ?></textarea>

  <div style="display:flex;gap:8px">
    <button type="reset" class="btn">Xoa</button>
    <button type="submit" class="btn">Dang ky</button>
  </div>
</form>

<?php if($_SERVER['REQUEST_METHOD']==='POST'): ?>
  <div class="card" style="margin-top:14px">
    <h4>Kết quả đăng ký:</h4>
    <p><b>Ten:</b> <?= htmlspecialchars($ten) ?></p>
    <p><b>Dia chi:</b> <?= htmlspecialchars($diachi) ?></p>
    <p><b>Nghe:</b> <?= htmlspecialchars($nghe) ?></p>
    <p><b>Ghi chu:</b> <?= nl2br(htmlspecialchars($ghichu)) ?></p>
  </div>
<?php endif; ?>

<style>
/* form gọn theo style chung */
.stack{display:grid;gap:8px}
.stack input,.stack textarea{padding:8px;border:1px solid #e5e7eb;border-radius:10px}
</style>
