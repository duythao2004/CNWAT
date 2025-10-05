<?php
// --- Lấy input ---
$q   = trim($_GET['q'] ?? '');
$cat = (int)($_GET['cat'] ?? 0);

// --- Lấy danh mục để render select ---
$cats = $pdo->query("SELECT id,name FROM categories ORDER BY name")->fetchAll();

// --- Build điều kiện ---
$where  = [];
$params = [];

if ($q !== '') {
  // Tự escape ký tự đặc biệt của LIKE
  $like = str_replace(['%','_'], ['\%','\_'], $q);
  // Tìm trong name OR description
  $where[] = "(name LIKE ? OR description LIKE ?)";
  $params[] = "%$like%";
  $params[] = "%$like%";
}
if ($cat > 0) {
  $where[] = "category_id = ?";
  $params[] = $cat;
}

// --- Query ---
$prods = [];
if ($where) {
  $sql = "SELECT * FROM products WHERE ".implode(' AND ', $where)." ORDER BY id DESC";
  // Bật exception trong db.php: $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
  $st = $pdo->prepare($sql);
  $st->execute($params);
  $prods = $st->fetchAll();
}
?>

<!-- Form tìm kiếm: đặt NGAY trong trang search -->
<form method="get" action="/CNWAT/bt4/index.php">
  <input type="hidden" name="p" value="shop">
  <input type="hidden" name="page" value="search">
  <input name="q" placeholder="Nhập từ khóa..." value="<?= htmlspecialchars($_GET['q'] ?? '') ?>">
  <select name="cat">
    <option value="0">-- Tất cả loại --</option>
    <?php foreach ($cats as $c): ?>
      <option value="<?= $c['id'] ?>" <?= ((int)($_GET['cat'] ?? 0) === (int)$c['id']) ? 'selected' : '' ?>>
        <?= htmlspecialchars($c['name']) ?>
      </option>
    <?php endforeach; ?>
  </select>
  <button type="submit" class="btn">Tìm</button>
</form>

<h2>
  Kết quả tìm kiếm
  <?php if ($q !== ''): ?> cho “<?= htmlspecialchars($q) ?>”<?php endif; ?>
  <?php if ($cat > 0): ?> · Loại #<?= $cat ?><?php endif; ?>
</h2>

<?php if (!$where): ?>
  <p>Nhập từ khóa hoặc chọn loại sản phẩm để tìm.</p>

<?php elseif (!$prods): ?>
  <p>Không tìm thấy sản phẩm phù hợp.</p>

<?php else: ?>
  <div class="grid">
    <?php foreach ($prods as $p): ?>
      <div class="card">
        <img src="bt4/modules/shop/assets/img/<?= htmlspecialchars($p['image']) ?>" alt="">
        <h4><?= htmlspecialchars($p['name']) ?></h4>
        <p><?= money($p['price']) ?></p>

        <div class="row">
          <a class="btn" href="<?= url(['page'=>'detail','id'=>$p['id']]) ?>">Chi tiết</a>
          <!-- Thêm nhanh vào giỏ -->
          <a class="btn" href="<?= url(['page'=>'cart','action'=>'add','id'=>$p['id'],'qty'=>1]) ?>">Thêm giỏ</a>
        </div>
      </div>
    <?php endforeach; ?>
  </div>
<?php endif; ?>
