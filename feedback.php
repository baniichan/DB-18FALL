<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
  		<title>年度书单</title>

        <meta name="description" content="">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <link rel="stylesheet" href="css/templatemo-style.css">
    </head>

<body>

    <nav>
        <div class="logo">
            <a href="welcome.html"><font size="4" face="Times">返回个人页面</font></a>
        </div>
        <div class="menu-icon">
        <span></span>
      </div>
    </nav>

    <div id="video-container">
        <div class="video-overlay"></div>
        <div class="video-content">
            <div class="inner">
              <h1><font size="8" face="Times">不知不觉中，<em>我们即将挥别2018年</font></em></h1>
              <p><font size="6" face="Times">过去的365天有无数本书曾带给我们惊喜与感动!</font></p>
                <div class="scroll-icon">
                    <a class="scrollTo" data-scrollTo="portfolio" href="#"><img src="css/scroll-icon.png" alt=""></a>
                </div>    
            </div>
        </div>
        <video autoplay loop muted>
        	<source src="css/highway-loop.mp4" type="video/mp4" />
        </video>
    </div>

    <nav>
        <div class="logo">
           <a href="welcome.html"><font size="4" face="Times">返回个人页面</font></a>
        </div>
        <div class="menu-icon">
            <span></span>
        </div>
    </nav>
    
    <div id="video-container">
        <div class="video-overlay"></div>
        <div class="video-content">
            <div class="inner">
                <?php
                    $servername = "localhost";
                    $username = "root";
                    $password = "root";
                    $dbname = "book";
                    global $_userid;
                    $_userid = $_COOKIE['u_id'];
                    // 创建连接
                    $conn = mysqli_connect($servername, $username, $password, $dbname);
                    
                    // 设定字符集
                    mysqli_set_charset($conn, 'utf8');
                    
                    // 检测连接
                    if (!$conn)
                    {
                        die("Connection failed: " . mysqli_connect_error());
                    }
                $Year=2018;
                //top5
                $sql1 = "SELECT bookinfo.BookName,ANY_VALUE(bookinfo.type),SUM(orderdetail.quantity),(SUM(orderdetail.quantity)*ANY_VALUE(bookinfo.Price)) AS total FROM bookinfo,orderdetail,orderall WHERE bookinfo.ISBN=orderdetail.ISBN AND orderdetail.OrderNo=orderall.OrderNo AND orderall.UserNo=$_userid GROUP BY bookinfo.BookName ORDER BY total DESC LIMIT 0,5";
                if (mysqli_query($conn, $sql1) )
                {
                    echo "<font size=7 face=Times color=#FFFFFF><b>2018  这些是你最喜欢的书</b></font>";
                    echo "<br><br>";
                   
                    // size:40pt;
                } else {
                    echo "失败！". "<br>";
                    echo "Error: " . $sql1 . "<br>" . mysqli_error($conn);
                }
                
                $result = mysqli_query($conn,$sql1);
                $h=1;
                while($row = mysqli_fetch_array($result))
                {
                    $name=$row['BookName'];
                    echo "<font size=5 face=Times color=#FFFFFF><b>$h) $name</b></font>";
                    echo "<br>";
                    $h++;
                }
                echo "<br>";
               
                    ?>

                <div class="scroll-icon">
                    <a class="scrollTo" data-scrollTo="portfolio" href="#"><img src="css/scroll-icon.png" alt=""></a>
                </div>
            </div>
        </div>
        <video autoplay loop muted>
            <source src="css/highway-loop.mp4" type="video/mp4" />
        </video>
    </div>

