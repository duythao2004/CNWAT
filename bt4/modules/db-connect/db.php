<?php
// bt4/modules/db-connect/db.php
function db(): PDO {
  static $pdo = null;
  if ($pdo) return $pdo;

  $host = '127.0.0.1';
  $db   = 'cnwat';
  $user = 'root';
  $pass = '';          // XAMPP/MAMP: 
  $dsn  = "mysql:host=$host;dbname=$db;charset=utf8mb4";

  $opt = [
    PDO::ATTR_ERRMODE            => PDO::ERRMODE_EXCEPTION,
    PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
  ];
  $pdo = new PDO($dsn, $user, $pass, $opt);
  return $pdo;
}
