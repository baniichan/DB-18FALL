<html>
<title>统计成功</title>
<body>
<?php
	session_start();
	$servername = "localhost";
	$username = "root";
	$password = "root";
	$dbname = "book";

	$_userid = $_COOKIE['u_id'];
	$xx;
	$yy;
	$max;
	$arr;
	
	// 创建连接
	$conn = mysqli_connect($servername, $username, $password, $dbname);

	// 设定字符集
	mysqli_set_charset($conn, 'utf8');

	//检测连接
	if (!$conn)
	{
	die("Connection failed: " . mysqli_connect_error());
	}
   
    //用户兴趣向量
    $No=$_userid;
    $sql = "SELECT * FROM customer_interest WHERE UserNo=$No";
    /*if (mysqli_query($conn, $sql))
    {
        echo "成功！";
    } else {
        echo "失败！". "<br>";
        echo "Error: " . $sql . "<br>" . mysqli_error($conn);
    }*/
    $result = mysqli_query($conn,$sql);
    while($row = mysqli_fetch_row($result))
    {
        for($i=0;$i<=13;$i++){
            //echo $row[$i]." " ;
            $arr[$i]=$row[$i];
        }}
            //echo $arr[2]." ";}
    //公式
    function cos1($arr2,$arr)
    {
		global $xx;
		global $yy;
        $xy=0;
        for($i=1;$i<=13;$i++){
        $xy+=$arr2[$i] * $arr[$i];
        $xx+=$arr2[$i] * $arr2[$i];
        $yy+=$arr[$i] * $arr[$i];
        }
        $m=$xy/(sqrt($xx)+sqrt($yy));
        return $m." ";
    }
    //计算和其余每一个相似度,并加入数组
    $sql4 = "SELECT * FROM customer_interest";
    $result4 = mysqli_query($conn,$sql4);
    $i=1;
	global $max;
	global $arr;
    while($row = mysqli_fetch_row($result4))
    {
        if($row[0]!=$No){
            $array[$i][0]=cos1($row,$arr);
            $array[$i][1]=$row[0];
            $i++;
            }
        }
    //echo count( $array);
    //排序
    function bubble_sort( $array)
    {
        $count = count( $array);
        if ($count <= 0 ) return false;
        for($i=1 ; $i<$count; $i++){
            for($j=1 ; $j<=$count-$i; $j++){
                if ($array[$j+1][0] > $array [$j][0]){
                    $tmp = $array[$j][0];
                    $num=$array[$j][1];
                    $array[$j][0] = $array[ $j+1][0];
                    $array[$j][1] = $array[ $j+1][1];
                    $array [$j+1][0] = $tmp;
                    $array[$j+1][1] = $num;
                }
            }
        }
        return $array;
    }
    $arr=bubble_sort($array);
    /*for($i=1;$i<=2;$i++){
        echo $arr[$i][0];
        echo $arr[$i][1];
        echo "<br>";}*/
    /*while($row = mysqli_fetch_row($result4))
    {
        if($row[0]!=$No){
            cos1($row,$arr);
            if(cos1($row,$arr)>$max){
                $max=cos1($row,$arr);
                $number=$row[0];
                echo "<br>";}
        }}
    echo $number." ";
    echo $max;
    echo "<br>";*/
   $a=$arr[1][1];
   $b=$arr[2][1];
   $c=$arr[3][1];
   //推荐相似度前三的用户购买的书（不含用户已购买）
    $sql1 = "SELECT DISTINCT(bookinfo.ISBN),bookinfo.BookName,bookinfo.type FROM bookinfo,orderdetail,orderall WHERE bookinfo.ISBN=orderdetail.ISBN AND orderdetail.OrderNo=orderall.OrderNo AND orderall.UserNo IN($a,$b,$c) AND bookinfo.BookName NOT IN (SELECT bookinfo.BookName FROM bookinfo,orderdetail,orderall WHERE bookinfo.ISBN=orderdetail.ISBN AND orderdetail.OrderNo=orderall.OrderNo AND orderall.UserNo=$No) ";
    $result1 = mysqli_query($conn,$sql1);
    echo '<div style="float:left; text-align:left"><a href="welcome.html">返回个人信息</div>';
    echo '<table border="1" width="900" align="center" cellpadding="10">';    // 表格样式
    echo '<caption><h1>猜你喜欢</h1></caption>';    // 表格标题
    while ($row = mysqli_fetch_array($result1)) {
        echo '<tr>';
        echo '<td>' . $row['ISBN'] . '</td>';
        echo '<td name="bookname">' . $row['BookName'] . '</td>';
        echo '<td name="type">' . $row['type'] . '</td>';
        $ISBN=$row['ISBN'];
        echo '<form name=form1 action="displayOneBook.php" method="post">';
        echo '<input name="ISBN" value=' . $ISBN . '   type="hidden">';
        echo  '<td>' . '<input name="submit" type="submit" value="该书详情">';
        echo '</form>';
        echo '</tr>';
    };
    echo "</table>";
    

    
	// 关闭连接
	mysqli_close($conn);
?>

</body>
</html>
