<?php
// bt4/modules/shop/admin/users.php
require_admin(); // ép đăng nhập & đúng role

// ====== CREATE / UPDATE ======
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
  $id        = (int)($_POST['id'] ?? 0);
  $username  = trim($_POST['username'] ?? '');
  $role      = $_POST['role'] ?? 'user';
  $pass_raw  = trim($_POST['password'] ?? '');         // nếu edit có thể để trống => giữ nguyên
  $fullname  = trim($_POST['fullname'] ?? '');
  $birthday  = $_POST['birthday'] ?? null;
  $address   = trim($_POST['address']  ?? '');
  $avatar    = $_POST['avatar_old']    ?? '';          // giữ ảnh cũ nếu không upload mới

  // Upload avatar (tuỳ chọn)
  if (!empty($_FILES['avatar']['name'])) {
    $dir = __DIR__ . '/../assets/uploads/';
    if (!is_dir($dir)) mkdir($dir, 0777, true);
    $safe = time().'_'.preg_replace('/[^a-zA-Z0-9\.\-_]/','_', $_FILES['avatar']['name']);
    if (move_uploaded_file($_FILES['avatar']['tmp_name'], $dir.$safe)) {
      $avatar = $safe;
    }
  }

  if ($username === '' || !in_array($role, ['user','admin'], true)) {
    $err = 'Thiếu dữ liệu hợp lệ.';
  } else {
    try {
      if ($id > 0) {
        // UPDATE: chỉ hash password khi người dùng nhập mới
        if ($pass_raw !== '') {
          $sql = "UPDATE users SET username=?, password=MD5(?), role=?, fullname=?, birthday=?, address=?, avatar=? WHERE id=?";
          $pdo->prepare($sql)->execute([$username,$pass_raw,$role,$fullname,$birthday,$address,$avatar,$id]);
        } else {
          $sql = "UPDATE users SET username=?, role=?, fullname=?, birthday=?, address=?, avatar=? WHERE id=?";
          $pdo->prepare($sql)->execute([$username,$role,$fullname,$birthday,$address,$avatar,$id]);
        }
      } else {
        // INSERT: yêu cầu có password
        if ($pass_raw === '') throw new Exception('Vui lòng nhập mật khẩu cho user mới');
        $sql = "INSERT INTO users(username,password,role,fullname,birthday,address,avatar) VALUES(?,MD5(?),?,?,?,?,?)";
        $pdo->prepare($sql)->execute([$username,$pass_raw,$role,$fullname,$birthday,$address,$avatar]);
      }
      redirect(['page'=>'admin','tab'=>'users']); // QUAN TRỌNG: redirect trước khi xuất HTML
    } catch (Throwable $e) {
      $err = 'Lỗi: '.$e->getMessage(); // ví dụ trùng username
    }
  }
}

// ====== DELETE ======
if (isset($_GET['del'])) {
  $delId = (int)$_GET['del'];
  // không cho xoá chính mình (nếu đã lưu id vào session khi login)
  $myId  = $_SESSION['shop_auth']['id'] ?? 0;
  if ($delId && $delId != $myId) {
    $pdo->prepare("DELETE FROM users WHERE id=?")->execute([$delId]);
  }
  redirect(['page'=>'admin','tab'=>'users']);
}

// ====== DETAIL ======
$detail = null;
if (isset($_GET['view'])) {
  $st = $pdo->prepare("SELECT id,username,role,fullname,birthday,address,avatar FROM users WHERE id=?");
  $st->execute([(int)$_GET['view']]);
  $detail = $st->fetch();
}

// ====== EDIT (nạp form) ======
$edit = null;
if (isset($_GET['edit'])) {
  $st = $pdo->prepare("SELECT id,username,role,fullname,birthday,address,avatar FROM users WHERE id=?");
  $st->execute([(int)$_GET['edit']]);
  $edit = $st->fetch();
}

// ====== LIST ======
$list = $pdo->query("SELECT id,username,role,fullname,avatar FROM users ORDER BY id DESC")->fetchAll();
?>

<?php if (!empty($err)): ?>
  <div class="badge" style="background:#ffebee;color:#b00020"><?= htmlspecialchars($err) ?></div>
<?php endif; ?>

