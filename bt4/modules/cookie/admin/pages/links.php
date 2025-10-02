<?php
// Quản lý danh sách link ưa thích bằng Cookie (JSON) – giống logic đã đưa,
// chỉ chuyển vào khung admin 4.5
require_once __DIR__ . '/../../_base.php';

$cookieName = 'fav_links';

// Đọc Cookie → mảng
$links = [];
if (!empty($_COOKIE[$cookieName])) {
  $decoded = json_decode($_COOKIE[$cookieName], true);
  if (is_array($decoded)) $links = $decoded;
}

$msg = '';
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
  if (isset($_POST['clear'])) {
    $links = [];
    set_app_cookie($cookieName, json_encode($links));
    $msg = 'Đã xoá danh sách link ưa thích.';
  } else {
    $title = trim($_POST['title'] ?? '');
    $url   = trim($_POST['url'] ?? '');
    if ($title && $url) {
      if (!preg_match('~^https?://~i', $url)) $url = 'http://' . $url;
      $links[] = ['title' => $title, 'url' => $url];
      set_app_cookie($cookieName, json_encode($links));
      $msg = 'Đã thêm link vào Cookie.';
    } else {
      $msg = 'Vui lòng nhập đủ Tiêu đề và URL.';
    }
  }
}
?>
<h3>Fav Links (Cookie)</h3>

<?php if ($msg): ?><p class="badge"><?= htmlspecialchars($msg) ?></p><?php endif; ?>

<?php if ($links): ?>
  <ul class="list">
    <?php foreach ($links as $it): ?>
      <li>
        <a href="<?= htmlspecialchars($it['url']) ?>" target="_blank" rel="noopener">
          <?= htmlspecialchars($it['title']) ?>
        </a>
        <span class="muted">— <?= htmlspecialchars($it['url']) ?></span>
      </li>
    <?php endforeach; ?>
  </ul>
<?php else: ?>
  <p class="muted">Chưa có link ưa thích nào.</p>
<?php endif; ?>

<form method="post" class="form" style="margin-top:12px">
  <div class="row">
    <label>Tiêu đề</label>
    <input name="title" placeholder="VD: Dân Trí">
  </div>
  <div class="row">
    <label>URL</label>
    <input name="url" placeholder="https://dantri.com.vn">
  </div>
  <div class="row">
    <button class="btn" type="submit">Add link</button>
    <button class="btn" type="submit" name="clear" value="1">Clear list</button>
  </div>
</form>
