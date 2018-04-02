<?php
/* 
  A weather app which uses an API from openweathermap.org which fetches the current weather of a city
*/

  $weather = "";
  $error = "";
  $city="";
  if ($_GET["city"]) {
      $city = urlencode($_GET["city"]);

            //Fetches the content of the url, in JSON format
      $urlContent = file_get_contents("http://api.openweathermap.org/data/2.5/weather?q=".$city."&appid=73c38b2fab7e26f2d2ed5c10ddb9a283");
            // Decoding the JSON format content into an array
      $weatherArray = json_decode($urlContent, true);      

      if ($weatherArray['cod'] == 200) {
        $temp = intval($weatherArray['main']['temp'] - 273);
      
      $weather = "Currently: ".$weatherArray['weather'][0]['description']." Temp: ".$temp."&deg;C <br>Pressure: 
                  ".$weatherArray['main']['pressure']." hPa Humidity: ".$weatherArray['main']['humidity']."% <br>
                   Wind speed: ".$weatherArray['wind']['speed']."m/s Clouds: ".$weatherArray['clouds']['all']."%";
      }else {
        $error = "Could not find city. Try again";
      }
      

  }

?>

<!doctype html>
<html lang="en">
  <head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">

     <!-- Optional JavaScript -->
    <!-- jQuery first, then Popper.js, then Bootstrap JS -->
    <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>

    <title>Weather Scrapper</title>
    <link rel="shortcut icon" href="http://localhost/~steekam/Weather-scrapper/favicon.ico"/>

    <style text="text/css">
        body {
             background: linear-gradient(
                        rgba(0, 0, 0, 0.5), 
                        rgba(0, 0, 0, 0.5)
                      ),url(background.jpg) no-repeat center center fixed;  
             background-size: cover;
             
        }
        .container {
          text-align: center;
          margin-top: 120px;
          width: 450px;
          color: whitesmoke;
        }
        input {
          margin: 30px 0;
        }
        #weather {
          margin-top: 20px;
        }
    </style>
  </head>
  <body>

  <div class="container">
        <h1>What's The Weather?</h1>

        <form>
          <div class="form-group">
            <label for="city">Enter name of a city </label>
            <input type="text" class="form-control" id="city" name ="city" value='<?php echo $_GET["city"] ?>' placeholder="e.g London,Paris" required>            
          </div>
          
          <button type="submit" class="btn btn-primary">Submit</button>         
        </form>

         <div id = "weather">
            <?php
              if ($weather) {
                echo '<div class="alert alert-success" role="alert">'.$weather.'</div>';
              }else if ($error) {
                echo '<div class="alert alert-danger" role="alert">'.$error.'</div>';
              }
            
            ?>
          </div>
  </div>

    
   
  </body>
</html>