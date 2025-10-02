<?php
$id = $_GET['id'] ?? '';
if ($id && delete_student($id)) {
  header('Location: index.php?p=file-data&page=list&msg=deleted');
  exit;
}
header('Location: index.php?p=file-data&page=list&msg=delete_fail');
exit;
