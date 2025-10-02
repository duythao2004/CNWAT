<?php
// Huỷ session rồi đưa về trang Login (End-user)
$_SESSION = [];
if (ini_get('session.use_cookies')) {
  $params = session_get_cookie_params();
  setcookie(session_name(), '', time()-42000,
    $params['path'], $params['domain'],
    $params['secure'], $params['httponly']
  );
}
session_destroy();

header('Location: ' . BASE . 'bt4/index.php?p=session&page=login');
exit;
