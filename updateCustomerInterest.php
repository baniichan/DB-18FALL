<!doctype html>
<html>
	<head>
	<meta charset="utf-8">
	<title>无标题文档</title>
	</head>
	<body>
		
<?php
	$_userid = $_COOKIE['u_id'];
/*———————————————————————————————————————————————————————————————————*/	
	$servername = "localhost";
	$username = "root";
	$password = "root";
	$dbname = "book";
	// 创建连接
	$conn = mysqli_connect($servername, $username, $password, $dbname);
	// 设定字符集
	mysqli_set_charset($conn, 'utf8');
	// 检测连接
	if (!$conn) {
		die("Connection failed: " . mysqli_connect_error());};
/*———————————————————————————————————————————————————————————————————*/ 
	// 用来确定图书类型计数
	$type = array("UserNo", "诗歌","文学","散文","小说","教材","艺术","外国小说","设计","科技","哲学","历史","人物传记","其他") ;
	// 记录用户购买的图书的类型
	$typeResult = array("0","0","0","0","0","0","0","0","0","0","0","0","0","0") ;
	// 图书类型计数结果
	$result = array("0","0","0","0","0","0","0","0","0","0","0","0","0","0") ;
/*———————————————————————————————————————————————————————————————————*/		
	// 查找最新数据：订单号 & 用户编号
	$newNo = mysqli_query($conn,"
		SELECT 
			*
		FROM
    		orderall
		ORDER BY 
			OrderNo DESC LIMIT 1");
	
	// 记录订单号 & 用户编号
	while($row = mysqli_fetch_array($newNo))
    {
		$orderno[0] = $row['OrderNo'];
		$userno[0] = $row['UserNo'];
		//echo "OrderNo: ".$orderno[0]. '<br>'. "Userno: ".$userno[0]. '<br>';
    }	
/*———————————————————————————————————————————————————————————————————*/	
	// 查找最新数据：图书类型
	$newType = mysqli_query($conn,"
		SELECT 
			bookinfo.type
		FROM 
			bookinfo, orderdetail
		WHERE
			orderdetail.orderno = $orderno[0] AND orderdetail.ISBN = bookinfo.ISBN");
	
	// 记录用户购买的图书的类型
	$j=0;
	while($row = mysqli_fetch_array($newType))
    {
		$typeResult[$j]=$row['type'];
		//echo "图书类型： ".$typeResult[$j]. "——j编号: ". $j.'<br>';
		$j++;	
    }	
/*———————————————————————————————————————————————————————————————————*/	
	// 查找最新数据：用户购买的图书的数量
	$qty = mysqli_query($conn,"
		SELECT
			orderdetail.quantity
		FROM
			orderdetail
		WHERE
			orderdetail.orderno = $orderno[0]");
		
	$j=0;
	// 记录用户购买的图书的数量
	while($row = mysqli_fetch_array($qty))
    {
		$quantity[$j]=$row['quantity']-1;
		//echo "图书数量： ".$quantity[$j]."——k编号： ".$j.'<br>';
		$j++;
    }	
		
	// 图书类型计数
	for($i=0;$i<=13;$i++){
		for($j=0;$j<=13;$j++){
			if($typeResult[$j] == $type[$i]){
				$result[$i] = $result[$i]+1+$quantity[$j];	
			}
		}
		//echo $result[$i];
	}
/*———————————————————————————————————————————————————————————————————*/	
	// 更新customer_interest
	for($i=0;$i<=13;$i++){
		if($result[$i] != 0){
			$sql2 = "
				UPDATE 
					customer_interest set $type[$i] = $type[$i]+$result[$i]
				WHERE 
					UserNo=$userno[0]
				";
			if (mysqli_query($conn, $sql2)) {
				echo "更新成功！<br>";
			}
			else {
				echo "更新失败！". "<br>";
				echo "Error: " . $sql . "<br>" . mysqli_error($conn);
			}
		}
	}
?>
		
	</body>
</html>