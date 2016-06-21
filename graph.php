<!DOCTYPE html>
<html>
<head>
	<?php
	require_once('library.php');
	include ('head.php');
	?>
	<link rel="stylesheet" type="text/css" href="css/graph.css">
	<script type="text/javascript" src="https://www.google.com/jsapi"></script>
	<script type="text/javascript">
	
	google.load("visualization", "1.1", {packages:["bar"]});
	
	google.setOnLoadCallback(drawChart);
	
	function drawChart() {

		var data = google.visualization.arrayToDataTable(
			<?php echo getGraphData(getUserId($_COOKIE[LOGIN_COOKIE_NAME])); ?>);

		var options = {
			title: 'Monthly Expense',
		};

		var chart = new google.charts.Bar(document.getElementById('chart_div'));
		chart.draw(data, options);
	}

	var over700 = true;

	$(window).resize(function() {
		if (window.matchMedia("(min-width: 700px)").matches) {
			if (!over700) {
				drawChart();
				over700 = true;
			}
		}
		else {
			if (over700) {
				drawChart();
				over700 = false;
			}
		}
	});
	</script>
</head>
<body>

<?php
if (!isset($_COOKIE[LOGIN_COOKIE_NAME])) {
	header('Location: login.php', true, 302);
	exit();
}
?>

	<nav class="navbar navbar-inverse navbar-fixed-top">
		<div class="container-fluid">
			<div class="navbar-header">
				<button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#navbar" aria-expanded="false" aria-controls="navbar">
					<span class="sr-only">Toggle navigation</span>
					<span class="icon-bar"></span>
					<span class="icon-bar"></span>
					<span class="icon-bar"></span>
				</button>
				<a class="navbar-brand" href="index.php">Expense Tracker</a>
			</div>
			<div id="navbar" class="navbar-collapse collapse">
				<ul class="nav navbar-nav navbar-right">
					<li class="dropdown">
						<a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false"><?php echo $_COOKIE[LOGIN_COOKIE_NAME]; ?><span class="caret"></span></a>
						<ul class="dropdown-menu" role="menu">
							<li><a href="logout.php">Logout</a></li>
						</ul>
					</li>
					<li><a href="expense.php">Expense</a></li>
					<li><a href="report.php">Report</a></li>
					<li class="active"><a href="graph.php">Graph</a></li>
				</ul>
			</div>
		</div>
	</nav>

	<div id="chart_div"></div>

</body>
</html>