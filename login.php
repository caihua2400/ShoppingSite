<html>

<head>
<meta charset="utf-8">

<title>Log in</title>	
</head>
<body>
<?php
include("conn.php");
include("session.php");

$user=$_POST['username'];
$password=$_POST['password'];
$q="select * from customers where Username='$user'";
$r=$conn->query($q);
$result=$r->fetch_assoc();
if($result['Username']!=$user)
{
	echo "<script>alert('error');window.location='./Home.php?error=invalid_username'</script>";
	
	
	}
	else
	{
		if($result['Password']==MD5($password))
		{
			$session_user=$result['Username'];
			$_SESSION['session_user']=$session_user;
			$session_access=$result['Access'];
			$_SESSION['session_access']=$session_access;
			echo "<script>alert('Log in successfully!'); window.location='./Home.php'</script>";

			}
			else
			{
				echo "<script>alert('error!');window.location='./Home.php?error=invalid_password'</script>";
}
		
		}
?>

</body>
</html>
