<h3>Array 2 – Upload nhiều file</h3>

<form method="post"
      action="bt4/index.php?p=getpost&page=uploadprocess"
      enctype="multipart/form-data"
      class="stack gap-2">

  <?php for ($i=1; $i<=10; $i++): ?>
    <label>File <?= $i ?>:
      <input type="file" name="files[]">
    </label><br>
  <?php endfor; ?>

  <div class="row gap-2">
    <button class="btn" type="submit" name="submit" value="1">Upload</button>
    <button class="btn" type="reset">Reset</button>
  </div>
</form>
