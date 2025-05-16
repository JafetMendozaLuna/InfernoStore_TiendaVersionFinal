<?php
session_start();
session_destroy();
header("Location: /InfernoStore_Tienda/index.php");
exit;
?>
