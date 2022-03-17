 <?php
$link = new mysqli("localhost","root","","wypozyczalnia");
if ($link -> connect_errno) {
  echo "Failed to connect to MySQL: " . $mysqli -> connect_error;
  exit();
}
?> 