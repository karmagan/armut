function popupform(myform, windowname, str)
{
var win = window.open('', windowname, 'height=500,width=500,scrollbars=yes');
myform.target=windowname;
}
       
function show(str, str2)
{
if (window.XMLHttpRequest)
  {// code for IE7+, Firefox, Chrome, Opera, Safari
  xmlhttp=new XMLHttpRequest();
  }
else
  {// code for IE6, IE5
  xmlhttp=new ActiveXObject("Microsoft.XMLHTTP");
  }
xmlhttp.onreadystatechange=function()
  {
  if (xmlhttp.readyState==4 && xmlhttp.status==200)
    {
    document.getElementById(str2).innerHTML=xmlhttp.responseText;
    }
  }
xmlhttp.open("GET",str,true);
xmlhttp.send();
}


function search(str,str2,searchField,resultField)
{
resultField = typeof resultField !== 'undefined' ? resultField : "searchResult";
if (str.length==0)
  {
  document.getElementById(resultField).innerHTML="";
  return;
  }
if (window.XMLHttpRequest)
  {// code for IE7+, Firefox, Chrome, Opera, Safari
  xmlhttp=new XMLHttpRequest();
  }
else
  {// code for IE6, IE5
  xmlhttp=new ActiveXObject("Microsoft.XMLHTTP");
  }
xmlhttp.onreadystatechange=function()
  {
  if (xmlhttp.readyState==4 && xmlhttp.status==200)
    {
    document.getElementById(resultField).innerHTML=xmlhttp.responseText;
    }
  }
xmlhttp.open("GET",str2+"Search.php?searchField="+searchField+"&search="+str,true);
xmlhttp.send();
}   

function checkAll(columnNo, columns) {
checkboxes= document.forms[1].elements;
var trs=document.getElementsByTagName("table")[1].getElementsByTagName("tr").length-1;
for (var i =1;i<=trs;i++){
  checkboxes[columnNo+columns*i].click();
}
}


function checkStaff(source) {
 checkboxes= document.forms[1].elements;
var trs=document.getElementsByTagName("table")[1].getElementsByTagName("tr").length-1;
for (var i =0;i<trs;i++){
  checkboxes[1+i].click();
}
}



var timeout	= 300;
var closetimer	= 0;
var ddmenuitem	= 0;

// open hidden layer
function mopen(id)
{	
	// cancel close timer
	mcancelclosetime();

	// close old layer
	if(ddmenuitem) ddmenuitem.style.visibility = 'hidden';

	// get new layer and show it
	ddmenuitem = document.getElementById(id);
	ddmenuitem.style.visibility = 'visible';

}
// close showed layer
function mclose()
{
	if(ddmenuitem) ddmenuitem.style.visibility = 'hidden';
}

// go close timer
function mclosetime()
{
	closetimer = window.setTimeout(mclose, timeout);
}

// cancel close timer
function mcancelclosetime()
{
	if(closetimer)
	{
		window.clearTimeout(closetimer);
		closetimer = null;
	}
}

// close layer when click-out
//document.onclick = mclose; 
