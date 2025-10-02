<?php
$file = __DIR__ . '/../data/student.txt';
$students = [];

// ====== SERVER LOGIC ======
// File có thể lưu kiểu 3 dòng / 1 sinh viên hoặc "A|B|C" trên 1 dòng.
// Ta đọc hết rồi tự nhận dạng.
if (is_file($file)) {
  $raw = trim(file_get_contents($file));
  if ($raw !== '') {
    $lines = preg_split('/\R/', $raw); // tách mọi loại xuống dòng
    // Nếu có dấu | => mỗi dòng 1 record
    if (strpos($raw, '|') !== false) {
      foreach ($lines as $ln) {
        [$ten, $dia, $tuoi] = array_map('trim', explode('|', $ln) + ['', '', '']);
        if ($ten !== '') $students[] = [$ten, $dia, $tuoi];
      }
    } else {
      // Group 3 dòng một sinh viên
      for ($i = 0; $i + 2 < count($lines); $i += 3) {
        $ten  = trim($lines[$i]);
        $dia  = trim($lines[$i + 1]);
        $tuoi = trim($lines[$i + 2]);
        if ($ten !== '') $students[] = [$ten, $dia, $tuoi];
      }
    }
  }
}
?>
<h3>Danh sách sinh viên (đọc từ file)</h3>
<?php if (!$students): ?>
  <p><i>Chưa có dữ liệu. Hãy thêm ở tab “Thêm mới”.</i></p>
<?php else: ?>
  <div class="table-wrap">
    <table class="table">
      <thead><tr><th>STT</th><th>Tên</th><th>Địa chỉ</th><th>Tuổi</th></tr></thead>
      <tbody>
      <?php foreach ($students as $i => $st): ?>
        <tr>
          <td><?= $i+1 ?></td>
          <td><?= htmlspecialchars($st[0]) ?></td>
          <td><?= htmlspecialchars($st[1]) ?></td>
          <td><?= htmlspecialchars($st[2]) ?></td>
        </tr>
      <?php endforeach; ?>
      </tbody>
    </table>
  </div>
<?php endif; ?>
