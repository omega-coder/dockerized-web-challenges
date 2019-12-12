<?php

// starting the session
session_start();

if (isset($_GET['destroySession'])) {
	session_destroy();
	setcookie("list", "");
	die('Session cleared, session destruction has nothing to do with the challenge btw.');
}


if(empty($_SESSION['login']))
{
	$_SESSION['login'] = 1;
}

else
{
	if(empty($_COOKIE['list']))
	{
		$a = [];
		if(!empty($_POST))
			array_push($a,$_POST['a']);
		// setting a serialized cookie
		setcookie('list',serialize($a));

		foreach ($a as $key => $value) {
			echo $key,$value;
		}
	}
	else
	{
		// unserializing the cookie
		$a = unserialize($_COOKIE['list']);

		if(!empty($_POST) && is_array($a))
			array_push($a,$_POST['a']);

		setcookie('list',serialize($a));

		foreach ($a as $key => $value) {
			echo $value;
		}
	}

}

// there is a file called flag.php
// try to read it!

Class Shellmates {
	public function __toString()
	{
		return highlight_file($this->source,true);
	}
}

?>
<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Guess the Code | Shellmates</title>
    <link rel="stylesheet" href="style.css">
    <link rel="shortcut icon" href="/favicon.ico" type="image/x-icon">
    <link rel="icon" href="/favicon.ico" type="image/x-icon">
</head>
<body style="color: white;">
<br><br>
    <div class="splash">
		<br>
		<br>
		<br>

        <h1 class="splash-head">Guess The Code</span> ?</h1>
        <h2 style="background-color: red;">Try to read flag.php</h2>
		<p>Make sure you check the page as well.</p>
		<a href="index.php?destroySession">Clear your session</a>
		<form method="POST" class="pure-form">
			<input type="text" name="a" class="pure-input-1">
			<br><br>
			<button type="submit" class="pure-button pure-button-primary button-large">Submit!</button>

































































































































































































<p hidden>
// try to read flag.php	
Class Shellmates {
	public function __toString()
	{
		return highlight_file($this->source,true);
	}
}
</p>
</form>
</div>
</body>
</html>
