<?php
// 10!
$gt = 1; for ($i=1;$i<=10;$i++) $gt *= $i;

// hình tròn & khối cầu r=10
$r = 10;
$area   = M_PI * $r * $r;
$volume = 4/3 * M_PI * $r ** 3;
?>

<ul>
  <li>10! = <strong><?= $gt ?></strong></li>
  <li>Diện tích hình tròn (r=10): <strong><?= round($area,2) ?></strong></li>
  <li>Thể tích khối cầu (r=10): <strong><?= round($volume,2) ?></strong></li>
</ul>

<div class="hello-wrap">
  <span class="hello">Hello</span>
</div>

<style>
.hello-wrap{position:relative;overflow:hidden;height:40px;border:1px dashed #e5e7eb;border-radius:10px}
.hello{position:absolute;left:-80px;top:8px;font-weight:700;animation:mar 5s linear infinite}
@keyframes mar{from{left:-80px} to{left:calc(100% + 80px)}}
</style>
