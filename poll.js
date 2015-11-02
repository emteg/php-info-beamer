function httpGetAsync(theUrl, callback) {
  
  var xmlHttp = new XMLHttpRequest();
  xmlHttp.onreadystatechange = function() { 
    if (xmlHttp.readyState == 4 && xmlHttp.status == 200)
      callback(xmlHttp.responseText);
  }
  xmlHttp.open("GET", theUrl, true); // true for asynchronous 
  xmlHttp.send(null);
  
}

function callback(contents) {
  if (contents != "" && contents == "true") {
    alert("reloading for alert!");
    location.href = ".";
  }
}

function checkAlarm() {
  httpGetAsync("alarm.php", callback);
  setTimeout(checkAlarm, 3000);
}

if (!alarmAnzeigen) {
  setTimeout(checkAlarm, 3000);
}