<?php
require_once __DIR__.'/../libs/xuLyMatran.php';

// mặc định 3x3
$A = $B = array_fill(0,3,array_fill(0,3,''));
$kq = null;

if ($_SERVER['REQUEST_METHOD']==='POST') {
  $A = $_POST['A'] ?? $A;
  $B = $_POST['B'] ?? $B;

  // chuẩn hoá về số
  $An = array_map('toNumbers', $A);
  $Bn = array_map('toNumbers', $B);

  $kq = [
    'A_max' => maxMatran($An),
    'A_min' => minMatran($An),
    'A_trace' => tongTrenCheoChinh($An),
    'A_antitrace' => tongTrenCheoPhu($An),
    'sum'  => tinhMatranTong($An,$Bn),
    'prod' => tinhMatranTich($An,$Bn),
  ];
}
?>
<h3>Thao tác trên ma trận 2 chiều</h3>
<p>Nhập 2 ma trận 3×3 → bấm <b>Tính</b>. (Chỉ hiện kết quả khi bấm)</p>

<form method="post" class="stack">
  <div style="display:flex; gap:24px; flex-wrap:wrap">
    <fieldset>
      <legend>Nhập Ma trận 1 (A)</legend>
      <?php for($i=0;$i<3;$i++): ?>
        <div>
          <?php for($j=0;$j<3;$j++): ?>
            <input type="number" step="any" name="A[<?= $i ?>][]" value="<?= htmlspecialchars($A[$i][$j]) ?>"
                   style="width:80px">
          <?php endfor; ?>
        </div>
      <?php endfor; ?>
    </fieldset>

    <fieldset>
      <legend>Nhập Ma trận 2 (B)</legend>
      <?php for($i=0;$i<3;$i++): ?>
        <div>
          <?php for($j=0;$j<3;$j++): ?>
            <input type="number" step="any" name="B[<?= $i ?>][]" value="<?= htmlspecialchars($B[$i][$j]) ?>"
                   style="width:80px">
          <?php endfor; ?>
        </div>
      <?php endfor; ?>
    </fieldset>
  </div>

  <div>
    <button class="btn" type="reset">Nhập lại</button>
    <button class="btn" type="submit">Tính</button>
  </div>
</form>

<?php if ($kq): ?>
  <h4>KẾT QUẢ</h4>
  <ul>
    <li>Max(A): <strong><?= $kq['A_max'] ?></strong> • Min(A): <strong><?= $kq['A_min'] ?></strong></li>
    <li>∑ chéo chính A: <strong><?= $kq['A_trace'] ?></strong> • ∑ chéo phụ A: <strong><?= $kq['A_antitrace'] ?></strong></li>
  </ul>
  <div class="grid" style="display:grid;grid-template-columns:1fr 1fr;gap:16px">
    <div>
      <h5>Ma trận Tổng (A + B)</h5>
      <?= renderMatran($kq['sum']) ?>
    </div>
    <div>
      <h5>Ma trận Tích (A × B)</h5>
      <?= renderMatran($kq['prod']) ?>
    </div>
  </div>
<?php endif; ?>
