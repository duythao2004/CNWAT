<?php
$cat = (int)($_GET['cat'] ?? 0);
$st = $pdo->prepare("SELECT * FROM products WHERE category_id=? ORDER BY id DESC");
$st->execute([$cat]);
$prods = $st->fetchAll();
?>
<h2>Danh mục #<?= $cat ?></h2>
<div class="grid">
<?php foreach ($prods as $p): ?>
  <div class="card">
    <img src="bt4/modules/shop/assets/img/<?= htmlspecialchars($p['image']) ?>" alt="">
    <h4><?= htmlspecialchars($p['name']) ?></h4>
    <p><?= money($p['price']) ?></p>
    <div class="row">
      <a class="btn" href="<?= url(['page'=>'detail','id'=>$p['id']]) ?>">Chi tiết</a>
      <a class="btn"
   href="<?= url(['page'=>'cart','action'=>'add','id'=>$p['id'],'qty'=>1]) ?>">
  Thêm giỏ
</a>

    </div>
  </div>
<?php endforeach; ?>
</div>
