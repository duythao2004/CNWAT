<?php
// Huỷ session rồi về Login end-user (giống 4.5 Session)
session_start();
require_once __DIR__ . '/../../_base.php';

$_SESSION = [];
if (ini_get('session.use_cookies')) {
  $params = session_get_cookie_params();
  setcookie(session_name(), '', time()-42000,
    $params['path'], $params['domain'], $params['secure'], $params['httponly']
  );
}
session_destroy();

// (tuỳ yêu cầu) giữ lại Cookie ghi nhớ tài khoản, nên không xoá last_user/last_pass
// Nếu muốn xoá cả ghi nhớ, bỏ comment:
// set_app_cookie('last_user','',-1);
// set_app_cookie('last_pass','',-1);

redirect('bt4/index.php?p=cookie&page=login');
