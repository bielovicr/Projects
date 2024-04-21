const api = 'zadajte vas api kluc sem';
const apiurl = 'https://api.openweathermap.org/data/2.5/weather';

document.getElementById("search").onclick = function() {
    const city = document.getElementById("city").value;
    if (city) {
        const url = `${apiurl}?q=${city}&appid=${api}&units=metric`;
        fetch(url)
            .then(response => response.json())
            .then(data => {
                document.getElementById("city").innerHTML = data.name;
                document.getElementById("temp").innerHTML = Math.round(data.main.temp) + '°C';
                document.getElementById("desc").innerHTML = data.weather[0].description;
            })
            .catch(error => {
                console.log('Error: ', error);
            });
    }
};