<!-- Form add/edit -->
<form method="post" enctype="multipart/form-data" class="form" style="max-width:700px;margin:10px 0">
  <input type="hidden" name="id" value="<?= $edit['id'] ?? 0 ?>">

  <div class="grid-2">
    <label>Username
      <input name="username" value="<?= htmlspecialchars($edit['username'] ?? '') ?>" required>
    </label>

    <label>Mật khẩu
      <input type="password" name="password" placeholder="<?= $edit ? 'Để trống nếu giữ nguyên' : 'Nhập mật khẩu' ?>">
    </label>
  </div>

  <div class="grid-2">
    <label>Họ tên
      <input name="fullname" value="<?= htmlspecialchars($edit['fullname'] ?? '') ?>">
    </label>

    <label>Ngày sinh
      <input type="date" name="birthday" value="<?= htmlspecialchars($edit['birthday'] ?? '') ?>">
    </label>
  </div>

  <label>Địa chỉ
    <textarea name="address" rows="3"><?= htmlspecialchars($edit['address'] ?? '') ?></textarea>
  </label>

  <div class="grid-2">
    <label>Vai trò
      <?php $cur = $edit['role'] ?? 'user'; ?>
      <select name="role">
        <option value="user"  <?= $cur==='user'  ? 'selected':'' ?>>user</option>
        <option value="admin" <?= $cur==='admin' ? 'selected':'' ?>>admin</option>
      </select>
    </label>

    <label>Ảnh (avatar)
      <input type="file" name="avatar" accept="image/*">
      <input type="hidden" name="avatar_old" value="<?= htmlspecialchars($edit['avatar'] ?? '') ?>">
    </label>
  </div>

  <?php if (!empty($edit['avatar'])): ?>
    <div style="margin:6px 0">
      <img src="bt4/modules/shop/assets/uploads/<?= htmlspecialchars($edit['avatar']) ?>" style="height:80px;border-radius:8px">
    </div>
  <?php endif; ?>

  <div style="margin-top:8px">
    <button class="btn"><?= $edit ? 'Cập nhật' : 'Thêm mới' ?></button>
    <?php if ($edit): ?><a class="btn" href="<?= url(['page'=>'admin','tab'=>'users']) ?>">Hủy</a><?php endif; ?>
  </div>
</form>

<!-- Detail box -->
<?php if ($detail): ?>
  <div class="card" style="max-width:460px;margin:8px 0">
    <h3>Thông tin người dùng</h3>
    <p><b>Username:</b> <?= htmlspecialchars($detail['username']) ?></p>
    <p><b>Họ tên:</b> <?= htmlspecialchars($detail['fullname'] ?? '') ?></p>
    <p><b>Ngày sinh:</b> <?= htmlspecialchars($detail['birthday'] ?? '') ?></p>
    <p><b>Địa chỉ:</b> <?= nl2br(htmlspecialchars($detail['address'] ?? '')) ?></p>
    <p><b>Vai trò:</b> <?= htmlspecialchars($detail['role']) ?></p>
    <?php if ($detail['avatar']): ?>
      <p><img src="bt4/modules/shop/assets/uploads/<?= htmlspecialchars($detail['avatar']) ?>" style="height:140px;border-radius:8px"></p>
    <?php endif; ?>
    <p><a class="chip" href="<?= url(['page'=>'admin','tab'=>'users']) ?>">Đóng</a></p>
  </div>
<?php endif; ?>

<!-- Danh sách users -->
<table class="table">
  <tr><th>ID</th><th>Avatar</th><th>Username</th><th>Họ tên</th><th>Role</th><th>Thao tác</th></tr>
  <?php foreach ($list as $u): ?>
    <tr>
      <td><?= $u['id'] ?></td>
      <td><?php if ($u['avatar']): ?><img src="bt4/modules/shop/assets/uploads/<?= htmlspecialchars($u['avatar']) ?>" style="height:36px;border-radius:6px"><?php endif; ?></td>
      <td><?= htmlspecialchars($u['username']) ?></td>
      <td><?= htmlspecialchars($u['fullname'] ?? '') ?></td>
      <td><?= htmlspecialchars($u['role']) ?></td>
      <td>
        <a href="<?= url(['page'=>'admin','tab'=>'users','view'=>$u['id']]) ?>">Chi tiết</a> |
        <a href="<?= url(['page'=>'admin','tab'=>'users','edit'=>$u['id']]) ?>">Sửa</a> |
        <a onclick="return confirm('Xóa user này?')" href="<?= url(['page'=>'admin','tab'=>'users','del'=>$u['id']]) ?>">Xóa</a>
      </td>
    </tr>
  <?php endforeach; ?>
</table>
