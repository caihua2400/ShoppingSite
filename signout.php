<?php
include("session.php");
//destroy the sessions saved before.
session_destroy();
unset($_SESSION['session_user']); 
unset($_SESSION['session_access']);
//automatically go back to signin form
header('Location: ./Home.php');
?>
