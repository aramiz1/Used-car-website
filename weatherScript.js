let appId = '603f2ddbf801a91e99e2daa4c3aa2a15';
let units = 'imperial';
let country = '';
let searchMethod = '';
var today;

$( document ).ready(function() {
    

//begin by waitinf for user to click the search button
/*
document.getElementById('searchBtn').addEventListener('click', () => {
	let searchTerm = document.getElementById('searchInput').value;
	if(searchTerm)
		searchWeather(searchTerm);
})*/
	let searchTerm = 'Atlanta';
	if(searchTerm)
		searchWeather(searchTerm);
	
//see if user is searching for zip or city name
function getSearchMethod(searchTerm) {
	
	if(searchTerm.length === 5 && Number.parseInt(searchTerm) + '' === searchTerm)
		searchMethod = 'zip';
	else
		searchMethod = 'q';
	
	todaysWeather(searchMethod, searchTerm);
}

//search forecast for input
function searchWeather(searchTerm) {
	getSearchMethod(searchTerm);
		
	let searchLink = `http://api.openweathermap.org/data/2.5/forecast?${searchMethod}=${searchTerm}&APPID=${appId}&units=${units}`;
	httpRequestAsync(searchLink, theResponse);
     
}

//get today's weather from user input
function todaysWeather(searchMethod, searchTerm){
	
	let searchLink = `http://api.openweathermap.org/data/2.5/weather?${searchMethod}=${searchTerm}&APPID=${appId}&units=${units}`;
	httpRequestAsync2(searchLink, theResponse2);
	
}

//get forecast response, push forecast of all future days at 12:00 weather to an array and initialize it
//to print in the HTML doc
function theResponse(response) {
	  let jsonObject = JSON.parse(response);
	  
	  var info=[];
	  
	  for(var x = 4; x < jsonObject.list.length; x = x + 8){
		info.push(jsonObject.list[x]);
		var s = jsonObject.list[x].dt_txt
		
		s = s.slice(5, 10);
		
	  }

	  init(info,jsonObject.city.name);
}

//AJAX method for forecast
function httpRequestAsync(url, callback)
{

    var httpRequest = new XMLHttpRequest();
    httpRequest.onreadystatechange = () => { 
        if (httpRequest.readyState == 4 && httpRequest.status == 200)
            callback(httpRequest.responseText);
    }
    httpRequest.open("GET", url, true); // true for asynchronous 
    httpRequest.send();
}


function theResponse2(response) {
	  let jsonObject = JSON.parse(response);
	  
	  today = jsonObject;
}

//AJAX method for today's weather
function httpRequestAsync2(url, callback)
{
	
    var httpRequest = new XMLHttpRequest();
    httpRequest.onreadystatechange = () => { 
        if (httpRequest.readyState == 4 && httpRequest.status == 200)
            callback(httpRequest.responseText);
    }
    httpRequest.open("GET", url, true); // true for asynchronous 
    httpRequest.send();
}

//
function init(resultFromServer, nameOfCity) {
	
	
	console.log(today);
	console.log(today.weather[0].main);
	let cityHeader = document.getElementById(`cityHeader`);

	//decide background image of HTML doc by today's weather
	switch(today.weather[0].main) {
		case 'Clear':
			//document.body.style.backgroundImage = 'url("clearw.jpg")';
			break;
			
		case 'Clouds':
			//document.body.style.backgroundImage = 'url("cloudyw.jpg")';
			cityHeader.innerHTML = "It's cloudy and we should be closed but we'll show you " + 
			"functionality anyways because we don't want to get a 0.";
			break;
		
		case 'Rain':
		case 'Drizzle':
		case 'Mist':
			//document.body.style.backgroundImage = 'url("rainyw.jpg")';
			cityHeader.innerHTML = "It's cloudy and we should be closed but we'll show you " + 
			"functionality anyways because we don't want to get a 0.";
			break;
		
		case 'Thunderstorm':
			//document.body.style.backgroundImage = 'url("stormyw.jpg")';
			cityHeader.innerHTML = "It's cloudy and we should be closed but we'll show you " + 
			"functionality anyways because we don't want to get a 0.";
			break;
		
		case 'Snow':
			//document.body.style.backgroundImage = 'url("snowyw.jpg")';
			cityHeader.innerHTML = "It's cloudy and we should be closed but we'll show you " + 
			"functionality anyways because we don't want to get a 0.";
			break;
			
		default:
			break;
	}
	
	//update span for today's weather
	let weatherDescriptionHeader = document.getElementById(`weatherDescriptionHeader${0}`);
	let temperatureElement = document.getElementById(`temperature${0}`);
	
	let weatherIcon = document.getElementById(`documentIconImg${0}`);
	
	
	
	weatherIcon.src = 'http://openweathermap.org/img/w/' + today.weather[0].icon + '.png';
	
	let resultDescription = today.weather[0].description;
	weatherDescriptionHeader.innerText = resultDescription.charAt(0).toUpperCase() + resultDescription.slice(1);
	
	temperatureElement.innerHTML = Math.floor(today.main.temp) + '&#176';
	

}

});