<div id="video-container">
<div class="video-overlay"></div>
<div class="video-content">
<div class="inner">
<?php
    //总花费
    $sql1 = "SELECT SUM(orderdetail.quantity),SUM(orderdetail.totalPrice) FROM orderdetail,orderall WHERE orderdetail.OrderNo=orderall.OrderNo AND orderall.UserNo=$_userid AND  orderall.Year=$Year  ";
    if (mysqli_query($conn, $sql1) )
    {
        echo "<font size=7 face=Times color=#FFFFFF><b>2018</b></font>";
        echo "<br>";
    } else {
        echo "失败！". "<br>";
        echo "Error: " . $sql1 . "<br>" . mysqli_error($conn);
    }
    $result = mysqli_query($conn,$sql1);
    while($row = mysqli_fetch_array($result))
    {
        $a=$row['SUM(orderdetail.quantity)'];
        $b=$row['SUM(orderdetail.totalPrice)'];
        
    }
    echo "<font size=5 face=Times color=#FFFFFF><b>这一年你总共在书店购买了 $a 本书</b></font>";
    echo "<br>";
    echo "<font size=5 face=Times color=#FFFFFF><b>这一年你总共花费了 $b 元</b></font>";
    echo "<br>";

    ?>
<div class="scroll-icon">
<a class="scrollTo" data-scrollTo="portfolio" href="#"><img src="css/scroll-icon.png" alt=""></a>
</div>
</div>
</div>
<video autoplay loop muted>
<source src="css/highway-loop.mp4" type="video/mp4" />
</video>
</div>

<div id="video-container">
<div class="video-overlay"></div>
<div class="video-content">
<div class="inner">
<?php
    //花费最多的
    $sql2 = "SELECT bookinfo.BookName,ANY_VALUE(bookinfo.type),SUM(orderdetail.quantity) FROM bookinfo,orderdetail,orderall WHERE bookinfo.ISBN=orderdetail.ISBN AND orderdetail.OrderNo=orderall.OrderNo AND orderall.UserNo=$_userid GROUP BY bookinfo.BookName ORDER BY SUM(orderdetail.quantity) DESC";
    $result = mysqli_query($conn,$sql2);
    $row = mysqli_fetch_array($result);
    $name=$row['BookName'];
    echo "<font size=5 face=Times color=#FFFFFF><b>买的最多的一本书是：《 $name 》</b></font><br>";
    $sql2 = "SELECT bookinfo.BookName,MAX(bookinfo.price) FROM bookinfo,orderdetail,orderall WHERE bookinfo.ISBN=orderdetail.ISBN AND orderdetail.OrderNo=orderall.OrderNo AND orderall.UserNo=$_userid GROUP BY bookinfo.BookName";
    $result = mysqli_query($conn,$sql2);
    $row = mysqli_fetch_array($result);
    $name=$row['BookName'];
    echo "<font size=5 face=Times color=#FFFFFF><b>最贵的的一本书是：《 $name 》</b></font><br>";
    echo "<br>";
    
    ?>

<div class="scroll-icon">
<a class="scrollTo" data-scrollTo="portfolio" href="#"><img src="css/scroll-icon.png" alt=""></a>
</div>
</div>
</div>
<video autoplay loop muted>
<source src="css/highway-loop.mp4" type="video/mp4" />
</video>
</div>

