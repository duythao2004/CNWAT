<?php
require_once __DIR__.'/math.php';

/** giá trị nhỏ nhất */
function minArr(array $nums) {
  return count($nums) ? min($nums) : null;
}
/** giá trị lớn nhất */
function maxArr(array $nums) {
  return count($nums) ? max($nums) : null;
}
/** trung bình cộng */
function avgDay(array $nums) {
  return avg($nums);
}
/** sắp tăng */
function sortDay(array $nums): array {
  $cp = $nums;
  sort($cp, SORT_NUMERIC);
  return $cp;
}
/** đảo ngược dãy */
function daoNguocDay(array $nums): array {
  return array_reverse($nums);
}
