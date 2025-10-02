<?php
$rows = load_students();
$alert = '';
if (!empty($_GET['msg'])) {
  $map = [
    'added'       => 'Đã thêm sinh viên thành công.',
    'updated'     => 'Đã cập nhật sinh viên.',
    'deleted'     => 'Đã xóa sinh viên.',
    'delete_fail' => 'Xóa không thành công.',
  ];
  $alert = $map[$_GET['msg']] ?? '';
}
?>
<h3>Danh sách sinh viên</h3>

<?php if ($alert): ?>
  <div class="alert <?= $_GET['msg']==='delete_fail' ? 'error' : 'success' ?>">
    <?= htmlspecialchars($alert) ?>
  </div>
<?php endif; ?>

<?php if (!$rows): ?>
  <p>Chưa có dữ liệu. Hãy <a class="chip" href="bt4/index.php?p=file-data&page=add">thêm mới</a>.</p>
<?php else: ?>
  <div class="table-wrap">
    <table class="table">
      <thead>
        <tr>
          <th>STT</th>
          <th>Tên</th>
          <th>Ngày sinh</th>
          <th>Địa chỉ</th>
          <th>Ảnh</th>
          <th>Lớp</th>
          <th>Thao tác</th>
        </tr>
      </thead>
      <tbody>
        <?php foreach ($rows as $i => $r): ?>
          <tr>
            <td><?= $i+1 ?></td>
            <td><?= htmlspecialchars($r['name']) ?></td>
            <td><?= htmlspecialchars($r['birthday']) ?></td>
            <td><?= htmlspecialchars($r['address']) ?></td>
            <td>
              <?php if ($r['image']): ?>
                <img src="bt4/modules/file-data/uploads/<?= htmlspecialchars($r['image']) ?>" alt="" style="height:42px">
              <?php endif; ?>
            </td>
            <td><?= htmlspecialchars($r['class']) ?></td>
            <td>
              <a href="bt4/index.php?p=file-data&page=detail&id=<?= urlencode($r['id']) ?>">Detail</a> |
              <a href="bt4/index.php?p=file-data&page=edit&id=<?= urlencode($r['id']) ?>">Edit</a> |
              <a href="bt4/index.php?p=file-data&page=delete&id=<?= urlencode($r['id']) ?>"
                 onclick="return confirm('Xóa sinh viên này?');">Delete</a>
            </td>
          </tr>
        <?php endforeach; ?>
      </tbody>
    </table>
  </div>
<?php endif; ?>
