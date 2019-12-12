<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Web 50 @ Shellmates Infinite CTF 2k20</title>
    <link rel="stylesheet" href="style.css">
    <link rel="shortcut icon" href="/favicon.ico" type="image/x-icon">
    <link rel="icon" href="/favicon.ico" type="image/x-icon">
</head>

<body style="color: white;">
    <div class="splash">
        <h1 class="splash-head">Shellmates Secure Ping Service</span> ?</h1>
        <h2 style="background-color: red;">Try to read /flag file located in the / directory</h2>
        <p>Make sure you check the debug mode to get an idea of whats happening to your input</p>
        <form method="POST" class="pure-form">
            <input name="command" type="text" class="pure-input-1" placeholder="127.0.0.1" id="ip" />
            <br>
            Debug Mode <input type="checkbox" name="debug" class="pure-checkbox" style="display: inline;">
            <br>
            <button type="submit" name="ping" class="pure-button pure-button-primary button-large">Ping!</button>
        </form>
        <h3>Results</h3> 

<?php


function filter($data) {
    $black_list = array('"', "'", " ", "\n");
    foreach ($black_list as $key) {
        $data = str_replace($key, '', $data);
    }
    return $data;
}

if (isset($_POST["command"])) {
    $command = $_POST['command'];
    $command = 'ping -c 1 '. filter($command);
    if (isset($_POST["debug"])) {
        if ($_POST["debug"] === "on") {
            echo '<div style="background-color: red; color: white; margin-bottom: 10px;">';
            echo "COMMAND TO BE EXECUTED: " . htmlspecialchars($command) . "<br>";
            echo "</div>";
        }
    } 
    
    echo str_replace("\n", "</br>\n", shell_exec($command));

    
}
?>


</div>
</body>

</html>      

