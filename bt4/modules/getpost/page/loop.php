<h3>Loop – In tam giác bằng 3 cách</h3>
<p><em>For</em></p>
<pre class="mono">
<?php
for ($i=1; $i<=10; $i++) {
  echo str_repeat('*', $i)."\n";
}
?>
</pre>

<p><em>While</em></p>
<pre class="mono">
<?php
$i = 1;
while ($i<=10) {
  echo str_repeat('*', $i)."\n";
  $i++;
}
?>
</pre>

<p><em>Do…While</em></p>
<pre class="mono">
<?php
$i = 1;
do {
  echo str_repeat('*', $i)."\n";
  $i++;
} while ($i<=10);
?>
</pre>
