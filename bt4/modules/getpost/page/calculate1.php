<?php
$a = isset($_POST['a']) ? (float)$_POST['a'] : null;
$b = isset($_POST['b']) ? (float)$_POST['b'] : null;
$ops = isset($_POST['ops']) && is_array($_POST['ops']) ? $_POST['ops'] : [];
$done = isset($_POST['run']);
?>
<h3>Calculate 1</h3>

<form method="post" action="bt4/index.php?p=getpost&page=calculate1" class="stack gap-2">
  <label>Số a:
    <input type="number" step="any" name="a" value="<?= htmlspecialchars((string)$a) ?>">
  </label>
  <label>Số b:
    <input type="number" step="any" name="b" value="<?= htmlspecialchars((string)$b) ?>">
  </label>

  <div>
    <strong>Phép tính</strong>:
    <?php
      $choices = ['+' => 'Cộng', '-' => 'Trừ', '*' => 'Nhân', '/' => 'Chia'];
      foreach ($choices as $k => $label):
    ?>
      <label style="margin-right:10px">
        <input type="checkbox" name="ops[]" value="<?= $k ?>" <?= in_array($k, $ops)?'checked':'' ?>>
        <?= $k ?>
      </label>
    <?php endforeach; ?>
  </div>

  <button class="btn" name="run" value="1">Calculate</button>
</form>

<?php if ($done && $ops && $a !== null && $b !== null): ?>
  <div class="mt-3 card p-2">
    <h4>Kết quả</h4>
    <ul>
      <?php
      foreach ($ops as $op) {
        switch ($op) {
          case '+': $res = $a + $b; break;
          case '-': $res = $a - $b; break;
          case '*': $res = $a * $b; break;
          case '/': $res = ($b==0 ? 'Không chia được cho 0' : $a / $b); break;
          default: $res = 'N/A';
        }
        echo "<li><code>$a $op $b = $res</code></li>";
      }
      ?>
    </ul>
  </div>
<?php elseif ($done): ?>
  <p class="text-warn">Hãy nhập a, b và chọn ít nhất 1 phép tính.</p>
<?php endif; ?>
