<?php
session_start();
session_unset();
session_destroy();
echo'Logging out. Please wait ...';
header("Location: /forum/index.php");
?>