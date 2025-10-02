<?php
// router con trong module template: v = calculate | draw | register | contact
$view = $_GET['v'] ?? 'calculate';
$viewFile = __DIR__ . '/views/' . $view . '.php';
if (!is_file($viewFile)) $viewFile = __DIR__ . '/views/calculate.php';
?>
<section class="inner-hero card" style="padding-bottom:12px">
  <nav class="chips" aria-label="Tabs">
    <?php
      $tabs = [
        'calculate' => 'Calculate',
        'draw'      => 'DrawTable',
        'register'  => 'Register',
        'contact'   => 'Contact',
      ];
      foreach ($tabs as $k => $label):
        $active = $view === $k ? 'active' : '';
    ?>
      <a class="chip <?= $active ?>" href="bt4/index.php?p=tpl&v=<?= $k ?>"><?= $label ?></a>
    <?php endforeach; ?>
  </nav>
</section>

<div class="grid-3col">
  <!-- LEFT -->
  <aside class="left card" style="text-align:center">
    <img src="bt4/images/introduction.jpg" alt="" style="max-width:100%;height:auto;margin-bottom:14px">
    <img src="bt4/images/flowers.jpg" alt="" style="max-width:70%;height:auto">
  </aside>

  <!-- CENTER -->
  <section class="center card">
    <?php include $viewFile; ?>
  </section>

  <!-- RIGHT -->
  <aside class="right card" style="min-height:120px">
    <!-- bạn có thể để ghi chú / quảng cáo / gì đó ở đây -->
  </aside>
</div>

<!-- footer dải màu cho module -->
<?php include __DIR__ . '/views/stripe-footer.php'; ?>

<style>
/* lưới 3 cột ăn theo style chung */
.grid-3col{display:grid;grid-template-columns:240px 1fr 240px;gap:14px;margin-top:14px}
@media (max-width: 900px){.grid-3col{grid-template-columns:1fr;}}
.center h3{margin-top:0}
</style>
