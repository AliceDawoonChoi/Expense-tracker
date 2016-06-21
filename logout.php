<?php
require_once('library.php');

unset($_COOKIE[LOGIN_COOKIE_NAME]);
setcookie(LOGIN_COOKIE_NAME, "", (time() - 3600));

header('Location: index.php', true, 302);
exit();
?>