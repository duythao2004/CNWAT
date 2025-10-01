<?php
function getDB(): PDO {
  static $pdo;
  if ($pdo) return $pdo;
  $cfg = file_exists(__DIR__.'/config.php')
    ? require __DIR__.'/config.php'
    : require __DIR__.'/config.sample.php';
  $pdo = new PDO($cfg['dsn'], $cfg['user'], $cfg['pass'], [
    PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
    PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
  ]);
  return $pdo;
}
