<?php
// bt4/modules/shop/helpers.php

// Đường dẫn vào module shop — CHỈNH cho đúng host của bạn
const SHOP_ENTRY = '/CNWAT/bt4/index.php?p=shop';

// Ghép query an toàn (tự chọn ? hoặc &)
function build_entry_with_params(array $params): string {
    $sep = (strpos(SHOP_ENTRY, '?') !== false) ? '&' : '?';
    return SHOP_ENTRY . ($params ? $sep . http_build_query($params) : '');
}

// Luôn dùng tham số "page"
function url(array $params = []): string {
    if (!isset($params['page'])) $params['page'] = 'home';
    unset($params['p']); // tránh p=shop lẫn vào
    return build_entry_with_params($params);
}

function current_url(): string {
    $params = $_GET;
    // map legacy ?view=x -> ?page=x
    if (isset($params['view']) && !isset($params['page'])) {
        $params['page'] = $params['view'];
        unset($params['view']);
    }
    unset($params['p']);
    return url($params);
}

// Redirect an toàn (kể cả khi header đã gửi)
function redirect(array $params = []): void {
    $target = url($params);
    if (!headers_sent()) {
        header('Location: ' . $target);
        exit;
    }
    // Fallback khi header đã bị gửi
    echo '<script>location.href='.json_encode($target).';</script>';
    echo '<noscript><meta http-equiv="refresh" content="0;url='.htmlspecialchars($target).'"></noscript>';
    exit;
}

function money($v){ return number_format($v, 0, ',', '.') . ' đ'; }

/* ==== Auth & Role ==== */
function login_user($username, $role='user'){ $_SESSION['shop_auth']=['name'=>$username,'role'=>$role]; }
function logout_user(){ unset($_SESSION['shop_auth']); }
function is_logged(){ return !empty($_SESSION['shop_auth']); }
function user_name(){ return $_SESSION['shop_auth']['name'] ?? ''; }
function user_role(){ return $_SESSION['shop_auth']['role'] ?? null; }
function is_admin(){ return user_role()==='admin'; }

function require_login(string $next=null): void {
  if (!is_logged()) {
    if ($next===null) $next = current_url();
    redirect(['page'=>'login','next'=>$next]);
  }
}
function require_admin(): void {
  require_login(url(['page'=>'admin','tab'=>'dashboard']));
  if (!is_admin()) redirect(['page'=>'home']);
}

/* ==== Cart helpers ==== */
function cart_all(){ return $_SESSION['cart'] ?? []; }
function cart_add($id,$qty=1){ $_SESSION['cart'][$id] = (cart_all()[$id] ?? 0) + max(1,(int)$qty); }
function cart_set($id,$qty){ if($qty<=0) unset($_SESSION['cart'][$id]); else $_SESSION['cart'][$id]=(int)$qty; }
function cart_remove($id){ unset($_SESSION['cart'][$id]); }
function cart_clear(){ unset($_SESSION['cart']); }
