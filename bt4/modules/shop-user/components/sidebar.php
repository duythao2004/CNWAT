<?php
$pdo = get_pdo();
$cats = $pdo->query("SELECT id, name, slug FROM categories ORDER BY name")->fetchAll();
?>
<form action="bt4/index.php" method="get" class="stack" style="gap:8px">
  <input type="hidden" name="p" value="shop-user">
  <input type="hidden" name="act" value="search">
  <input name="q" placeholder="Từ khóa..." />
  <select name="cat">
    <option value="">-- Tất cả danh mục --</option>
    <?php foreach ($cats as $c): ?>
      <option value="<?= $c['id'] ?>"><?= htmlspecialchars($c['name']) ?></option>
    <?php endforeach; ?>
  </select>
  <button class="btn">Tìm kiếm</button>
</form>

<hr>

<h4>Danh mục</h4>
<ul class="v-list">
  <?php foreach ($cats as $c): ?>
    <li><a href="bt4/index.php?p=shop-user&act=list&cat=<?= $c['id'] ?>"><?= htmlspecialchars($c['name']) ?></a></li>
  <?php endforeach; ?>
</ul>
