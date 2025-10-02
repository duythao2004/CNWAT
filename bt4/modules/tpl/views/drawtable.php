<h3>DrawTable</h3>
<table class="table">
  <thead><tr><th>TT</th><th>Mã</th><th>Tên sản phẩm</th></tr></thead>
  <tbody>
    <?php
      $rows = [
        ['SP001','Máy giặt'],
        ['SP002','Bếp đa năng'],
        ['SP003','Lò sưởi'],
        ['SP004','Điều hoà nhiệt độ'],
        ['SP005','Tủ lạnh'],
      ];
      $i=1; foreach($rows as $r): ?>
      <tr><td><?= $i++ ?></td><td><?= $r[0] ?></td><td><?= $r[1] ?></td></tr>
    <?php endforeach; ?>
  </tbody>
</table>
