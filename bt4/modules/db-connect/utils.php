<?php
// bt4/modules/db-connect/utils.php
function redirect(string $url): never {
  header("Location: $url");
  exit;
}

function h($s) { return htmlspecialchars($s ?? '', ENT_QUOTES, 'UTF-8'); }

// Lấy giá trị from $_GET/$_POST
function param(string $key, $default = null) {
  return $_POST[$key] ?? $_GET[$key] ?? $default;
}
