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
<style>
input::-webkit-outer-spin-button,
input::-webkit-inner-spin-button
{
-webkit-appearance: none;
margin: 0;
}
input[type=number] {
-moz-appearance: textfield;
}
</style>
</head>
<body>
<form>
<br><div style='float: center;width:700px;margin: auto;'>
<script>
function action1(a) {
	document.getElementById("inpt").focus();
	if (a=="D")	{
    document.getElementById("display1").innerHTML="";
	document.getElementById("display2").innerHTML="";
	document.getElementById("inpt").value="";
	return;
	}
var str1="0123456789(.)";
var str2=document.getElementById("inpt").value;
if (a=="C")	{
str2=str2.substr(0,str2.length-1);
document.getElementById("inpt").value=str2;
return;
}
var cstr=document.getElementById("display1").innerHTML;
if (str1.includes(a)) {
document.getElementById("inpt").value=str2 + a;
return;} else {
	if (str2==""){
	if (cstr.substr(cstr.length-1,1)!="=")	{
    document.getElementById("display1").innerHTML=cstr.substr(0,cstr.length-1)+a;
	return;
	} else {
		var str3=document.getElementById("display2").innerHTML;
		if (str3!="") 		{
		document.getElementById("display1").innerHTML=str3+a;
		}
		return;}
		} else {
		if (cstr.substr(cstr.length-1,1)=="=")	{
		document.getElementById("display1").innerHTML=str2+a;
		document.getElementById("display2").innerHTML=str2
		document.getElementById("inpt").value="";
		return;
	} 
		}
		cstr=cstr+str2;
}

if (window.XMLHttpRequest) {
            // code for IE7+, Firefox, Chrome, Opera, Safari
            xmlhttp = new XMLHttpRequest();
        } else {
            // code for IE6, IE5
            xmlhttp = new ActiveXObject("Microsoft.XMLHTTP");
         }
        xmlhttp.onreadystatechange = function() {
			 if (xmlhttp.readyState == 4 && xmlhttp.status == 200) {
				 var r=xmlhttp.responseText;
				 document.getElementById("display1").innerHTML=cstr + a;
				 document.getElementById("display2").innerHTML=r; 
				document.getElementById("inpt").value="";
             }
        }		
        xmlhttp.open("POST","calc.php",true);
		xmlhttp.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");
		xmlhttp.send("cal="+cstr);
  }
 function myFunction (evt) {
var kCode = (evt.which) ? evt.which : evt.keyCode
if (kCode == 107) {action1("+");
evt.preventDefault();
return false;}
else if (kCode == 109) {action1("-");
evt.preventDefault();
return false;}
else if (kCode == 106) {action1("*");return false;}
else if (kCode == 111) {action1("/");return false;}
else if (kCode == 46) {action1("D");return false;}
else if (kCode == 13) {action1("=");
evt.preventDefault();
return false;}
else if (kCode == 61) {action1("=");return false;}
 }
</script>
<?php
echo "<table class='tablem'><tr><td colspan=4 class='full'><input type='number'  onkeydown='myFunction(event)' id='inpt' value='' class='numbfl' autocomplete='off' autofocus /></td>";
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