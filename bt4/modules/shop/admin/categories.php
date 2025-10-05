<?php
// Thêm/sửa
if ($_SERVER['REQUEST_METHOD']==='POST') {
  $id=(int)($_POST['id']??0); $name=trim($_POST['name']??'');
  if ($name!=='') {
    if ($id) $pdo->prepare("UPDATE categories SET name=? WHERE id=?")->execute([$name,$id]);
    else     $pdo->prepare("INSERT INTO categories(name) VALUES(?)")->execute([$name]);
  }
  redirect(['page'=>'admin','tab'=>'categories']);
}
// Xoá
if (isset($_GET['del'])) {
  $pdo->prepare("DELETE FROM categories WHERE id=?")->execute([(int)$_GET['del']]);
  redirect(['page'=>'admin','tab'=>'categories']);

}
// Sửa?
$edit=null;
if (isset($_GET['edit'])) { $st=$pdo->prepare("SELECT * FROM categories WHERE id=?"); $st->execute([(int)$_GET['edit']]); $edit=$st->fetch(); }
$list = $pdo->query("SELECT * FROM categories ORDER BY id DESC")->fetchAll();
?>
<form method="post" class="form-inline" style="margin:10px 0">
  <input type="hidden" name="id" value="<?= $edit['id'] ?? 0 ?>">
  <input name="name" value="<?= htmlspecialchars($edit['name'] ?? '') ?>" placeholder="Tên loại" required>
  <button class="btn"><?= $edit ? 'Cập nhật' : 'Thêm' ?></button>
  <?php if ($edit): ?><a class="btn" href="<?= url(['page'=>'admin','tab'=>'categories']) ?>">Hủy</a><?php endif; ?>
</form>

<table class="table">
  <tr><th>ID</th><th>Tên loại</th><th>Thao tác</th></tr>
  <?php foreach($list as $r): ?>
  <tr>
    <td><?= $r['id'] ?></td>
    <td><?= htmlspecialchars($r['name']) ?></td>
    <td>
      <a href="<?= url(['page'=>'admin','tab'=>'categories','edit'=>$r['id']]) ?>">Sửa</a> |
      <a onclick="return confirm('Xóa loại này?')" href="<?= url(['page'=>'admin','tab'=>'categories','del'=>$r['id']]) ?>">Xóa</a>
    </td>
  </tr>
  <?php endforeach; ?>
</table>
