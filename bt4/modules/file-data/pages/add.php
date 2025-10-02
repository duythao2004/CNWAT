<?php
$msg = '';
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
  $name     = trim($_POST['name'] ?? '');
  $birthday = trim($_POST['birthday'] ?? '');
  $address  = trim($_POST['address'] ?? '');
  $class    = trim($_POST['class'] ?? '');
  $image    = handle_upload('image');

  if ($name === '' || $birthday === '' || $address === '' || $class === '') {
    $msg = 'Vui lòng nhập đầy đủ các trường.';
  } else {
    $rows = load_students();
    $rows[] = [
      'id'       => make_id(),
      'name'     => $name,
      'birthday' => $birthday,
      'address'  => $address,
      'image'    => $image,
      'class'    => $class,
    ];
    if (save_students($rows)) {
      // về list
      header('Location: index.php?p=file-data&page=list');
      exit;
    }
    $msg = 'Không thể lưu dữ liệu!';
  }
}
?>
<h3>Thêm sinh viên mới</h3>
<?php if ($msg): ?><div class="alert error"><?= htmlspecialchars($msg) ?></div><?php endif; ?>

<form method="post" enctype="multipart/form-data" class="form-grid" style="max-width:560px">
  <label>Full name
    <input type="text" name="name" required>
  </label><br>
  <label>Birthday
    <input type="date" name="birthday" required>
  </label><br>
  <label>Address
    <input type="text" name="address" required>
  </label><br>
  <label>Image
    <input type="file" name="image" accept=".jpg,.jpeg,.png,.gif,.webp">
  </label><br>
  <label>Class
    <input type="text" name="class" required>
  </label><br>
  <div class="actions">
    <button type="reset" class="btn">Nhập lại</button>
    <button type="submit" class="btn btn-primary">Lưu</button>
  </div>
</form>
