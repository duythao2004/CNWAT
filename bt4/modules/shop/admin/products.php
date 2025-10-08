<?php
// Thêm/sửa
if ($_SERVER['REQUEST_METHOD']==='POST') {
  $id   =(int)($_POST['id']??0);
  $name =trim($_POST['name']??'');
  $price=(float)($_POST['price']??0);
  $cat  =(int)($_POST['category_id']??0);
  $desc =$_POST['description']??'';
  $image=$_POST['image_old']??'';

  // Upload (tuỳ chọn)
  if (!empty($_FILES['image']['name'])) {
    $dir = __DIR__ . '/../assets/img/';
    if (!is_dir($dir)) mkdir($dir,0777,true);
    $safe = time().'_'.preg_replace('/[^a-zA-Z0-9\.\-_]/','_', $_FILES['image']['name']);
    if (move_uploaded_file($_FILES['image']['tmp_name'], $dir.$safe)) $image = $safe;
  }

  if ($id) $pdo->prepare("UPDATE products SET name=?,price=?,category_id=?,image=?,description=? WHERE id=?")
               ->execute([$name,$price,$cat,$image,$desc,$id]);
  else     $pdo->prepare("INSERT INTO products(name,price,category_id,image,description) VALUES(?,?,?,?,?)")
               ->execute([$name,$price,$cat,$image,$desc]);

  redirect(['page'=>'admin','tab'=>'products']);
}
// Xoá
if (isset($_GET['del'])) {
  $pdo->prepare("DELETE FROM products WHERE id=?")->execute([(int)$_GET['del']]);
  redirect(['page'=>'admin','tab'=>'products']);
}
// Form edit
$edit=null;
if (isset($_GET['edit'])) { $st=$pdo->prepare("SELECT * FROM products WHERE id=?"); $st->execute([(int)$_GET['edit']]); $edit=$st->fetch(); }

$cats=$pdo->query("SELECT * FROM categories ORDER BY name")->fetchAll();
$list=$pdo->query("SELECT p.*, c.name AS cat FROM products p LEFT JOIN categories c ON c.id=p.category_id ORDER BY p.id DESC")->fetchAll();
?>
<form method="post" enctype="multipart/form-data" class="form" style="max-width:640px">
  <input type="hidden" name="id" value="<?= $edit['id'] ?? 0 ?>">
  <label>Tên SP <input name="name" value="<?= htmlspecialchars($edit['name'] ?? '') ?>" required></label>
  <label>Giá <input type="number" name="price" value="<?= $edit['price'] ?? '' ?>" min="0" step="1000" required></label>
  <label>Loại
    <select name="category_id">
      <?php foreach($cats as $c): ?>
      <option value="<?= $c['id'] ?>" <?= !empty($edit)&&$edit['category_id']==$c['id']?'selected':'' ?>><?= htmlspecialchars($c['name']) ?></option>
      <?php endforeach; ?>
    </select>
  </label>
  <label>Ảnh <input type="file" name="image"></label>
  <input type="hidden" name="image_old" value="<?= $edit['image'] ?? '' ?>">
  <?php if (!empty($edit['image'])): ?><img class="thumb" src="bt4/modules/shop/assets/img/<?= htmlspecialchars($edit['image']) ?>"><?php endif; ?>
  <label>Mô tả</label>
<textarea name="description" id="desc" rows="6"><?= $edit['description'] ?? '' ?></textarea>
  <div style="margin-top:8px">
    <button class="btn"><?= $edit ? 'Cập nhật' : 'Thêm mới' ?></button>
    <?php if ($edit): ?><a class="btn" href="<?= url(['page'=>'admin','tab'=>'products']) ?>">Hủy</a><?php endif; ?>
  </div>
</form>

<table class="table" style="margin-top:16px">
  <tr><th>ID</th><th>Ảnh</th><th>Tên</th><th>Loại</th><th>Giá</th><th>Thao tác</th></tr>
  <?php foreach($list as $p): ?>
  <tr>
    <td><?= $p['id'] ?></td>
    <td><?php if ($p['image']): ?><img class="thumb" src="bt4/modules/shop/assets/img/<?= htmlspecialchars($p['image']) ?>"><?php endif; ?></td>
    <td><?= htmlspecialchars($p['name']) ?></td>
    <td><?= htmlspecialchars($p['cat']) ?></td>
    <td><?= money($p['price']) ?></td>
    <td>
      <a href="<?= url(['page'=>'admin','tab'=>'products','edit'=>$p['id']]) ?>">Sửa</a> |
      <a onclick="return confirm('Xóa sản phẩm này?')" href="<?= url(['page'=>'admin','tab'=>'products','del'=>$p['id']]) ?>">Xóa</a>
    </td>
  </tr>
  <?php endforeach; ?>
</table>
<script src="https://cdn.ckeditor.com/4.22.1/standard/ckeditor.js"></script>
<script>
  // thay textarea#desc bằng CKEditor
  CKEDITOR.replace('desc', {
    height: 240,
    // có thể giản lược toolbar nếu muốn
    //removeButtons: 'Flash,Smiley,SpecialChar,PageBreak,Iframe'
  });
</script>

