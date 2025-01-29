<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>API Weather</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css" />
    <style>
        #weather-form {
            position: relative;
        }

        #weather-form i {
            position: absolute;
            right: 15px;
            top: 17px;
            display: none
        }
    </style>
</head>
<body>

    <div class="container my-5">
        <h2 class="text-center">Weather App</h2>
        <form onsubmit="getWeather(event)" class="w-50 mt-4 mx-auto" action="" id="weather-form">
            <input type="text" name="weather" id="weather" class="form-control form-control-lg" placeholder="Type city name..">
            <i class="fas fa-spinner fa-spin"></i>
        </form>

        <h2 class="display-3 text-center" id="temp"></h2>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/axios/dist/axios.min.js"></script>
    <script>

        function getWeather(e) {
            e.preventDefault();

            let city = document.querySelector("#weather-form input")

            let url = 'https://api.openweathermap.org/data/2.5/weather?q='+city.value+'&appid=dccab945679f3bb9019537a309e05e47&units=metric'

            // console.log(url);
            axios.get(url)
            .then((res) => {
                document.querySelector('#temp').innerHTML = res.data.main.temp
            }).catch((err) => {
                document.querySelector('#temp').innerHTML = city.value + ' not found'
            });
        }

    </script>

</body>
</html>
