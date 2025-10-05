<?php
$cats = $pdo->query("SELECT * FROM categories ORDER BY id")->fetchAll();
foreach ($cats as $cat):
  $st = $pdo->prepare("SELECT * FROM products WHERE category_id=? ORDER BY id DESC LIMIT 2");
  $st->execute([$cat['id']]);
  $prods = $st->fetchAll();
  if (!$prods) continue;
?>
<h2><?= htmlspecialchars($cat['name']) ?></h2>
<div class="grid">
  <?php foreach($prods as $p): ?>
    <div class="card">
      <img src="bt4/modules/shop/assets/img/<?= htmlspecialchars($p['image']) ?>" alt="">
      <h4><?= htmlspecialchars($p['name']) ?></h4>
      <p><?= money($p['price']) ?></p>
      <div class="row">
        <a class="btn" href="<?= url(['page'=>'detail','id'=>$p['id']]) ?>">Chi tiết</a>
        <a class="btn" href="<?= url(['page'=>'cart','action'=>'add','id'=>$p['id']]) ?>">Thêm giỏ</a>
      </div>
    </div>
  <?php endforeach; ?>
</div>
<?php endforeach; ?>
