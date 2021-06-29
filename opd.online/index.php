<?php
ini_set('display_errors', 'E_ALL');
error_reporting(E_ALL);
session_start();
if(isset($_GET['delay'])) {
    $_SESSION['delay'] = $_GET['delay'];
    $delaypage = 512+$_GET['tick']+$_SESSION['delay'];
} else { $delaypage = 512+$_GET['tick']; }
?>
<html>
<head>
<title><? echo $delaypage.' '; if(isset($_SESSION['username'])) { echo '['.$_SESSION['username'].'] '; } ?>OPD Online Login SIM</title>
<style>a { color: blue; }</style>
</head>
<body>
<?php
if (!isset($_GET['pid']) && !isset($_SESSION['username'])){
    echo 'Welcome, <i>anonymous</i>.., <font color="red" size="2">Please Login First..</font><br /><a href=".?pid=login">Go Login</a>';
    echo '<script>setTimeout(function() { window.location.href=".?pid=login&tick='.rand(1024,4096).'" },'.$delaypage.');</script>';
    phpinfo();
    phpcredits();
}
    $usernamelogin = 'kotaperadaban';
    if(isset($_POST['username'])) {
    $username = $_POST['username'];
    }
    if (isset($_GET['pid']) && $_GET['pid'] == 'logging' && $username == $usernamelogin) {
        $_SESSION['username'] = $username;
        echo 'Loagging in...<br /><a href=".?pid=logout">CanceL</a>';
        sleep(1);
        echo '<script>setTimeout(function() { window.location.href=".?pid=welcome&tick='.rand(1024,4096).'" },'.$delaypage.');</script>';
        phpinfo();
        phpcredits();
    }
    elseif (isset($_GET['pid']) && $_GET['pid'] == 'logging') {
        echo 'Wrong Password!<br /><a href="./">Go back</a>';
        echo '<script>setTimeout(function() { window.location.href="./?tick='.rand(1024,4096).'" },'.$delaypage.');</script>';
        phpinfo();
        phpcredits();
    }
if(isset($_GET['pid']) && $_GET['pid'] == 'login') {
    if(!isset($_SESSION['username'])) {
?>
<form action="?pid=logging&tick=<?= rand(1024,4096); ?>" method="post">
<input name="username" type="password" style="font-size: 11px;"><br />
<input name="submit" type="submit" value="Submit" style="font-size: 11px;">
</form>
<?php
    phpinfo();
    phpcredits();
    } else { echo '<script>setTimeout(function() { window.location.href="./?tick='.rand(1024,4096).'" },'.$delaypage.');</script>'; }
}
if(isset($_SESSION['username']) && !isset($_GET['pid'])) {
    header("Location: .?pid=welcome");
}
if(isset($_SESSION['username']) && isset($_GET['pid']) && $_GET['pid'] == 'welcome') {
    echo 'Welcome, <i>'.$_SESSION["username"].'</i>.<br /><a href=".?pid=logout">Logout</a>';
    echo '<script>setTimeout(function() { window.location.href=".?pid=logout&tick='.rand(1024,4096).'" },'.$delaypage.');</script>';
    phpinfo();
    phpcredits();
}
if(isset($_GET['pid']) && $_GET['pid'] == 'logout') {
    session_destroy();
    echo 'You have been logged out. <br /><a href="./">Go back</a>';
    echo '<script>setTimeout(function() { window.location.href="./?tick='.rand(1024,4096).'" },'.$delaypage.');</script>';
    phpinfo();
    phpcredits();
}
?>
</body>
</html>