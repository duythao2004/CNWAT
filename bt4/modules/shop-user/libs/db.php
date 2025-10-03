<?php
// Kết nối PDO dùng lại cho mọi trang trong module
function get_pdo(): PDO {
  static $pdo = null;
  if ($pdo) return $pdo;
  $pdo = new PDO(
    'mysql:host=localhost;dbname=cnwat;charset=utf8mb4',
    'root', '', // đổi user/pass nếu khác
    [ PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
      PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC ]
  );
  return $pdo;
}
