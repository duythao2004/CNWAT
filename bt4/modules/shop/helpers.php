<?php
if (session_status() === PHP_SESSION_NONE) session_start();

// TRỎ ĐÚNG entry của module shop TRÊN MÁY BẠN:
const SHOP_ENTRY = '/CNWAT/bt4/index.php?p=shop';

// Ghép URL an toàn
function url(array $params = []): string {
  if (!isset($params['page'])) $params['page'] = 'home';
  unset($params['p']); // tránh ghi đè module
  $baseHasQ = strpos(SHOP_ENTRY, '?') !== false;
  return SHOP_ENTRY . ($params ? ($baseHasQ ? '&' : '?') . http_build_query($params) : '');
}

function current_url(): string {
  $params = $_GET;
  if (isset($params['view']) && !isset($params['page'])) { // map legacy
    $params['page'] = $params['view']; unset($params['view']);
  }
  unset($params['p']);
  return url($params);
}

function redirect(array $params = []): void {
  $target = url($params);
  if (!headers_sent()) { header('Location: '.$target); exit; }
  // fallback nếu header đã gửi
  echo '<script>location.href='.json_encode($target).'</script>';
  echo '<noscript><meta http-equiv="refresh" content="0;url='.htmlspecialchars($target).'"></noscript>';
  exit;
}

function money($v){ return number_format($v,0,',','.') . ' đ'; }

/* Auth */
function login_user($u,$role='user'){ $_SESSION['shop_auth']=['name'=>$u,'role'=>$role]; }
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

/* Cart (SESSION) */
function cart_all(){ return $_SESSION['cart'] ?? []; }
function cart_add($id,$qty=1){ $_SESSION['cart'][$id] = (cart_all()[$id] ?? 0) + max(1,(int)$qty); }
function cart_set($id,$qty){ if($qty<=0) unset($_SESSION['cart'][$id]); else $_SESSION['cart'][$id]=(int)$qty; }
function cart_remove($id){ unset($_SESSION['cart'][$id]); }
function cart_clear(){ unset($_SESSION['cart']); }
