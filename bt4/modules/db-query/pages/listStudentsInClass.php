<?php
$classId = isset($_GET['class']) ? (int)$_GET['class'] : 0;

// Lấy tên lớp
$cls = db()->prepare("SELECT ClassName FROM classes WHERE ID=?");
$cls->execute([$classId]);
$class = $cls->fetch();

if (!$class) {
  echo '<p class="alert">Không tìm thấy lớp.</p>';
  echo '<p><a class="chip" href="bt4/index.php?p=db-query">← Về danh sách lớp</a></p>';
  return;
}

// Lấy SV trong lớp
$st = db()->prepare("SELECT ID, StudentName, StudentAddress, StudentGender, StudentImage
                     FROM students WHERE ClassID=? ORDER BY StudentName");
$st->execute([$classId]);
$students = $st->fetchAll();
?>

<h3>DANH SÁCH SINH VIÊN TRONG LỚP: <?= htmlspecialchars($class['ClassName']) ?></h3>

<?php if (!$students): ?>
  <p>Chưa có sinh viên.</p>
<?php else: ?>
  <table class="table">
    <thead>
      <tr>
        <th>Tên</th>
        <th>Địa chỉ</th>
        <th>Giới tính</th>
        <th>Ảnh</th>
        <th>Thao tác</th>
      </tr>
    </thead>
    <tbody>
    <?php foreach ($students as $s): ?>
      <tr>
        <td><?= htmlspecialchars($s['StudentName']) ?></td>
        <td><?= htmlspecialchars($s['StudentAddress']) ?></td>
        <td><?= htmlspecialchars($s['StudentGender']) ?></td>
        <td>
          <?php if ($s['StudentImage']): ?>
            <img src="bt4/modules/db-query/images/<?= rawurlencode($s['StudentImage']) ?>"
                 alt="" width="40">
          <?php endif; ?>
        </td>
        <td>
          <a href="bt4/index.php?p=db-query&page=studentDetail&id=<?= $s['ID'] ?>">Chi tiết</a>
        </td>
      </tr>
    <?php endforeach; ?>
    </tbody>
  </table>
<?php endif; ?>

<p><a class="chip" href="bt4/index.php?p=db-query">← Về danh sách lớp</a></p>
