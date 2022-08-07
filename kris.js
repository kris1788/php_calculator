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
//limiting key press applicable to numeric keys and arithematic functions
if (kCode>95&&kCode<106) {
	} else if (kCode==8) {
} else if (kCode==110) {
}
else if (kCode == 39) {action1("^");
evt.preventDefault();
return false;}
else if (kCode == 220) {action1("√");
evt.preventDefault();
return false;}
else if (kCode == 107) {action1("+");
evt.preventDefault();
return false;}
else if (kCode == 109) {action1("-");
evt.preventDefault();
return false;}
else if (kCode == 187) {action1("=");
evt.preventDefault();
return false;}
else if (kCode == 106) {action1("*");
evt.preventDefault();
return false;}
else if (kCode == 111) {action1("/");
evt.preventDefault();
return false;}
else if (kCode == 46) {action1("D");
evt.preventDefault();
return false;}
else if (kCode == 13) {action1("=");
evt.preventDefault();
return false;}
else if (kCode == 61) {action1("=");
evt.preventDefault();
return false;}
 else {	 
evt.preventDefault();
return false;
}
}
