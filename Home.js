// JavaScript Document
function showdate()
{
	
	var today= new Date();
	p=document.getElementById("date");
	p.innerHTML="Date of today  "+today.getDate()+"."+(today.getMonth()+1)+"."+today.getFullYear() ;
	

	}
window.onload=showdate;

	
	
