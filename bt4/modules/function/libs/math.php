<?php
// Một số helper chung

/** ép mảng string về mảng float, bỏ giá trị rỗng */
function toNumbers(array $arr): array {
  $out = [];
  foreach ($arr as $v) {
    if ($v === '' || $v === null) continue;
    $out[] = (float)$v;
  }
  return $out;
}

/** tổng mảng số */
function sum(array $nums): float {
  $s = 0;
  foreach ($nums as $n) $s += $n;
  return $s;
}

/** trung bình mảng số (rỗng thì 0) */
function avg(array $nums): float {
  return count($nums) ? sum($nums)/count($nums) : 0.0;
}
