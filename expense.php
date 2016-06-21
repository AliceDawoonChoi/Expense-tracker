<!DOCTYPE html>
<html>
<head>
	<?php
	require_once('library.php');
	include ('head.php');
	?>
	<link rel="stylesheet" type="text/css" href="css/expense.css">
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
					<li class="active"><a href="expense.php">Expense</a></li>
					<li><a href="report.php">Report</a></li>
					<li><a href="graph.php">Graph</a></li>
				</ul>
			</div>
		</div>
	</nav>

<?php
if (isset($_REQUEST['amount'])) {
	
	$userId = getUserId($_COOKIE[LOGIN_COOKIE_NAME]);

	if (0 < createExpense($userId, $_REQUEST['amount'], $_REQUEST['date'], $_REQUEST['note'])) {
?>
		<div id="alert" class="alert alert-success" role="alert">Expense added.</div>
		<script>$("#alert").delay(2000).fadeOut("slow");</script>
<?php
	}
}
?>

	<div class="container">

		<form class="form-expense" action="expense.php" method="post">

			<h2 class="form-expense-heading">Expense</h2>
	
			<label for="amount" class="sr-only">Amount</label>
			<input type="number" id="amount" name="amount" step="any" class="form-control" placeholder="$0.00" required autofocus>

			<label for="date" class="sr-only">Date</label>
			<input type="date" id="date" name="date" class="form-control" required>

			<label for="note" class="sr-only">Note</label>
			<input type="text" id="note" name="note" class="form-control" placeholder="Note(optional)">
	
			<button class="btn btn-lg btn-primary btn-block" type="submit">Add</button>

		</form>

	</div>

</body>
</html>