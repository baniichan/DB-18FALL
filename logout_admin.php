<!doctype html>
<html>
	<head>
		<meta charset="utf-8">
		<meta http-equiv="refresh" content="3;url=login_admin.html">
		<title>退出系统</title>
	</head>
		
	<body>
		
<?php
	if (isset($_COOKIE['a_id'])) {
		setcookie('a_id','$_adminid',time()-1);
		header("Location: login_admin.html");
	}
	else{
		echo "您未登录，3秒后转至登录页";
	}
?>
		
	</body>
</html>