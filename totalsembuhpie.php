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
	<title>Total Recovered - Pie Chart</title>
	<script type="text/javascript" src="Chart.js"></script>
</head> 
<body><center>
	<div id="canvas-holder" style="width: 630px">
		<canvas id="chart-area"></canvas>
	</div> 

	<script> 
		var config = { 
			type: 'pie', 
			data: { 
				datasets: [{
					label: 'Total Recovered - Pie Chart', 
					data: <?php echo json_encode($jumlah_totalsembuh);?>,

					backgroundColor: [					
					'rgba(255, 99, 132, 0.2)', 					
					'rgba(216, 124, 181, 0.2)',
					'rgba(177,88,180, 0.2)',
					'rgba(103,71,183, 0.2)',
					'rgba(58,58, 183, 0.2)',
					'rgba(54,162, 235, 0.2)',
					'rgba(84, 169, 171, 0.2)',
					'rgba(27, 126, 98, 0.2)',
					'rgba(214, 250, 56, 0.2)',
					'rgba(250, 133, 56, 0.2)'
					],

					borderColor: [					
					'rgba(255, 99, 132, 1)',					
					'rgba(216, 124, 181, 1)',
					'rgba(177,88,180, 1)',
					'rgba(103,71,183, 1)',
					'rgba(58,58, 183, 1)',
					'rgba(54,162, 235, 1)',
					'rgba(84, 169, 171, 1)',
					'rgba(27, 126, 98, 1)',
					'rgba(214, 250, 56, 1)',
					'rgba(250, 133, 56, 1)',
					], 
				}],
				labels: <?php echo json_encode($nama_negara); ?>
			},
			options: { 
				responsive: true
			} 
		};

	window.onload = function() { 
		var ctx = document.getElementById('chart-area').getContext('2d'); 
		window.myPie = new Chart (ctx, config);
	}; 

	document.getElementById('randomizeData').addEventListener('click', function () { 
		config.data.datasets.forEach(function (dataset) { 
			dataset.data = dataset.data.map(function () { 
				return randomScalingFactor();
			}); 
		}); 
		window.myPie.update(); 
	});
	var colorNames = Object.keys(window.chartColors);
	document.getElementById('addDataset').addEventListener('click', function() { 
		var newDataset = { 
			backgroundColor: [], 
			data: [], 
			label: 'New dataset' + config.data.datasets.length, 
		};
			for (var index = 0; index < config.data.labels.length; 
				++index) { 

				newDataset.data.push (randomScalingFactor()); 
				var colorName = colorNames [index % colorNames.length]; 
				var newColor = window.chartColors[colorName]; 
				newDataset = backgroundColor.push(newColor);
			}
			config.data.datasets.push(newDataset); 
			window.myPie. update(); 
		}); 
			document.getElementById('removeDataset').addEventListener("click", function() { 
				config.data.datasets.splice (0, 1); 
				window.myPie. update(); 
			});
	</script>
</body> 
</html> 
