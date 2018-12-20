<!doctype html> 
<html> 
	<head> 
		<title>选择搜索类型</title> 
		<meta charset="utf-8">
	</head> 
	<body> 
<?php
	session_start();
    $searchtype = isset($_GET['type'])? htmlspecialchars($_GET['type']) : '';
    	if($searchtype == "bookname") {
			$_SESSION['query']=$_GET['word'];
			header('Location: searchBname.php');
		}
		else if($searchtype == "author"){
			$_SESSION['query']=$_GET['word'];
			header('Location: searchBauthor.php');
        }
 ?> 
	</body> 
</html>
