<?php
// Lấy tham số ?page=... từ URL
$page = $_GET['page'] ?? 'home';

// Đường dẫn file cần include
$file = __DIR__ . "/page/{$page}.php";
?>
<div class="card p-3">
  <nav class="chips">
    <a href="bt4/index.php?p=getpost&page=home">Home</a>
    <a href="bt4/index.php?p=getpost&page=drawTable">Draw Table</a>
    <a href="bt4/index.php?p=getpost&page=loop">Loop</a>
    <a href="bt4/index.php?p=getpost&page=calculate1">Calculate1</a>
    <a href="bt4/index.php?p=getpost&page=calculate2">Calculate2</a>
    <a href="bt4/index.php?p=getpost&page=array1">Array1</a>
    <a href="bt4/index.php?p=getpost&page=array2">Array2</a>
    <a href="bt4/index.php?p=getpost&page=uploadprocess">Upload Process</a>
  </nav>

  <section class="mt-3">
    <?php
    switch ($page) {
    case 'home':
        include 'page/home.php';
        break;
    case 'drawTable':
        include 'page/drawTable.php';
        break;
    case 'loop':
        include 'page/loop.php';
        break;
    case 'calculate1':
        include 'page/calculate1.php';
        break;
    case 'calculate2':
        include 'page/calculate2.php';
        break;
    case 'array1':
        include 'page/array1.php';
        break;
    case 'array2':
        include 'page/array2.php';
        break;
    case 'uploadprocess':
        include 'page/uploadprocess.php';
        break;
    default:
        echo "<p>Trang không tồn tại!</p>";
}
    ?>
  </section>
</div>
