<!DOCTYPE html>
<html>
<body>

  <h1>Image Files</h1>
<?php
$files = array();
echo "<ul>";
foreach (glob("*") as $file) {
  $files[] = $file;
  if ( strpos($file, '.php') || strpos($file, '.html') ){
    continue;
  }
  echo "<li style='display:inline-block;margin-right:1em;'>";
  echo "<a href='$file'>";
  echo "<h3>$file</h3>";
  echo "<iframe src='$file' style='width:320px;height:640px;background:whitesmoke'></iframe>";
  echo "</a>";
  echo "</li>";
}
echo "</ul>";
?>

</body>
</html>