<div id="video-container">
<div class="video-overlay"></div>
<div class="video-content">
<div class="inner">
<?php
    //类型
    echo '<br>';
    echo "<font size=5 face=Times color=#FFFFFF><b>你最常买的类型是： </b></font><br>";
    
    $sql5 = "SELECT * FROM customer_interest WHERE customer_interest.UserNo=$_userid";
    $result5 = mysqli_query($conn,$sql5);
    $row = mysqli_fetch_row($result5);
    $max=0;
    for ($x=1; $x<=13; $x++)
    {
        if($max<$row[$x]){
            $max=$row[$x];
            $c=$x;
        }
    }
    if($c==1){echo "<font size=6 face=Times color=#FFFFFF><b>诗歌</b></font><br>";
        echo"<font size=5 face=Times color=#FFFFFF><b>你的年度关键词是：<br><br><center><font size=6>性情</font></center><br>诗者，志之所之也<br><br>在心为志，发言为诗</b></font><br>";
    }
    if($c==2){echo "<font size=6 face=Times color=#FFFFFF><b>文学</b></font><br>";
        echo"<font size=5 face=Times color=#FFFFFF><b>你的年度关键词是：<br><br><center><font size=6>文艺</font></center><br>文学即人学<br><br>文字亦是力量</b></font><br>";
    }
    if($c==3){echo "<font size=6 face=Times color=#FFFFFF><b>散文</b></font><br>";
        echo"<font size=5 face=Times color=#FFFFFF><b>你的年度关键词是：<br><br><center><font size=6>慵懒</font></center><br>偷得浮生半日闲</b></font><br>";
    }
    if($c==4||$c==7){echo "<font size=6 face=Times color=#FFFFFF><b>小说</b></font><br>";
        echo"<font size=5 face=Times color=#FFFFFF><b>你的年度关键词是：<br><br><center><font size=6>奇幻</font></center><br>一个是镜中月，一个是水中花</b></font><br>";
    }
    if($c==5){echo "<font size=6 face=Times color=#FFFFFF><b>教材</b></font><br>";
        echo"<font size=5 face=Times color=#FFFFFF><b>你的年度关键词是：<br><br><center><font size=6>学习</font></center><br>不学习的人生还有什么意义？</b></font><br>";
    }
    if($c==6){echo "<font size=6 face=Times color=#FFFFFF><b>艺术</b></font><br>";
        echo"<font size=5 face=Times color=#FFFFFF><b>你的年度关键词是：<br><br><center><font size=6>品味</font></center><br>我的心略大于整个宇宙</b></font><br>";
    }
    if($c==8){echo "<font size=6 face=Times color=#FFFFFF><b>设计</b></font><br>";
        echo"<font size=5 face=Times color=#FFFFFF><b>你的年度关键词是：<br><br><center><font size=6>奇思</font></center><br>我的心略大于整个宇宙</b></font><br>";}
    if($c==9){echo "<font size=6 face=Times color=#FFFFFF><b>科技</b></font><br>";
        echo"<font size=5 face=Times color=#FFFFFF><b>你的年度关键词是：<br><br><center><font size=6>理性</font></center><br>思维与逻辑<br><br>理性与智慧</b></font><br>";
    }
    if($c==10){echo "<font size=6 face=Times color=#FFFFFF><b>哲学</b></font><br>";
        echo"<font size=5 face=Times color=#FFFFFF><b>你的年度关键词是：<br><br><center><font size=6>思辨</font></center><br>严谨缜密理性<br><br>是最极致的性感</b></font><br>";
    }
    if($c==11){echo "<font size=6 face=Times color=#FFFFFF><b>历史</b></font><br>";
        echo"<font size=5 face=Times color=#FFFFFF><b>你的年度关键词是：<br><br><center><font size=6>性情</font></center><br>微斯人，吾谁与归？</b></font><br>";
    }
    if($c==12){echo "<font size=6 face=Times color=#FFFFFF><b>人物传记</b></font><br>";
        echo"<font size=5 face=Times color=#FFFFFF><b>你的年度关键词是：<br><br><center><font size=6>性情</font></center><br>微斯人，吾谁与归？</b></font><br>";
    }
    if($c==13){echo "<font size=6 face=Times color=#FFFFFF><b>其他</b></font><br>";
        echo"<font size=5 face=Times color=#FFFFFF><b>你的年度关键词是：<br><br><center><font size=6>无常</font></center><br>人生无常，心安即是归处<br><br>一切有为之法，迁流无暂停</b></font><br>";
    }
    
    ?>

<div class="scroll-icon">
<a class="scrollTo" data-scrollTo="portfolio" href="#"><img src="css/scroll-icon.png" alt=""></a>
</div>
</div>
</div>
<video autoplay loop muted>
<source src="css/highway-loop.mp4" type="video/mp4" />
</video>
</div>

