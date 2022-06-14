<?php 
include ('koneksi.php'); 
	$covid = mysqli_query($koneksi,"select * from tb_covid"); 
	while ($row = mysqli_fetch_array($covid) ) {
		$nama_negara[] = $row['negara']; 

		$query = mysqli_query($koneksi,"select sum(totalkematian) as totalkematian from tb_covid where id='". $row['id']."'"); 
		$row = $query->fetch_array(); 
		$jumlah_totalkematian[] = $row['totalkematian']; 
	}
?> 

<!DOCTYPE html> 
<html> 
<head>
	<title>Total Deaths - Bar Chart</title>
	<script type="text/javascript" src="Chart.js"></script>
</head> 
<body><center>
	<div style="width: 1200px; height: 1200px">
		<canvas id="myChart"></canvas>
	</div> 

	<script> 
		var ctx = document.getElementById("myChart").getContext('2d'); 
		var myChart = new Chart (ctx, { 
			type: 'bar', 
			data: { 
				labels: <?php echo json_encode($nama_negara); ?>, 
				datasets: [{
					label: 'Total Deaths - Bar Chart', 
					data: <?php echo json_encode($jumlah_totalkematian);?>,

					backgroundcolor: 'rgba(255, 99, 132, 0.2)', 
					bordercolor: 'rgba(255, 99, 132, 1)', 
					borderWidth: 1 
				}]
			}, 
			options: { 
				scales: {
					YAxes: [{
						ticks : { 
							beginAtZero:true 
						}
					}]
				}
			} 
		});
	</script>
</body> 
</html> 
