<?php
$id = (int)($_GET['id'] ?? 0);
$st = $pdo->prepare("SELECT * FROM products WHERE id=?");
$st->execute([$id]);
$p = $st->fetch();
if (!$p) { echo "<p>Không tìm thấy sản phẩm.</p>"; return; }
?>
<div class="detail">
  <img class="detail-img" src="bt4/modules/shop/assets/img/<?= htmlspecialchars($p['image']) ?>" alt="">
  <div class="detail-info">
    <h2><?= htmlspecialchars($p['name']) ?></h2>
    <p class="price"><?= money($p['price']) ?></p>
    <div class="desc"><?= $p['description'] ?></div>

   <form method="get" action="<?= url(['page'=>'cart']) ?>">
  <input type="hidden" name="action" value="add">
  <input type="hidden" name="id" value="<?= $prod['id'] ?>">
  <input type="number" name="qty" value="1" min="1" style="width:80px">
  <a class="btn" href="<?= url(['page'=>'cart','action'=>'add','id'=>$p['id']]) ?>">Thêm giỏ hàng</a>
</form>


  </div>
</div>
