<?php
// Chạy TRƯỚC khi render HTML (header, menu,...)

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $id   = (int)($_POST['id']   ?? 0);
    $name = trim($_POST['name']  ?? '');

    if ($name !== '') {
        if ($id) {
            $stmt = $pdo->prepare("UPDATE categories SET name=? WHERE id=?");
            $stmt->execute([$name, $id]);
        } else {
            $stmt = $pdo->prepare("INSERT INTO categories(name) VALUES(?)");
            $stmt->execute([$name]);
        }
    }
    // về lại tab Loại theo mô hình PRG (Post-Redirect-Get)
    redirect(['page'=>'admin','tab'=>'categories']);
}

if (isset($_GET['del'])) {
    $id = (int)$_GET['del'];
    $pdo->prepare("DELETE FROM categories WHERE id=?")->execute([$id]);
    redirect(['page'=>'admin','tab'=>'categories']);
}