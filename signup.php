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
if (isset($_COOKIE[LOGIN_COOKIE_NAME])) {
	header('Location: index.php', true, 302);
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
					<li><a href="login.php">Login</a></li>
					<li class="active"><a href="signup.php">Signup</a></li>
				</ul>
			</div>
		</div>
	</nav>

<?php
if (isset($_REQUEST['id'])) {

	if ($_REQUEST['pw1'] === $_REQUEST['pw2']) {
		if (0 < findUserByEmail($_REQUEST['id'])) {
?>
			<div id="alert" class="alert alert-danger" role="alert">Email exists.</div>
			<script>$("#alert").delay(2000).fadeOut("slow");</script>
<?php
		}
		else {
			createUser($_REQUEST['id'], $_REQUEST['pw1']);
?>
			<div id="alert" class="alert alert-success" role="alert">User is created.</div>
			<script>setTimeout(function(){document.location.href = "login.php";}, 2000);</script>
<?php
		}
	}
	else {
?>
		<div id="alert" class="alert alert-danger" role="alert">Password mismatch.</div>
		<script>$("#alert").delay(2000).fadeOut("slow");</script>
<?php
	}
}
?>

	<div class="container">

		<form class="form-signin" action="signup.php" method="post">

			<h2 class="form-signin-heading">Please sign up</h2>
	
			<label for="inputEmail" class="sr-only">Email address</label>
			<input type="email" id="inputEmail" name="id" class="form-control" placeholder="Email address" required autofocus>
	
			<label for="inputPassword" class="sr-only">Password</label>
			<input type="password" id="inputPassword" name="pw1" class="form-control" placeholder="Password" required>

			<label for="confirmPassword" class="sr-only">Confirm Password</label>
			<input type="password" id="confirmPassword" name="pw2" class="form-control" placeholder="Confirm Password" required>

			<button class="btn btn-lg btn-primary btn-block" type="submit">Sign up</button>

		</form>

	</div>

</body>
</html>