<div id="video-container">
<div class="video-overlay"></div>
<div class="video-content">
<div class="inner">
<?php
//日期
$sql33 = "SELECT SUM(orderdetail.Quantity) AS sum,SUM(orderdetail.totalPrice) AS total,Month,Day FROM orderdetail,orderall WHERE orderdetail.OrderNo=orderall.OrderNo AND orderall.UserNo=$_userid AND  orderall.Year=$Year GROUP BY orderall.Month,orderall.Day ORDER BY SUM(orderdetail.Quantity) DESC";
$result33 = mysqli_query($conn,$sql33);
$row = mysqli_fetch_array($result33);
$sum=$row['sum'];
$month=$row['Month'];
$day=$row['Day'];
echo '<br>';
echo "<font size=7 face=Times color=#FFFFFF><b>$Year 年 $month 月 $day 日</b></font>";
echo "<font size=5 face=Times color=#FFFFFF><center><br>大概是很特别的一天<br><br>这一天<br>你买了<br><br></font><center>";
$sql44 = "SELECT bookinfo.BookName FROM bookinfo,orderdetail,orderall WHERE bookinfo.ISBN=orderdetail.ISBN AND orderdetail.OrderNo=orderall.OrderNo AND orderall.UserNo=$_userid AND orderall.Year=$Year AND orderall.Month=$month AND orderall.Day=$day";
$result44 = mysqli_query($conn,$sql44);
while($row = mysqli_fetch_array($result44))
{
    $name=$row['BookName'];
    echo "<font size=5 face=Times color=#FFFFFF><b>$name</b></font>";
    echo "<br>";
   
}
echo "<font size=6 face=Times color=#FFFFFF><b><br>总共 $sum 本书</b></font>";
?>
<div class="scroll-icon">
<a class="scrollTo" data-scrollTo="portfolio" href="#"><img src="css/scroll-icon.png" alt=""></a>
</div>
</div>
</div>
<video autoplay loop muted>
<source src="css/highway-loop.mp4" type="video/mp4" />
</video>
</div>

<div id="video-container">
<div class="video-overlay"></div>
<div class="video-content">
<div class="inner">
<?php
$sql3 = "SELECT SUM(orderdetail.Quantity) AS sum,SUM(orderdetail.totalPrice) AS total,Month,Day FROM orderdetail,orderall WHERE orderdetail.OrderNo=orderall.OrderNo AND orderall.UserNo=$_userid AND  orderall.Year=$Year GROUP BY orderall.Month,orderall.Day ORDER BY SUM(orderdetail.totalPrice) DESC";
$result3 = mysqli_query($conn,$sql3);
$row = mysqli_fetch_array($result3);
$total=$row['total'];
$month=$row['Month'];
$day=$row['Day'];
echo "<font size=7 face=Times color=#FFFFFF><b>$Year 年 $month 月 $day 日</b></font>";
echo "<font size=5 face=Times color=#FFFFFF><center><br>你大概突然变得很有钱天<br><br>这一天<br>你买了<br><br></font><center>";
$sql4 = "SELECT bookinfo.BookName FROM bookinfo,orderdetail,orderall WHERE bookinfo.ISBN=orderdetail.ISBN AND orderdetail.OrderNo=orderall.OrderNo AND orderall.UserNo=$_userid AND orderall.Year=$Year AND orderall.Month=$month AND orderall.Day=$day";
$result4 = mysqli_query($conn,$sql4);
while($row = mysqli_fetch_array($result4))
{
    $name=$row['BookName'];
    echo "<font size=5 face=Times color=#FFFFFF><b>$name</b></font>";
    echo "<br>";
}
echo "<font size=6 face=Times color=#FFFFFF><b><br>总共花了 $total 元</b></font>";


mysqli_close($conn);
?>

<div class="scroll-icon">
<a class="scrollTo" data-scrollTo="portfolio" href="#"><img src="css/scroll-icon.png" alt=""></a>
</div>
</div>
</div>
<video autoplay loop muted>
<source src="css/highway-loop.mp4" type="video/mp4" />
</video>
</div>
</body>
</html>
