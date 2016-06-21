<!DOCTYPE html>
<html>
<head>
	<?php
	require_once('library.php');
	include ('head.php');
	?>
</head>
<body>
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
					<?php
					if (isset($_COOKIE[LOGIN_COOKIE_NAME])) {
					?>
						<li class="dropdown">
							<a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false"><?php echo $_COOKIE[LOGIN_COOKIE_NAME]; ?><span class="caret"></span></a>
							<ul class="dropdown-menu" role="menu">
								<li><a href="logout.php">Logout</a></li>
							</ul>
						</li>
						<li><a href="expense.php">Expense</a></li>
						<li><a href="report.php">Report</a></li>
						<li><a href="graph.php">Graph</a></li>
					<?php
					}
					else {
					?>
						<li><a href="login.php">Login</a></li>
						<li><a href="signup.php">Signup</a></li>
					<?php
					}
					?>
				</ul>
			</div>
		</div>
	</nav>

	<div class="jumbotron">
		<h1>Expense Tracker</h1>
		<p class="lead">Jong Hoon Kim (C0644572)</p>
		<p class="lead">Dawoon Choi (C0659055)</p>
		<?php
		if (!isset($_COOKIE[LOGIN_COOKIE_NAME])) {
		?>
			<p><a class="btn btn-lg btn-success" href="signup.php" role="button">Sign up today</a></p>
		<?php
		}
		?>
	</div>
</body>
</html>