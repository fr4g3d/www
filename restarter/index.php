<?php
//phpinfo();
date_default_timezone_set("Asia/Jakarta");
$title = "Apache+MySQL Restarter Panel";
if(isset($_GET['p'])) {
	$title = $title ." - ". $_GET['p'];
	$txt = $_GET['p'];
	$fpcfiles = file_put_contents('logs.txt', date("Y-m-d H:i:s").' - '.$txt.PHP_EOL, FILE_APPEND | LOCK_EX );
	$crnt = file_get_contents('logz.txt');
	$fpcfilez = file_put_contents('logz.txt', date("Y-m-d H:i:s").' - '.$txt.PHP_EOL .$crnt);
}
?>
<?php
$arr1 = [];
$int1 = '';
$oss = PHP_OS;
if($oss == 'WINNT') {
	$restap = 'restap.cmd';
	$restmy = 'restmy.cmd';
	$stopmy = 'stopmy.cmd';
	$restfz = 'restfz.cmd';
}
elseif($oss == 'Linux') {
	$restap = 'restap.sh';
	$restmy = 'restmy.sh';
	$stopmy = 'stopmy.sh';
	$restfz = 'restfz.sh';
}
else {
	$restap = 'restap.cmd';
	$restmy = 'restmy.cmd';
	$stopmy = 'stopmy.cmd';
	$restfz = 'restfz.cmd';
}
error_reporting(0);
if(isset($_GET['execrestap']))	   { exec($restap,$arr1,$int1); print_r(date("Y-m-d H:i:s")."<br>".$arr1[2]."<br>");print_r($arr1[3]."<br>"); print_r($arr1[7]."<br>");print_r($arr1[8]."<hr>"); }
elseif(isset($_GET['execrestmy'])) { exec($restmy,$arr1,$int1); print_r(date("Y-m-d H:i:s")."<br>".$arr1[2]."<br>");print_r($arr1[3]."<br>"); print_r($arr1[7]."<br>");print_r($arr1[8]."<hr>"); }
elseif(isset($_GET['execstopmy'])) { exec($stopmy,$arr1,$int1); print_r(date("Y-m-d H:i:s")."<br>".$arr1[2]."<br>");print_r($arr1[3]."<br>"); print_r($arr1[7]."<br>");print_r($arr1[8]."<hr>"); }
elseif(isset($_GET['execrestfz'])) { exec($restfz,$arr1,$int1); print_r(date("Y-m-d H:i:s")."<br>".$arr1[2]."<br>");print_r($arr1[3]."<br>"); print_r($arr1[7]."<br>");print_r($arr1[8]."<hr>"); }
else {
	
function checkMySQL() {
$conn = mysqli_connect('localhost', 'root', '');
if (!$conn) {
	return '<a href="?" style="color: red; cursor: wait;">Connection Failed!</a>'."\n"; // . $conn->connect_error;
	} else {
		return '<a href="?" style="color: green; cursor: wait;">Connected</a>'."\n";
	}
}
?>
<html>
<head>
<title><?= $title; ?></title>
<style>
html {scroll-behavior: smooth;}
body {text-shadow: 1px 1px 2px grey;}
button {padding: 3px; text-shadow: 1px 1px 2px grey; box-shadow: 1px 1px 2px grey; border-width: 1px; border-radius: 3px; transition-duration: 0.128s;}
button:hover:enabled {background-color: #428BCA; color: white; border-radius: 3px;}
h3 {padding: 4px; margin-block-start: 8px; margin-block-end: 8px;}
#top-panel {overflow: hidden; background-color: #fff; opacity: 0.9; top: 0px; left: 4px; position: fixed; width: 100%; float: left; display: block; z-index: 999;}
#restarter {margin-top: 256px; height: 1px;}
hr {border: 0; border-top: 1px dashed #428BCA;}
#myProgress {width: 100%; background-color: #ddd;}
#myBar {width: 0.1%; height: 16px; background-color: #428BCA; text-align: center; line-height: 15px; color: white; text-shadow: 1px 1px 1px blue;}
</style>
</head>
<body>
<div id="top-panel"><div style="cursor: default;">OSS: <a href="?" style="color: red; cursor: wait;"><u><?= php_uname() .' ('. PHP_OS .')' ?></u></a></div>
<h3>Apache Restarter Server</h3>
<button id="btn1" type="button" onclick="execRestApMy('restap'); disTimed('btn1',74500); move(74000);">Restart Apache</button>
<h3>MySQL Restarter Server</h3>
<button id="btn2" type="button" onclick="execRestApMy('restmy'); disTimed('btn2',5600); move(5500);">Restart MySQL</button>
&nbsp;
<button id="btn3" type="button" onclick="execRestApMy('stopmy'); disTimed('btn3',5100); move(5000);">Stop MySQL</button>
&nbsp;
<button id="btn3a" type="button" onclick="execRestApMy('startpma'); disTimed('btn3a',1024); move(960);">Open MySQL Admin</button>
MySQL Status: <?php echo checkMySQL(); ?>
<h3>FTP Restarter Server</h3>
<button id="btn4" type="button" onclick="execRestApMy('restfz'); disTimed('btn4',4800); move(4700);">Restart FTP</button>
<hr>
<div id="myProgress">
  <div id="myBar" style="display: none;">0%</div>
</div>
<hr>
</div>
<div id="restarter">
<p>&nbsp;</p><p>&nbsp;</p><p>&nbsp;</p><p>&nbsp;</p>
</div>
</body>
<script>
function execRestApMy(idb) {
  var xhttp = new XMLHttpRequest();
  xhttp.onreadystatechange = function() {
    if (this.readyState == 4 && this.status == 200) { document.getElementById("restarter").innerHTML = this.responseText+document.getElementById("restarter").innerHTML; }
  };
  if(idb == "restap") { xhttp.open("GET", "?execrestap", true); xhttp.send(); }
  if(idb == "restmy") { xhttp.open("GET", "?execrestmy", true); xhttp.send(); }
  if(idb == "stopmy") { xhttp.open("GET", "?execstopmy", true); xhttp.send(); }
  if(idb == "startpma") { setTimeout(function(){ window.open('/phpmyadmin'); }, 1128); }
  if(idb == "restfz") { xhttp.open("GET", "?execrestfz", true); xhttp.send(); }
}
function disTimed(id,insec){
	var elem = document.getElementById("myBar");
	document.getElementById(id).disabled = true;
    setTimeout(function(){document.getElementById(id).disabled = false;},insec);
	if (id == 'btn1') { setTimeout(function(){alert('Command \'Restart Apache Server\' Done.');},insec+600); setTimeout(function(){elem.style.width = 0.1 + "%"; elem.innerHTML = 0 + "%";},insec+550); setTimeout(function(){window.location.href='?restarted=true';},insec+1000);
	} else if (id == 'btn2') { setTimeout(function(){alert('Command \'Restart MySQL Server\' Done.');},insec+600); setTimeout(function(){elem.style.width = 0.1 + "%"; elem.innerHTML = 0 + "%";},insec+550);
	} else if (id == 'btn3') { setTimeout(function(){alert('Command \'Stop MySQL Server\' Done.');},insec+600); setTimeout(function(){elem.style.width = 0.1 + "%"; elem.innerHTML = 0 + "%";},insec+550);
	} else if (id == 'btn3a') { setTimeout(function(){alert('Command \'Start MySQL Admin\' Done.');},insec+100); setTimeout(function(){elem.style.width = 0.1 + "%"; elem.innerHTML = 0 + "%";},insec+150);
	} else if (id == 'btn4') { setTimeout(function(){alert('Command \'Restart FTP Server\' Done.');},insec+600); setTimeout(function(){elem.style.width = 0.1 + "%"; elem.innerHTML = 0 + "%";},insec+550);
	}
}

var i = 0;
function move(insec) {
  if (i == 0) {
	insec = 105/insec;
    i = 1;
    var elem = document.getElementById("myBar");
    var width = 1;
    var id = setInterval(frame, 1/insec);
	elem.style.display = "block";
	elem.style.width = 1 + "%";
	elem.innerHTML = 1 + "%";
    function frame() {
      if (width >= 100) { clearInterval(id); i = 0; window.scrollTo(0,0); elem.style.display = "none";
      } else { width++; elem.style.width = width + "%";	elem.innerHTML = width + "%"; }
    }
  }
}
</script>
</html>
<?php
error_reporting(E_ALL & ~E_NOTICE);
	exit;
}
error_reporting(E_ALL & ~E_NOTICE);
?>
