<?php
// Xóa
if (($_GET['op'] ?? '') === 'delete' && isset($_GET['id'])) {
  $id = $_GET['id'];
  $stmt = db()->prepare("DELETE FROM HOSO WHERE MAHS=?");
  $stmt->execute([$id]);
  redirect('index.php?p=db-connect&tab=hoso');
}

// Phân trang
$perPage = 10;
$page = max(1, (int)($_GET['page'] ?? 1));
$offset = ($page-1)*$perPage;

$total = (int)db()->query("SELECT COUNT(*) FROM HOSO")->fetchColumn();
$rows  = db()->prepare("SELECT * FROM HOSO ORDER BY MAHS LIMIT :lim OFFSET :ofs");
$rows->bindValue(':lim',$perPage,PDO::PARAM_INT);
$rows->bindValue(':ofs',$offset,PDO::PARAM_INT);
$rows->execute();
$rows = $rows->fetchAll();

$pages = max(1, (int)ceil($total/$perPage));
?>
<h3>Bảng HOSO (<?= $total ?> bản ghi)</h3>

<table class="table">
  <thead>
    <tr>
      <th>MAHS</th><th>Họ tên</th><th>Ngày sinh</th><th>Địa chỉ</th><th>Lớp</th>
      <th>Toán</th><th>Lý</th><th>Hóa</th><th>Thao tác</th>
    </tr>
  </thead>
  <tbody>
  <?php foreach ($rows as $r): ?>
    <tr>
      <td><?= h($r['MAHS']) ?></td>
      <td><?= h($r['HOTEN']) ?></td>
      <td><?= h($r['NGAYSINH']) ?></td>
      <td><?= h($r['DIACHI']) ?></td>
      <td><?= h($r['LOP']) ?></td>
      <td><?= h($r['DIEMTOAN']) ?></td>
      <td><?= h($r['DIEMLY']) ?></td>
      <td><?= h($r['DIEMHOA']) ?></td>
      <td>
        <a class="chip" href="bt4/index.php?p=db-connect&tab=hoso&op=edit&id=<?= urlencode($r['MAHS']) ?>">Sửa</a>
        <a class="chip" href="bt4/index.php?p=db-connect&tab=hoso&op=delete&id=<?= urlencode($r['MAHS']) ?>"
           onclick="return confirm('Xóa hồ sơ <?= h($r['MAHS']) ?> ?')">Xóa</a>
      </td>
    </tr>
  <?php endforeach; ?>
  </tbody>
</table>

<!-- Phân trang -->
<nav class="chips" aria-label="pagination">
  <?php for ($i=1;$i<=$pages;$i++): ?>
    <a class="chip <?= $i===$page?'active':'' ?>" href="index.php?p=db-connect&tab=hoso&page=<?= $i ?>"><?= $i ?></a>
  <?php endfor; ?>
</nav>
