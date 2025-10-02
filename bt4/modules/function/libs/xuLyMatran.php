<?php
require_once __DIR__.'/math.php';

/** Tìm max của ma trận 2 chiều */
function maxMatran(array $m) {
  $max = null;
  foreach ($m as $row) foreach ($row as $v) {
    $v = (float)$v;
    $max = $max===null ? $v : max($max, $v);
  }
  return $max;
}
/** Tìm min của ma trận 2 chiều */
function minMatran(array $m) {
  $min = null;
  foreach ($m as $row) foreach ($row as $v) {
    $v = (float)$v;
    $min = $min===null ? $v : min($min, $v);
  }
  return $min;
}
/** Tổng trên đường chéo chính */
function tongTrenCheoChinh(array $m): float {
  $n = count($m); $s = 0;
  for ($i=0; $i<$n; $i++) $s += (float)($m[$i][$i] ?? 0);
  return $s;
}
/** Tổng trên đường chéo phụ */
function tongTrenCheoPhu(array $m): float {
  $n = count($m); $s = 0;
  for ($i=0; $i<$n; $i++) $s += (float)($m[$i][$n-1-$i] ?? 0);
  return $s;
}
/** Cộng 2 ma trận cùng kích thước */
function tinhMatranTong(array $a, array $b): array {
  $r = [];
  $rows = count($a); $cols = count($a[0] ?? []);
  for ($i=0;$i<$rows;$i++){
    for ($j=0;$j<$cols;$j++){
      $r[$i][$j] = (float)($a[$i][$j] ?? 0) + (float)($b[$i][$j] ?? 0);
    }
  }
  return $r;
}
/** Nhân 2 ma trận (kích thước phù hợp) */
function tinhMatranTich(array $a, array $b): array {
  $ra = count($a); $ca = count($a[0] ?? []);
  $rb = count($b); $cb = count($b[0] ?? []);
  $r = array_fill(0,$ra,array_fill(0,$cb,0));
  if ($ca != $rb) return $r;
  for ($i=0;$i<$ra;$i++)
    for ($j=0;$j<$cb;$j++)
      for ($k=0;$k<$ca;$k++)
        $r[$i][$j] += (float)$a[$i][$k] * (float)$b[$k][$j];
  return $r;
}
/** render ma trận ra HTML monospace */
function renderMatran(array $m): string {
  $html = '<pre class="mono">';
  foreach ($m as $row) $html .= implode("\t", array_map(fn($v)=>rtrim(rtrim(number_format((float)$v, 2,'.',''), '0'), '.'), $row))."\n";
  return $html.'</pre>';
}
