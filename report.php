<!DOCTYPE html>
<html>
<head>
	<?php
	require_once('library.php');
	include ('head.php');
	?>
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
					<li class="active"><a href="report.php">Report</a></li>
					<li><a href="graph.php">Graph</a></li>
				</ul>
			</div>
		</div>
	</nav>

<?php
$userId = getUserId($_COOKIE[LOGIN_COOKIE_NAME]);
?>

	<div class="container">
		<div class="table-responsive">
			<table class="table table-hover">
				<thead>
					<tr>
						<th>Date</th>
						<th>Amount</th>
						<th>Note</th>
					</tr>
				</thead>
				<tbody>
					<?php

					$link = mysqli_connect(SQL_HOST, SQL_USER, SQL_PASSWORD, SQL_DB);

					if (mysqli_connect_errno()) {
						die('fail to connect to db'.mysqli_connect_error());
					}

					if ($stmt = mysqli_prepare($link, "SELECT id, date, amount, note FROM expense WHERE user_id=? ORDER BY date")) {

						mysqli_stmt_bind_param($stmt, "i", $userId);

						mysqli_stmt_execute($stmt);

						mysqli_stmt_bind_result($stmt, $id, $date, $amount, $note);

						while (mysqli_stmt_fetch($stmt)) {
							echo '<tr>';
							echo '<td>'.$date.'</td>';
							echo '<td>$ '.$amount.'</td>';
							echo '<td>'.$note.'</td>';
							echo '</tr>';
						}
						mysqli_stmt_close($stmt);
					}

					mysqli_close($link);
					?>
				</tbody>
			</table>
		</div>
	</div>

</body>
</html>