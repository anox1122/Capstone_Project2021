function openNav() {
  document.getElementById("myNav").style.width = "25%";
}

function closeNav() {
	document.getElementById("create").style.width = "0%";
  document.getElementById("myNav").style.width = "0%";
  	document.getElementById("create1").style.width = "0%";
}
function createApp(){
	document.getElementById("create").style.width = "100%";
		document.getElementById("create1").style.width = "100%";
}
function myFunction() {
  var x = document.getElementById('li');
  if (x.className.indexOf('w3-show') == -1) {
    x.className += ' w3-show';
  } else { 
    x.className = x.className.replace(' w3-show', '');
  }
}