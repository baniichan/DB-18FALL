<!doctype html>
<html>
	<head>
		<meta charset="utf-8">
		<meta http-equiv="refresh" content="3;url=login_customer.html">
		<title>退出系统</title>
	</head>
		
	<body>
		
<?php
	if (isset($_COOKIE['u_id'])) {
		setcookie('u_id','$_userid',time()-1);
		header("Location: login_customer.html");
	}
	else{
		echo "您未登录，3秒后转至登录页";
	}
?>
		
	</body>
</html>