<?php
// libs/data.php
const DATA_FILE = __DIR__ . '/../data/student1.txt';
const UPLOAD_DIR = __DIR__ . '/../uploads/';

// Bảo đảm thư mục & file tồn tại
if (!is_dir(dirname(DATA_FILE))) @mkdir(dirname(DATA_FILE), 0777, true);
if (!file_exists(DATA_FILE)) file_put_contents(DATA_FILE, ""); // tạo file rỗng
if (!is_dir(UPLOAD_DIR)) @mkdir(UPLOAD_DIR, 0777, true);

/**
 * Đọc toàn bộ sinh viên từ file.
 * Định dạng mỗi dòng: id|name|birthday|address|image|class
 * Trả về mảng: [ ['id'=>..,'name'=>.., ...], ... ]
 */
function load_students(): array {
  $rows = [];
  if (($fh = fopen(DATA_FILE, 'r')) !== false) {
    while (($line = fgets($fh)) !== false) {
      $line = trim($line);
      if ($line === '') continue;
      $parts = explode('|', $line);
      // phòng thiếu cột
      $parts = array_pad($parts, 6, '');
      [$id,$name,$birthday,$address,$image,$class] = $parts;
      $rows[] = compact('id','name','birthday','address','image','class');
    }
    fclose($fh);
  }
  return $rows;
}

/** Ghi đè toàn bộ danh sách vào file (mỗi item là 1 dòng pipe “|”). */
function save_students(array $rows): bool {
  $lines = [];
  foreach ($rows as $r) {
    $lines[] = implode('|', [
      $r['id'] ?? '',
      $r['name'] ?? '',
      $r['birthday'] ?? '',
      $r['address'] ?? '',
      $r['image'] ?? '',
      $r['class'] ?? '',
    ]);
  }
  return (bool)file_put_contents(DATA_FILE, implode("\n", $lines)."\n");
}


/** Tạo id đơn giản (timestamp + rand) */
function make_id(): string {
  return time().substr(strval(mt_rand(1000,9999)),0,4);
}

/** Tải ảnh: trả về tên file đã lưu (hoặc chuỗi rỗng). */
function handle_upload(string $field = 'image'): string {
  if (empty($_FILES[$field]['name'])) return '';
  $name = basename($_FILES[$field]['name']);
  $ext = strtolower(pathinfo($name, PATHINFO_EXTENSION));
  if (!in_array($ext, ['jpg','jpeg','png','gif','webp'])) return '';
  $fname = make_id().'.'.$ext;
  $ok = move_uploaded_file($_FILES[$field]['tmp_name'], UPLOAD_DIR.$fname);
  return $ok ? $fname : '';
}

/** Tìm một SV theo id */
function find_student(string $id): ?array {
  foreach (load_students() as $r) if ($r['id'] === $id) return $r;
  return null;
}
function delete_student(string $id): bool {
  $rows = load_students();
  $deleted = false;
  $imgToRemove = '';

  $rows = array_values(array_filter($rows, function($r) use ($id, &$deleted, &$imgToRemove) {
    if ($r['id'] === $id) {
      $deleted = true;
      $imgToRemove = $r['image'] ?? '';
      return false; // loại bản ghi này
    }
    return true;
  }));

  if ($deleted) {
    // xóa ảnh nếu có
    if ($imgToRemove && is_file(UPLOAD_DIR.$imgToRemove)) {
      @unlink(UPLOAD_DIR.$imgToRemove);
    }
    return save_students($rows);
  }
  return false;
}
