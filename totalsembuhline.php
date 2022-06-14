<?php 
include ('koneksi.php'); 
	$covid = mysqli_query($koneksi,"select * from tb_covid"); 
	while ($row = mysqli_fetch_array($covid) ) {
		$nama_negara[] = $row['negara']; 

		$query = mysqli_query($koneksi,"select sum(totalsembuh) as totalsembuh from tb_covid where id='". $row['id']."'"); 
		$row = $query->fetch_array(); 
		$jumlah_totalsembuh[] = $row['totalsembuh']; 
	}
?> 

<!DOCTYPE html> 
<html> 
<head>
	<title>Total Recovered - Line Chart</title>
	<script type="text/javascript" src="Chart.js"></script>
</head> 
<body><center>
	<div style="width: 1200px; height: 1200px">
		<canvas id="myChart"></canvas>
	</div> 
	<script type="text/javascript">
		var myChart = new Chart("myChart", { 
			type: 'line', 
			data: { 
				datasets: [{
					label: 'Total Recovered - Line Chart', 
					data: <?php echo json_encode($jumlah_totalsembuh);?>,

					fillColor : "rgba(30, 163, 25,0.2)",
					strokeColor : "rgba(30, 163, 25,1)",
					pointColor : "rgba(30, 163, 25,1)",
					pointStrokeColor : "#1EA319",
					pointHighlightFill : "#1EA319",
					pointHighlightStroke : "rgba(30, 163, 25,1)",
				}],
				labels: <?php echo json_encode($nama_negara); ?>
			},
			options: { 
				responsive: true
			} 
		});

		window.onload = function(){
		var ctx = document.getElementById("canvas").getContext("2d");
		window.myLine = new Chart(ctx).Line(lineChartData, {
			responsive: true
		});
	}
	</script>
</body>
</html>