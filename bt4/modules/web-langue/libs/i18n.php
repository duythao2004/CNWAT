<?php
// Helpers i18n đơn giản, dùng session để lưu ngôn ngữ, load file lang thành hằng số/array

function i18n_boot(): void {
  if (session_status() === PHP_SESSION_NONE) session_start();
  if (empty($_SESSION['lang'])) $_SESSION['lang'] = 'vi'; // mặc định
  i18n_load($_SESSION['lang']);
}

function i18n_set(string $lang): void {
  $lang = in_array($lang, ['vi','en'], true) ? $lang : 'vi';
  $_SESSION['lang'] = $lang;
  i18n_load($lang);
}

function i18n_lang(): string {
  return $_SESSION['lang'] ?? 'vi';
}

function i18n_load(string $lang): void {
  $file = __DIR__ . "/../lang/{$lang}.php";
  $GLOBALS['__I18N__'] = is_file($file) ? require $file : [];
}

/** Lấy chuỗi dịch theo key, nếu thiếu trả về chính key */
function t(string $key): string {
  $dict = $GLOBALS['__I18N__'] ?? [];
  return $dict[$key] ?? $key;
}
