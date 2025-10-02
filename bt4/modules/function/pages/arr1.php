<?php
require_once __DIR__.'/../libs/xuLyMangSo.php';

$values = array_fill(0, 10, '');     // mặc định 10 ô
$result = null;

if ($_SERVER['REQUEST_METHOD']==='POST') {
  // nhận mảng số từ input name="a[]"
  $values = $_POST['a'] ?? $values;
  $nums = toNumbers($values);

  $result = [
    'sum'   => sum($nums),
    'avg'   => avgDay($nums),
    'min'   => minArr($nums),
    'max'   => maxArr($nums),
    'sorted'=> sortDay($nums),
    'reversed' => daoNguocDay($nums),
  ];
}
?>
<h3>Thao tác trên mảng 1 chiều</h3>
<p>Nhập dãy số (tối đa 10 số) → bấm <b>Calculate</b>.</p>

<form method="post" class="stack">
  <div style="display:flex;flex-wrap:wrap;gap:6px">
    <?php for($i=0;$i<10;$i++): ?>
      <input type="number" step="any" name="a[]" value="<?= htmlspecialchars($values[$i]) ?>"
             style="width:90px" placeholder="số">
    <?php endfor; ?>
  </div>
  <div>
    <button class="btn" type="reset">Reset</button>
    <button class="btn" type="submit">Calculate</button>
  </div>
</form>

<?php if ($result): ?>
  <h4>KẾT QUẢ</h4>
  <ul>
    <li>Tổng: <strong><?= rtrim(rtrim(number_format($result['sum'],2,'.',''), '0'), '.') ?></strong></li>
    <li>Trung bình: <strong><?= rtrim(rtrim(number_format($result['avg'],2,'.',''), '0'), '.') ?></strong></li>
    <li>Min: <strong><?= $result['min'] ?></strong></li>
    <li>Max: <strong><?= $result['max'] ?></strong></li>
    <li>Sắp tăng: <code><?= implode(', ', $result['sorted']) ?></code></li>
    <li>Đảo dãy: <code><?= implode(', ', $result['reversed']) ?></code></li>
  </ul>
<?php endif; ?>
