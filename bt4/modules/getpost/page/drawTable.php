<h2>Trang DrawTable</h2>
<form method="post">
    Số dòng: <input type="number" name="rows"><br>
    Số cột: <input type="number" name="cols"><br>
    <button type="submit">Vẽ</button>
</form>

<?php
if ($_POST) {
    $rows = intval($_POST['rows']);
    $cols = intval($_POST['cols']);
    echo "<table border=1>";
    for ($i=1;$i<=$rows;$i++) {
        echo "<tr>";
        for ($j=1;$j<=$cols;$j++) {
            echo "<td>$j</td>";
        }
        echo "</tr>";
    }
    echo "</table>";
}
?>
