<?php session_start();

echo "sessionid=>".session_id();
echo "<pre>";
print_r($_SESSION);

print_r($_COOKIE);
echo "</pre>";

?>