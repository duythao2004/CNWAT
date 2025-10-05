<?php
$cntCats = $pdo->query("SELECT COUNT(*) FROM categories")->fetchColumn();
$cntProds= $pdo->query("SELECT COUNT(*) FROM products")->fetchColumn();
?>
<div class="grid" style="grid-template-columns:repeat(auto-fit,minmax(220px,1fr))">
  <div class="card"><h3>Tổng loại</h3><p style="font-size:28px;font-weight:700"><?= (int)$cntCats ?></p></div>
  <div class="card"><h3>Tổng sản phẩm</h3><p style="font-size:28px;font-weight:700"><?= (int)$cntProds ?></p></div>
</div>
