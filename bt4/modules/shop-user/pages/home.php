<?php
$pdo = get_pdo();

/*
  Lấy 2 sp mới nhất mỗi category:
  - Dùng window function ROW_NUMBER() (MySQL 8+)
*/
$sql = "
  SELECT p.*
  FROM (
    SELECT p.*, ROW_NUMBER() OVER(PARTITION BY p.category_id ORDER BY p.created_at DESC) AS rn
    FROM products p
  ) p
  WHERE p.rn <= 2
  ORDER BY p.category_id, p.created_at DESC
";
$rows = $pdo->query($sql)->fetchAll();

// gom theo category_id
$byCat = [];
foreach ($rows as $r) $byCat[$r['category_id']][] = $r;

// lấy tên category
$cats = $pdo->query("SELECT id,name FROM categories")->fetchAll();
$catName = [];
foreach ($cats as $c) $catName[$c['id']] = $c['name'];
?>

<?php foreach ($byCat as $cid => $list): ?>
  <h3><?= htmlspecialchars($catName[$cid] ?? 'Danh mục') ?></h3>
  <div class="cards">
    <?php foreach ($list as $p): ?>
      <article class="card product">
        <img src="bt4/modules/shop-user/uploads/<?= htmlspecialchars($p['image']) ?>" alt="<?= htmlspecialchars($p['name']) ?>" loading="lazy" style="width:180px;height:120px;object-fit:cover">
        <div>
          <h4><a href="bt4/index.php?p=shop-user&act=detail&id=<?= $p['id'] ?>"><?= htmlspecialchars($p['name']) ?></a></h4>
          <div class="price"><?= number_format($p['price']) ?> đ</div>
          <p class="muted"><?= htmlspecialchars($p['short_desc']) ?></p>
        </div>
      </article>
    <?php endforeach; ?>
  </div>
  <p><a class="chip" href="bt4/index.php?p=shop-user&act=list&cat=<?= $cid ?>">Xem thêm →</a></p>
  <hr>
<?php endforeach; ?>
