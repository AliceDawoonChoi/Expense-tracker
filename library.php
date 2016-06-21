<?php

define("SQL_HOST", "localhost");
define("SQL_USER", "root");
define("SQL_PASSWORD", "");
define("SQL_DB", "expense");

define("LOGIN_COOKIE_NAME", "loginAs");

function findUserByEmail($email) {

	$link = mysqli_connect(SQL_HOST, SQL_USER, SQL_PASSWORD, SQL_DB);

	if (mysqli_connect_errno()) {
		die('fail to connect to db'.mysqli_connect_error());
	}

	if ($stmt = mysqli_prepare($link, "SELECT count(id) FROM user WHERE email=?")) {

		mysqli_stmt_bind_param($stmt, "s", $email);

		mysqli_stmt_execute($stmt);

		mysqli_stmt_bind_result($stmt, $count);

		mysqli_stmt_fetch($stmt);

		mysqli_stmt_close($stmt);
	}

	mysqli_close($link);

	return $count;
}

function createUser($email, $password) {

	$link = mysqli_connect(SQL_HOST, SQL_USER, SQL_PASSWORD, SQL_DB);

	if (mysqli_connect_errno()) {
		die('fail to connect to db'.mysqli_connect_error());
	}

	if ($stmt = mysqli_prepare($link, "INSERT INTO user (email, password) VALUES (?, ?)")) {

		mysqli_stmt_bind_param($stmt, 'ss', $email, $password);

		mysqli_stmt_execute($stmt);

		$affectedRows = mysqli_stmt_affected_rows($stmt);
		
		mysqli_stmt_close($stmt);
	}

	mysqli_close($link);

	return $affectedRows;
}

function checkUser($email, $password) {

	$link = mysqli_connect(SQL_HOST, SQL_USER, SQL_PASSWORD, SQL_DB);

	if (mysqli_connect_errno()) {
		die('fail to connect to db'.mysqli_connect_error());
	}

	if ($stmt = mysqli_prepare($link, "SELECT count(id) FROM user WHERE email=? AND password=?")) {

		mysqli_stmt_bind_param($stmt, "ss", $email, $password);

		mysqli_stmt_execute($stmt);

		mysqli_stmt_bind_result($stmt, $count);

		mysqli_stmt_fetch($stmt);

		mysqli_stmt_close($stmt);
	}

	mysqli_close($link);

	return $count;
}

function getUserId($email) {

	$link = mysqli_connect(SQL_HOST, SQL_USER, SQL_PASSWORD, SQL_DB);

	if (mysqli_connect_errno()) {
		die('fail to connect to db'.mysqli_connect_error());
	}

	if ($stmt = mysqli_prepare($link, "SELECT id FROM user WHERE email=?")) {

		mysqli_stmt_bind_param($stmt, "s", $email);

		mysqli_stmt_execute($stmt);

		mysqli_stmt_bind_result($stmt, $userId);

		mysqli_stmt_fetch($stmt);

		mysqli_stmt_close($stmt);
	}

	mysqli_close($link);

	return $userId;
}

function createExpense($userId, $amount, $date, $note) {

	$link = mysqli_connect(SQL_HOST, SQL_USER, SQL_PASSWORD, SQL_DB);

	if (mysqli_connect_errno()) {
		die('fail to connect to db'.mysqli_connect_error());
	}

	if ($stmt = mysqli_prepare($link, "INSERT INTO expense (amount, date, note, user_id) VALUES (?, ?, ?, ?)")) {

		mysqli_stmt_bind_param($stmt, 'dssi', $amount, $date, $note, $userId);

		mysqli_stmt_execute($stmt);

		$affectedRows = mysqli_stmt_affected_rows($stmt);
		
		mysqli_stmt_close($stmt);
	}

	mysqli_close($link);

	return $affectedRows;
}

function getGraphData($userId) {

	$result = "[['Month', 'Total'],";
	$link = mysqli_connect(SQL_HOST, SQL_USER, SQL_PASSWORD, SQL_DB);

	if (mysqli_connect_errno()) {
		die('fail to connect to db'.mysqli_connect_error());
	}

	if ($stmt = mysqli_prepare($link, "SELECT SUBSTRING(date,1,7) AS month, sum(amount) FROM expense WHERE user_id=? GROUP BY month ORDER BY month")) {

		mysqli_stmt_bind_param($stmt, "i", $userId);

		mysqli_stmt_execute($stmt);

		mysqli_stmt_bind_result($stmt, $month, $total);

		while (mysqli_stmt_fetch($stmt)) {

			$result = $result."['".$month."', ".$total."],";
		}
		mysqli_stmt_close($stmt);
	}

	mysqli_close($link);

	return $result."]";
}
?>