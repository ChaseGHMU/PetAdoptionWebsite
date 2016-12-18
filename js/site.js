$("#miadiv").ready(function(){
    $("#mia").click(function(){
        $("#miadiv").toggle();
    });
});

$("#remdiv").ready(function(){
    $("#rem").click(function(){
        $("#remdiv").toggle();
    });
});

$("#kodadiv").ready(function(){
    $("#koda").click(function(){
        $("#kodadiv").toggle();
    });
});

$("#tebowdiv").ready(function(){
    $("#tebow").click(function(){
        $("#tebowdiv").toggle();
    });
});

$("#spotdiv").ready(function(){
    $("#spot").click(function(){
        $("#spotdiv").toggle();
    });
});

function deleteaccount(){
	var del = window.prompt("Are you sure you want to delete your account? Type 'delete' if so");
	var str = del.toLowerCase();
	
	if(str == 'delete'){
		window.location = "http://ec2-35-164-239-140.us-west-2.compute.amazonaws.com/deleteaccount.php";
	}else {
		window.alert("Your account will not be deleted.");
	}
}
$('.navbar-collapse ul li:not(.dropdown) a').click(function() {
    $('.navbar-toggle:visible').click();
});

function timeout(){
	document.getElementById('update').innerHTML="Loading...";
	myVar = setTimeout(infoText,2000);
}

function infoText(){

	var http = new XMLHttpRequest();

	http.onreadystatechange = function(){
		if(http.readyState==4 && http.status==200){
			var obj = document.getElementById('update');
			obj.innerHTML = http.responseText;
		}
	};	

	http.open('GET',"http://ec2-35-164-239-140.us-west-2.compute.amazonaws.com/paragraph.php",true);
	http.send();
}

$(function () {
	var adver = new Advertisement();
	advert.Retrieve(onDataReceived);
});
//advertisement class
function Advertisement(){
	
}
//add retieve method to all advertisements
Advertisement.prototype.Retrieve = function(onSuccess) {
	$.get('register.php',onSuccess);
}
//function to be called when retrieve gets done
var onDataRecieved = function(data) { 
	alert(data);
}