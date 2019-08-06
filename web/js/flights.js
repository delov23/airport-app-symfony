let departing = document.getElementById('departing');
let arriving = document.getElementById('arriving');
let departuresData = document.getElementById('departures-data');
let arrivalsData = document.getElementById('arrivals-data');

arriving.addEventListener('keyup', () => {
    let searched = searchFriendly(arriving.value);

    for (let datum of arrivalsData.children) {
        let flightId = searchFriendly(datum.dataset.id);
        if (!flightId || flightId.includes(searched)) {
            datum.className = "";
        } else {
            datum.className = "invisible";
        }
    }
});

departing.addEventListener('keyup', () => {
    let searched = searchFriendly(departing.value);

    for (let datum of departuresData.children) {
        let flightId = searchFriendly(datum.dataset.id);
        if (!flightId || flightId.includes(searched)) {
            datum.className = "";
        } else {
            datum.className = "invisible";
        }
    }
});

fetch("https://community-open-weather-map.p.rapidapi.com/weather?q=Plovdiv", {
    method: "GET",
    headers: {
        "X-RapidAPI-Host": "community-open-weather-map.p.rapidapi.com",
        "X-RapidAPI-Key": "9127952631mshb888b56015411c5p12c7aajsnb24c2edf4840"
    }
})
.then(raw => raw.json())
.then((res) => {
    if (res && res.weather && res.main && res.weather.length > 0) {
        let dataSource = res.weather[0];
        document.getElementById('weather-img').attributes.src.value = `http://openweathermap.org/img/wn/${dataSource.icon}@2x.png`;
        let result = +res.main.temp - 273.15;
        document.getElementById('weather-data').innerHTML = `Temperature: ${result.toFixed(1)}°C, ${dataSource.description}<br/>` +
        `Wind Speed: ${res.wind.speed} m/s <br/>` +
        `Humidity: ${res.main.humidity}%`;
    } else {
        throw new Error("No data.");
    }
})
.catch((err) => {
    document.getElementById('weather-img').attributes.src.value = `https://static.thenounproject.com/png/340719-200.png`;
    document.getElementById('weather-data').innerHTML = err.message;    
});

function searchFriendly(string) {
    if (string !== undefined) {
        return string.replace(/\s+/gm, "").toLowerCase();
    } else {
        return null;
    }
}