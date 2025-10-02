<?php
// Xóa nếu có yêu cầu ?op=delete&id=...
if (($_GET['op'] ?? '') === 'delete' && isset($_GET['id'])) {
  $id = $_GET['id'];
  $stmt = db()->prepare("DELETE FROM LOP WHERE MALOP=?");
  try {
    $stmt->execute([$id]);
  } catch (Throwable $e) {
    $msg = 'Không xóa được (có thể đang được tham chiếu bởi HOSO).';
  }
  redirect('index.php?p=db-connect&tab=lop');
}

// Lấy list
$rows = db()->query("SELECT * FROM LOP ORDER BY MALOP")->fetchAll();
?>
<h3>Bảng LOP</h3>
<?php if (!empty($msg)): ?><div class="badge"><?= h($msg) ?></div><?php endif; ?>
<table class="table">
  <thead>
    <tr><th>MALOP</th><th>TENLOP</th><th>KHOAHOC</th><th>GVCN</th><th>Thao tác</th></tr>
  </thead>
  <tbody>
  <?php foreach ($rows as $r): ?>
    <tr>
      <td><?= h($r['MALOP']) ?></td>
      <td><?= h($r['TENLOP']) ?></td>
      <td><?= h($r['KHOAHOC']) ?></td>
      <td><?= h($r['GVCN']) ?></td>
      <td>
        <a class="chip" href="bt4/index.php?p=db-connect&tab=lop&op=edit&id=<?= urlencode($r['MALOP']) ?>">Sửa</a>
        <a class="chip" href="bt4/index.php?p=db-connect&tab=lop&op=delete&id=<?= urlencode($r['MALOP']) ?>"
           onclick="return confirm('Xóa lớp <?= h($r['MALOP']) ?> ?')">Xóa</a>
      </td>
    </tr>
  <?php endforeach; ?>
  </tbody>
</table>
