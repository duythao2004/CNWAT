<?php
$id = isset($_GET['id']) ? (int)$_GET['id'] : 0;

$st = db()->prepare(
  "SELECT s.*, c.ClassName
     FROM students s
     JOIN classes c ON c.ID = s.ClassID
    WHERE s.ID=?"
);
$st->execute([$id]);
$sv = $st->fetch();

if (!$sv) {
  echo '<p class="alert">Không tìm thấy sinh viên.</p>';
  echo '<p><a class="chip" href="bt4/index.php?p=db-query">← Về danh sách lớp</a></p>';
  return;
}
?>
<h3>Chi tiết sinh viên</h3>
<div class="grid-2">
  <div>
    <?php if ($sv['StudentImage']): ?>
      <img src="bt4/modules/db-query/images/<?= rawurlencode($sv['StudentImage']) ?>"
           alt="" width="180">
    <?php endif; ?>
  </div>
  <div>
    <p><strong>Tên:</strong> <?= htmlspecialchars($sv['StudentName']) ?></p>
    <p><strong>Giới tính:</strong> <?= htmlspecialchars($sv['StudentGender']) ?></p>
    <p><strong>Địa chỉ:</strong> <?= htmlspecialchars($sv['StudentAddress']) ?></p>
    <p><strong>Lớp:</strong> <?= htmlspecialchars($sv['ClassName']) ?></p>
    <p>
      <a class="chip" href="bt4/index.php?p=db-query&page=listStudentsInClass&class=<?= $sv['ClassID'] ?>">← Về lớp</a>
    </p>
  </div>
</div>
