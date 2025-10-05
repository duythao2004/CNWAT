<?php
$action = $_GET['action'] ?? '';

if ($action === 'add') {
  require_login(); // bắt buộc đăng nhập
  $id  = (int)($_GET['id']  ?? 0);
  $qty = max(1, (int)($_GET['qty'] ?? 1));

  $st = $pdo->prepare("SELECT id FROM products WHERE id=?");
  $st->execute([$id]);
  if ($st->fetch()) {
    cart_add($id, $qty);
    redirect(['page'=>'cart','msg'=>'added']);
  } else {
    redirect(['page'=>'list']);
  }
  exit;
}

if ($action === 'remove') {
  cart_remove((int)($_GET['id'] ?? 0));
  redirect(['page'=>'cart']); exit;
}

if ($action === 'update' && $_SERVER['REQUEST_METHOD']==='POST') {
  foreach (($_POST['qty'] ?? []) as $pid => $q) cart_set((int)$pid,(int)$q);
  redirect(['page'=>'cart']); exit;
}

// Render giỏ
$cart = cart_all(); $items=[]; $total=0;
if ($cart) {
  $ids = array_keys($cart);
  $marks = implode(',', array_fill(0, count($ids), '?'));
  $st = $pdo->prepare("SELECT id,name,price,image FROM products WHERE id IN ($marks)");
  $st->execute($ids);
  $rows = $st->fetchAll();
  $map=[]; foreach($rows as $r) $map[$r['id']]=$r;
  foreach ($cart as $pid=>$qty) {
    if (!isset($map[$pid])) continue;
    $line=$map[$pid];
    $line['qty']=$qty;
    $line['line_total']=$qty*$line['price'];
    $total += $line['line_total'];
    $items[]=$line;
  }
}
?>
<h2>Giỏ hàng</h2>
<?php if (($_GET['msg'] ?? '')==='added'): ?>
  <div class="badge">Đã thêm sản phẩm vào giỏ.</div>
<?php endif; ?>

<?php if (!$items): ?>
  <p>Giỏ hàng trống.</p>
<?php else: ?>
<form method="post" action="<?= url(['page'=>'cart','action'=>'update']) ?>">
  <table class="table">
    <thead><tr><th>Ảnh</th><th>Tên</th><th>Giá</th><th>SL</th><th>Thành tiền</th><th></th></tr></thead>
    <tbody>
    <?php foreach ($items as $it): ?>
      <tr>
        <td><img src="bt4/modules/shop/assets/img/<?= htmlspecialchars($it['image']) ?>" style="height:48px"></td>
        <td><?= htmlspecialchars($it['name']) ?></td>
        <td><?= money($it['price']) ?></td>
        <td><input type="number" name="qty[<?= $it['id'] ?>]" value="<?= $it['qty'] ?>" min="0" style="width:60px"></td>
        <td><?= money($it['line_total']) ?></td>
        <td><a href="<?= url(['page'=>'cart','action'=>'remove','id'=>$it['id']]) ?>">Xoá</a></td>
      </tr>
    <?php endforeach; ?>
    </tbody>
  </table>
  <p><strong>Tổng:</strong> <?= money($total) ?></p>
  <button class="btn" type="submit">Cập nhật</button>
  <a class="btn" href="<?= url(['page'=>'list']) ?>">Tiếp tục mua</a>
</form>
<?php endif; ?>
