<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN"
  "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<?php
if (isset($_REQUEST['cal'])) {
$a=$_REQUEST['cal'];
//Replacing root symbol with ~ since it has 3 charectors
$a=str_replace('√','~',$a);
$bb=preg_replace("/[0-9.]/",'',$a);
$cc=preg_replace("/[^a-z0-9.]/i",'#',$a);
$dd=explode("#",$cc);
$b2=$a;
//Doing all raising and root in serial order
for ($i=0;$i<strlen($bb);$i++) {
if (substr($bb,$i,1) == "^") {
$b=pow($dd[$i],$dd[$i + 1]);
$b2=str_replace($dd[$i]."^".$dd[$i + 1],$b,$b2);
$dd[$i + 1]=$b;
} elseif (substr($bb,$i,1) == "~") {
$b=pow($dd[$i],1/$dd[$i + 1]);
$b2=str_replace($dd[$i]."~".$dd[$i + 1],$b,$b2);
$dd[$i + 1]=$b;
} 
}

$b=$b2;

$bb=preg_replace("/[0-9.]/",'',$b2);
$cc=preg_replace("/[^a-z0-9.]/i",'#',$b2);
$dd=explode("#",$cc);
//Doing all Multiplication and Division in serial order
for ($i=0;$i<strlen($bb);$i++) {
if (substr($bb,$i,1) == "*") {
$b=$dd[$i] * $dd[$i + 1];
$b2=str_replace($dd[$i]."*".$dd[$i + 1],$b,$b2);
$dd[$i + 1]=$b;
} elseif (substr($bb,$i,1) == "/") {
$b=$dd[$i] / $dd[$i + 1];
$b2=str_replace($dd[$i]."/".$dd[$i + 1],$b,$b2);
$dd[$i + 1]=$b;
} 
}
$b=$b2;

$bb=preg_replace("/[0-9.]/",'',$b2);
$cc=preg_replace("/[^a-z0-9.]/i",'#',$b2);
$dd=explode("#",$cc);
//Doing all Addition and Substraction in serial order
for ($i=0;$i<strlen($bb);$i++) {
if (substr($bb,$i,1) == " ") {
$b=$dd[$i] + $dd[$i + 1];
$dd[$i + 1]=$b;
} elseif (substr($bb,$i,1) == "-") {
$b=$dd[$i] - $dd[$i + 1];
$dd[$i + 1]=$b;
} 
}
echo $b;exit;
} else {
?>
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en" lang="en">
<head>
<title>KRISCALCULATOR</title>
<link rel="stylesheet" type="text/css" href="kris.css">
<script src='kris.js'></script>
</head>
<body>
<form>
<br><div style='float: center;width:700px;margin: auto;'>

<?php
echo "<table class='tablem'><tr><td colspan=4 class='full'><input type='text'  onkeydown='myFunction(event)' id='inpt' value='' class='numbfl' autocomplete='off' autofocus /></td>";
echo "<tr><td colspan=4 class='full' id='display1'></td>";
echo "<tr><td colspan=4 class='full' id='display2'></td>";
echo "<tr><td class='onefr' onclick=action1('D');>DEL</td><td class='onefr' onclick=action1('√');>√</td><td class='onefr' onclick=action1('^');>^</td><td class='onefr' onclick=action1('=');>=</td>";
echo "<tr><td class='onefr' onclick=action1('1');>1</td><td class='onefr' onclick=action1('2');>2</td><td class='onefr' onclick=action1('3');>3</td><td class='onefr' onclick=action1('+');>+</td>";
echo "<tr><td class='onefr' onclick=action1('4');>4</td><td class='onefr' onclick=action1('5');>5</td><td class='onefr' onclick=action1('6');>6</td><td class='onefr' onclick=action1('-');>-</td>";
echo "<tr><td class='onefr' onclick=action1('7');>7</td><td class='onefr' onclick=action1('8');>8</td><td class='onefr' onclick=action1('9');>9</td><td class='onefr' onclick=action1('*');>*</td>";
echo "<tr><td class='onefr' onclick=action1('.');>.</td><td class='onefr' onclick=action1('0');>0</td><td class='onefr' onclick=action1('C');>C</td><td class='onefr' onclick=action1('/');>/</td>";
}
?>
</form></body></html>