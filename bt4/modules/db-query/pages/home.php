<?php
// Lấy danh sách lớp
$stmt = db()->query("SELECT ID, ClassName FROM classes ORDER BY ClassName");
$classes = $stmt->fetchAll();
?>
<div class="grid-2">
  <aside>
    <h4>Danh sách các lớp (cách 1):</h4>
    <ul>
      <?php foreach ($classes as $c): ?>
        <li>
          <a href="bt4/index.php?p=db-query&page=listStudentsInClass&class=<?= $c['ID'] ?>">
            <?= htmlspecialchars($c['ClassName']) ?>
          </a>
        </li>
      <?php endforeach; ?>
    </ul>

    <h4>Danh sách các lớp (cách 2):</h4>
    <?php foreach ($classes as $c): ?>
      <div>
        <a href="bt4/index.php?p=db-query&page=listStudentsInClass&class=<?= $c['ID'] ?>">
          <?= htmlspecialchars($c['ClassName']) ?>
        </a>
      </div>
    <?php endforeach; ?>

    <h4>Danh sách các lớp (cách 3):</h4>
    <p class="chips">
      <?php foreach ($classes as $c): ?>
        <a class="chip"
           href="bt4/index.php?p=db-query&page=listStudentsInClass&class=<?= $c['ID'] ?>">
           <?= htmlspecialchars($c['ClassName']) ?>
        </a>
      <?php endforeach; ?>
    </p>
  </aside>

  <main>
    <h3>DANH SÁCH SINH VIÊN TRONG LỚP</h3>
    <p>Hãy bấm vào một lớp ở cột trái để xem danh sách sinh viên.</p>
  </main>
</div>
