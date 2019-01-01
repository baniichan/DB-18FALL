<?php
session_start();

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
    die("Connection failed: " . mysqli_connect_error());
}
$year=$_POST['year'];
//传入 年份选择，看哪年的图
$sql ="SELECT SUM(quantity),type 
          FROM orderAll ,orderdetail,bookinfo
          WHERE orderAll.year = '$year' and orderall.orderno= orderdetail.orderno and  bookinfo.ISBN=orderdetail.ISBN   
		  GROUP BY type ";
// 查询图书信息
$result = mysqli_query($conn,$sql);
//数组
$arrayType = array();
$arrayAmount = array();
$array_=array();

while ($row = mysqli_fetch_array($result)) {
    //echo var_dump($row);
	array_push($arrayType, $row['type']);
	array_push($arrayAmount, $row['SUM(quantity)']);
//echo '<br>';
};



//echo var_dump($arrayMonth);
//echo '<br>';
//echo var_dump($arrayAmount);
//echo "var arrayAmount="."'$arrayAmount';";
echo '<br>';
//echo "var arrayMonth="."'$arrayMonth';";

$arr1 = json_encode($arrayType);
$arr2 = json_encode($arrayAmount);
//echo sizeof($arrayAmount);
foreach($arrayType as $key=>$val)
{
	$d[$key]['name']=$arrayType[$key];
	$d[$key]['value']=$arrayAmount[$key];
}
//var_dump($d);
$arr3= json_encode($d);
?>

<!DOCTYPE html>
<head>
    <meta charset="utf-8">
    <title>ECharts</title>
</head>
<body>
    <!-- 为ECharts准备一个具备大小（宽高）的Dom -->
    <div id="main" style="height:400px"></div>
    <!-- ECharts单文件引入 -->
    <script src="http://echarts.baidu.com/build/dist/echarts.js"></script>
    <script type="text/javascript">
        // 路径配置
        require.config({
            paths: {
                echarts: 'http://echarts.baidu.com/build/dist'
            }
        });
        
        // 使用

			 
       require(
            [
                'echarts',
               'echarts/chart/pie',
				 'echarts/chart/funnel'// 使用柱状图就加载bar模块，按需加载
            ],
		   
            function (ec) {
                // 基于准备好的dom，初始化echarts图表
                var myChart = ec.init(document.getElementById('main')); 
                
                var option = {
    title : {
        text: '年度类型销量统计', 
        x:'center'
    },
    tooltip : {
        trigger: 'item',
        formatter: "{a} <br/>{b} : {c} ({d}%)"
    },
    legend: {
        orient : 'vertical',
        x : 'left',
        data:<?php echo $arr1; ?>
    },
    toolbox: {
        show : true,
        feature : {
            mark : {show: true},
            dataView : {show: true, readOnly: false},
            magicType : {
                show: true, 
                type: ['pie', 'funnel'],
                
            },
            restore : {show: true},
            saveAsImage : {show: true}
        }
    },
    calculable : true,
    series : [
        {
           name:'半径模式',
            type:'pie',
			
            radius : [50, 150],
            center : ['30%', 200],
			width: '40%',       // for funnel
            max: 40,            // for funnel
			roseType : 'radius',
             itemStyle : {
                normal : {
                    label : {
                        show : true
                    },
                    labelLine : {
                        show : true
                    }
                },
                emphasis : {
                    label : {
                        show : true
                    },
                    labelLine : {
                        show : true
                    }
                }
            },
            data:<?php echo $arr3; ?>
			text:'半径模式',
        }
    ,
			
			 
        {
            name:'面积模式',
            type:'pie',
            radius : [50, 150],
            center : ['70%', 200],
            roseType : 'area',
            x: '50%',               // for funnel
            max: 40,                // for funnel
            sort : 'ascending',     // for funnel
            itemStyle : {
                normal : {
                    label : {
                        show : true
                    },
                    labelLine : {
                        show : true
                    }
                },
                emphasis : {
                    label : {
                        show : true
                    },
                    labelLine : {
                        show : true
                    }
                }
            },
            data:  <?php echo $arr3; ?>
        }
		]
	};
        
			

                    

			// 为echarts对象加载数据
			myChart.setOption(option);
		}
				
		
	);
          
	
		
</script>
</body>
		