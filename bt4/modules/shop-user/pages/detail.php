<?php
$pdo = get_pdo();
$id = (int)($_GET['id'] ?? 0);
$stmt = $pdo->prepare("SELECT p.*, c.name AS cat_name FROM products p JOIN categories c ON c.id=p.category_id WHERE p.id=?");
$stmt->execute([$id]);
$p = $stmt->fetch();
if (!$p) { echo "<p>Không tìm thấy sản phẩm.</p>"; return; }
?>
<article class="product-detail">
  <div class="grid-2">
    <img src="bt4/modules/shop-user/uploads/<?= htmlspecialchars($p['image']) ?>" alt="<?= htmlspecialchars($p['name']) ?>" style="max-width:100%;height:auto">
    <div>
      <h2><?= htmlspecialchars($p['name']) ?></h2>
      <p>Danh mục: <strong><?= htmlspecialchars($p['cat_name']) ?></strong></p>
      <p class="price" style="font-size:20px"><?= number_format($p['price']) ?> đ</p>
      <p><?= nl2br(htmlspecialchars($p['full_desc'] ?: $p['short_desc'])) ?></p>
      <p><a class="btn" href="bt4/index.php?p=shop-user&act=list&cat=<?= $p['category_id'] ?>">⟵ Quay lại danh mục</a></p>
    </div>
  </div>
</article>
