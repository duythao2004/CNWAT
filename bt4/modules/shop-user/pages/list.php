<?php
$pdo = get_pdo();
$cat = (int)($_GET['cat'] ?? 0);
$page = max(1, (int)($_GET['page'] ?? 1));
$limit = 8; $offset = ($page-1)*$limit;

$catRow = $pdo->prepare("SELECT * FROM categories WHERE id=?");
$catRow->execute([$cat]);
$catRow = $catRow->fetch();

if (!$catRow) { echo "<p>Không tìm thấy danh mục.</p>"; return; }

$stmt = $pdo->prepare("SELECT SQL_CALC_FOUND_ROWS * FROM products WHERE category_id=? ORDER BY created_at DESC LIMIT $limit OFFSET $offset");
$stmt->execute([$cat]);
$products = $stmt->fetchAll();
$total = (int)$pdo->query("SELECT FOUND_ROWS()")->fetchColumn();
$pages = max(1, (int)ceil($total/$limit));
?>

<h3><?= htmlspecialchars($catRow['name']) ?></h3>
<div class="cards">
  <?php foreach ($products as $p): ?>
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

<!-- phân trang -->
<nav class="pager">
  <?php for ($i=1;$i<=$pages;$i++): ?>
    <a class="chip <?= $i===$page?'active':'' ?>" href="bt4/index.php?p=shop-user&act=list&cat=<?= $cat ?>&page=<?= $i ?>"><?= $i ?></a>
  <?php endfor; ?>
</nav>
