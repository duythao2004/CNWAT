<?php
$pdo = get_pdo();
$q   = trim($_GET['q'] ?? '');
$cat = (int)($_GET['cat'] ?? 0);

$sql = "SELECT * FROM products WHERE 1";
$params = [];
if ($q !== '') { $sql .= " AND name LIKE ?"; $params[] = "%$q%"; }
if ($cat)     { $sql .= " AND category_id = ?"; $params[] = $cat; }
$sql .= " ORDER BY created_at DESC LIMIT 40";

$stmt = $pdo->prepare($sql);
$stmt->execute($params);
$rows = $stmt->fetchAll();
?>
<h3>Kết quả tìm kiếm</h3>
<p class="muted">Từ khóa: <b><?= htmlspecialchars($q) ?></b> <?= $cat ? "• Danh mục #$cat" : "" ?></p>

<?php if (!$rows): ?>
  <p>Không tìm thấy sản phẩm phù hợp.</p>
<?php else: ?>
  <div class="cards">
    <?php foreach ($rows as $p): ?>
      <article class="card product">
        <img src="bt4/modules/shop-user/uploads/<?= htmlspecialchars($p['image']) ?>" alt="<?= htmlspecialchars($p['name']) ?>" style="width:180px;height:120px;object-fit:cover">
        <div>
          <h4><a href="bt4/index.php?p=shop-user&act=detail&id=<?= $p['id'] ?>"><?= htmlspecialchars($p['name']) ?></a></h4>
          <div class="price"><?= number_format($p['price']) ?> đ</div>
          <p class="muted"><?= htmlspecialchars($p['short_desc']) ?></p>
        </div>
      </article>
    <?php endforeach; ?>
  </div>
<?php endif; ?>
