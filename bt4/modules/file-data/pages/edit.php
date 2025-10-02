<?php
$id = $_GET['id'] ?? '';
$sv = $id ? find_student($id) : null;
if (!$sv) {
  echo '<div class="alert error">Không tìm thấy sinh viên.</div>';
  return;
}

$msg = '';
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
  $name     = trim($_POST['name'] ?? '');
  $birthday = trim($_POST['birthday'] ?? '');
  $address  = trim($_POST['address'] ?? '');
  $class    = trim($_POST['class'] ?? '');

  $newImg = handle_upload('image');
  if ($newImg) $sv['image'] = $newImg; // có upload mới thì thay ảnh

  if ($name === '' || $birthday === '' || $address === '' || $class === '') {
    $msg = 'Vui lòng nhập đầy đủ các trường.';
  } else {
    $rows = load_students();
    foreach ($rows as &$r) {
      if ($r['id'] === $sv['id']) {
        $r['name']     = $name;
        $r['birthday'] = $birthday;
        $r['address']  = $address;
        $r['class']    = $class;
        $r['image']    = $sv['image'];
        break;
      }
    }
    if (save_students($rows)) {
      header('Location: bt4/index.php?p=file-data&page=detail&id='.$sv['id']);
      exit;
    }
    $msg = 'Không thể lưu dữ liệu!';
  }
}
?>
<h3>Sửa sinh viên</h3>
<?php if ($msg): ?><div class="alert error"><?= htmlspecialchars($msg) ?></div><?php endif; ?>

<form method="post" enctype="multipart/form-data" class="form-grid" style="max-width:560px">
  <label>Full name
    <input type="text" name="name" value="<?= htmlspecialchars($sv['name']) ?>" required>
  </label>
  <label>Birthday
    <input type="date" name="birthday" value="<?= htmlspecialchars($sv['birthday']) ?>" required>
  </label>
  <label>Address
    <input type="text" name="address" value="<?= htmlspecialchars($sv['address']) ?>" required>
  </label>
  <label>Image (upload để thay ảnh)
    <input type="file" name="image" accept=".jpg,.jpeg,.png,.gif,.webp">
  </label>
  <?php if ($sv['image']): ?>
    <div><img src="bt4/modules/file-data/uploads/<?= htmlspecialchars($sv['image']) ?>" alt="" style="height:64px"></div>
  <?php endif; ?>
  <label>Class
    <input type="text" name="class" value="<?= htmlspecialchars($sv['class']) ?>" required>
  </label>
  <div class="actions">
    <a class="btn" href="bt4/index.php?p=file-data&page=list">Hủy</a>
    <button type="submit" class="btn btn-primary">Cập nhật</button>
  </div>
</form>
