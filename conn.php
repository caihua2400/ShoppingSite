<?php
$conn = new mysqli("localhost","root","","kit502");

if(mysqli_connect_errno())
{
echo "Error : ".mysqli_connect_error();
exit;
}
?>