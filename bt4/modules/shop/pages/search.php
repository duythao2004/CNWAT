<?php
$q   = trim($_GET['q']   ?? '');
$cat = (int)($_GET['cat'] ?? 0);

$where=[]; $params=[];
if ($q !== '') {
  $like = str_replace(['%','_'], ['\%','\_'], $q);
  $where[]="name LIKE ? ESCAPE '\\\\'"; $params[]="%$like%";
}
if ($cat > 0) { $where[]="category_id=?"; $params[]=$cat; }

$prods=[];
if ($where) {
  $sql = "SELECT * FROM products WHERE ".implode(' AND ',$where)." ORDER BY id DESC";
  $st = $pdo->prepare($sql); $st->execute($params); $prods=$st->fetchAll();
}
?>
<h2>
  Tìm kiếm
  <?php if ($q!==''): ?> cho “<?= htmlspecialchars($q) ?>”<?php endif; ?>
  <?php if ($cat>0): ?> · Loại <?= $cat ?><?php endif; ?>
</h2>

<?php if (!$where): ?>
  <p>Nhập từ khóa hoặc chọn loại sản phẩm để tìm.</p>
<?php elseif (!$prods): ?>
  <p>Không tìm thấy sản phẩm phù hợp.</p>
<?php else: ?>
  <div class="grid">
    <?php foreach($prods as $p): ?>
    <div class="card">
      <img src="bt4/modules/shop/assets/img/<?= htmlspecialchars($p['image']) ?>" alt="">
      <h4><?= htmlspecialchars($p['name']) ?></h4>
      <p><?= money($p['price']) ?></p>
      <a class="btn" href="<?= url(['page'=>'detail','id'=>$p['id']]) ?>">Chi tiết</a>
    </div>
    <?php endforeach; ?>
  </div>
<?php endif; ?>
