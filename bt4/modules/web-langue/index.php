<?php
// ----- Khởi động i18n (session + helpers) -----
require __DIR__ . '/libs/i18n.php';
i18n_boot();

// Xử lý chọn ngôn ngữ (?lang=en|vi) -> lưu session rồi quay về trang hiện tại (bỏ lang khỏi url)
if (isset($_GET['lang'])) {
  i18n_set($_GET['lang']);
  $back = preg_replace('/(&|\?)lang=(en|vi)\b/', '', $_SERVER['REQUEST_URI']);
  // dọn dấu & hoặc ? thừa
  $back = rtrim($back, '&?');
  header("Location: $back");
  exit;
}

// Tabs (page con trong module)
$tabs = [
  'home'         => t('TAB_HOME'),
  'contact'      => t('TAB_CONTACT'),
  'introduction' => t('TAB_INTRO'),
  'login'        => t('TAB_LOGIN'),
];

$page = $_GET['page'] ?? 'home';
$file = __DIR__ . "/pages/{$page}.php";
if (!is_file($file)) $file = __DIR__ . "/pages/home.php";
?>
<section class="inner-hero card" style="display:flex;align-items:center;gap:12px;justify-content:space-between">
  <nav class="chips" aria-label="web-language pages">
    <?php foreach ($tabs as $k => $label): ?>
      <a class="chip <?= $page===$k?'active':'' ?>" href="bt4/index.php?p=web-langue&page=<?= $k ?>"><?= htmlspecialchars($label) ?></a>
    <?php endforeach; ?>
  </nav>

  <!-- switch language -->
  <div class="chips">
    <a class="chip <?= i18n_lang()==='vi'?'active':'' ?>" href="bt4/index.php?p=web-langue&page=<?= urlencode($page) ?>&lang=vi">Tiếng Việt</a>
    <a class="chip <?= i18n_lang()==='en'?'active':'' ?>" href="bt4/index.php?p=web-langue&page=<?= urlencode($page) ?>&lang=en">English</a>
  </div>
</section>

<section class="card">
  <?php include $file; ?>
</section>
