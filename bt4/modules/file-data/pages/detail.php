<?php
$id = $_GET['id'] ?? '';
$sv = $id ? find_student($id) : null;
if (!$sv) {
  echo '<div class="alert error">Không tìm thấy sinh viên.</div>';
  return;
}
?>
<h3>Chi tiết sinh viên</h3>
<div class="grid md:grid-cols-2 gap-4 items-start">
  <div>
    <?php if ($sv['image']): ?>
      <img src="bt4/modules/file-data/uploads/<?= htmlspecialchars($sv['image']) ?>"
           alt="" style="max-width:220px;border-radius:12px">
    <?php else: ?>
      <div class="badge">Không có ảnh</div>
    <?php endif; ?>
  </div>
  <div>
    <p><b>Tên:</b> <?= htmlspecialchars($sv['name']) ?></p>
    <p><b>Ngày sinh:</b> <?= htmlspecialchars($sv['birthday']) ?></p>
    <p><b>Địa chỉ:</b> <?= htmlspecialchars($sv['address']) ?></p>
    <p><b>Lớp:</b> <?= htmlspecialchars($sv['class']) ?></p>
    <p class="mt-2">
      <a class="chip" href="bt4/index.php?p=file-data&page=edit&id=<?= urlencode($sv['id']) ?>">Sửa</a>
      <a class="chip" href="bt4/index.php?p=file-data&page=list">Về danh sách</a>
    </p>
  </div>
</div>
