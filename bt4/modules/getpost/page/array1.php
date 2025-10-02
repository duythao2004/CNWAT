<?php
$N = 3;
$m1 = $m2 = [];
for ($r=0; $r<$N; $r++) {
  for ($c=0; $c<$N; $c++) {
    $m1[$r][$c] = $_POST['m1'][$r][$c] ?? '';
    $m2[$r][$c] = $_POST['m2'][$r][$c] ?? '';
  }
}
$ran = isset($_POST['calc']);

function toNum($v) { return $v === '' ? 0 : (float)$v; }

$sum = $diff = $prod = array_fill(0,$N,array_fill(0,$N,0));

if ($ran) {
  // tổng & hiệu
  for ($i=0;$i<$N;$i++){
    for($j=0;$j<$N;$j++){
      $a = toNum($m1[$i][$j]); $b = toNum($m2[$i][$j]);
      $sum[$i][$j]  = $a + $b;
      $diff[$i][$j] = $a - $b;
    }
  }
  // tích ma trận
  for ($i=0;$i<$N;$i++){
    for ($j=0;$j<$N;$j++){
      $s = 0;
      for ($k=0;$k<$N;$k++) $s += toNum($m1[$i][$k]) * toNum($m2[$k][$j]);
      $prod[$i][$j] = $s;
    }
  }
}
?>
<h3>Array 1 – Ma trận 3×3</h3>

<form method="post" action="bt4/index.php?p=getpost&page=array1">
  <div class="row gap-4">
    <div>
      <p><strong>Nhập Ma trận 1</strong></p>
      <table class="table">
        <?php for($i=0;$i<$N;$i++): ?>
          <tr>
            <?php for($j=0;$j<$N;$j++): ?>
              <td><input name="m1[<?= $i ?>][<?= $j ?>]" value="<?= htmlspecialchars($m1[$i][$j]) ?>" style="width:60px"></td>
            <?php endfor; ?>
          </tr>
        <?php endfor; ?>
      </table>
    </div>

    <div>
      <p><strong>Nhập Ma trận 2</strong></p>
      <table class="table">
        <?php for($i=0;$i<$N;$i++): ?>
          <tr>
            <?php for($j=0;$j<$N;$j++): ?>
              <td><input name="m2[<?= $i ?>][<?= $j ?>]" value="<?= htmlspecialchars($m2[$i][$j]) ?>" style="width:60px"></td>
            <?php endfor; ?>
          </tr>
        <?php endfor; ?>
      </table>
    </div>
  </div>

  <div class="mt-2">
    <button class="btn" name="calc" value="1">Tính</button>
    <a class="btn" href="bt4/index.php?p=getpost&page=array1">Nhập lại</a>
  </div>
</form>

<?php if ($ran): ?>
  <div class="mt-3 row gap-4">
    <div>
      <p><strong>Ma trận Tổng</strong></p>
      <pre class="mono"><?php foreach ($sum as $row) echo implode("\t", $row)."\n"; ?></pre>
    </div>
    <div>
      <p><strong>Ma trận Hiệu</strong></p>
      <pre class="mono"><?php foreach ($diff as $row) echo implode("\t", $row)."\n"; ?></pre>
    </div>
    <div>
      <p><strong>Ma trận Tích</strong></p>
      <pre class="mono"><?php foreach ($prod as $row) echo implode("\t", $row)."\n"; ?></pre>
    </div>
  </div>
<?php endif; ?>
