<?php
// nếu submit -> nhúng file xử lý và kết thúc
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['register'])) {
  include __DIR__ . '/registerProcess.php';
  return; // không in lại form
}
?>

<h2>Form Đăng ký</h2>
<form method="post" action="">
  <label>Username:
    <input type="text" name="username" required>
  </label><br>

  <label>Password:
    <input type="password" name="password" required>
  </label><br>

  <label>Gender:
    <input type="radio" name="gender" value="Male"> Male
    <input type="radio" name="gender" value="Female"> Female
  </label><br>

  <label>Address:
    <select name="address">
      <option value="Ha Noi">Ha Noi</option>
      <option value="TP HCM">TP HCM</option>
      <option value="Hue">Hue</option>
      <option value="Da Nang">Da Nang</option>
    </select>
  </label><br>

  <label>Enable Programming Language:<br>
    <input type="checkbox" name="lang[]" value="PHP"> PHP
    <input type="checkbox" name="lang[]" value="C#"> C#
    <input type="checkbox" name="lang[]" value="Java"> Java
    <input type="checkbox" name="lang[]" value="C++"> C++
  </label><br>

  <label>Skill:
    <input type="radio" name="skill" value="Normal"> Normal
    <input type="radio" name="skill" value="Good"> Good
    <input type="radio" name="skill" value="Very Good"> Very Good
    <input type="radio" name="skill" value="Excellent"> Excellent
  </label><br>

  <label>Note:<br>
    <textarea name="note"></textarea>
  </label><br>

  <label>Marriage Status:
    <input type="checkbox" name="married" value="Yes"> Married
  </label><br>

  <button type="reset">Reset</button>
  <button type="submit" name="register">Register</button>
</form>
