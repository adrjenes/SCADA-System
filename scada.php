<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);
$dbhost = "localhost";
$dbuser = "UR_USER";
$dbpassword = "UR_PASSWORD";
$dbname = "UR_NAME";
$polaczenie = mysqli_connect($dbhost, $dbuser, $dbpassword, $dbname);

// Pobierz dane z bazy danych
$rezultat = mysqli_query($polaczenie, "SELECT * FROM pomiary ORDER by id ASC") or die("SQL error 2: $dbname");
$dataPoints = array();

while ($wiersz = mysqli_fetch_array($rezultat)) {
    $id = $wiersz[0];
    $x1 = $wiersz[1];
    $x2 = $wiersz[2];
    $x3 = $wiersz[3];
    $x4 = $wiersz[4];
    $x5 = $wiersz[5];

    // Dodaj dane do tablicy wykresu
    $dataPoints[] = array("label" => $id, "x1" => $x1, "x2" => $x2, "x3" => $x3, "x4" => $x4, "x5" => $x5);
    
    
}

mysqli_close($polaczenie);
?>

<!DOCTYPE HTML>
<html>
<head>
    <script src="https://canvasjs.com/assets/script/canvasjs.min.js"></script>
    <script>
           window.onload = function() {
            function getData() {
                var xhr = new XMLHttpRequest();
                xhr.open("GET", "get_data.php", true);
                xhr.onreadystatechange = function() {
                    if (xhr.readyState === 4 && xhr.status === 200) {
                        var dataPoints = JSON.parse(xhr.responseText);

                        var chart = new CanvasJS.Chart("chartContainer", {
                            animationEnabled: true,
                            title: {
                                text: "Wykres temperatur X1, X2, X3, X4, X5"
                            },
                            axisX: {
                                title: "Oś X"
                            },
                            axisY: {
                                title: "Oś Y",
                                includeZero: false
                            },
                            data: [
                                {
                                    type: "line",
                                    dataPoints: dataPoints.map(function(data) {
                                        return { label: data.label, y: data.x1, color: "purple" };
                                    })
                                },
                                {
                                    type: "line",
                                    dataPoints: dataPoints.map(function(data) {
                                        return { label: data.label, y: data.x2, color: "red" };
                                    })
                                },
                                {
                                    type: "line",
                                    dataPoints: dataPoints.map(function(data) {
                                        return { label: data.label, y: data.x3, color: "green" };
                                    })
                                },
                                {
                                    type: "line",
                                    dataPoints: dataPoints.map(function(data) {
                                        return { label: data.label, y: data.x4, color: "purple" };
                                    })
                                },
                                {
                                    type: "line",
                                    dataPoints: dataPoints.map(function(data) {
                                        return { label: data.label, y: data.x5, color: "blue" };
                                    })
                                }
                            ]
                        });
                        chart.render();

                        // Aktualizuj wartości X1-X5
                        document.getElementById("x1").innerText = dataPoints[dataPoints.length - 1].x1;
                        document.getElementById("x2").innerText = dataPoints[dataPoints.length - 1].x2;
                        document.getElementById("x3").innerText = dataPoints[dataPoints.length - 1].x3;
                        document.getElementById("x4").innerText = dataPoints[dataPoints.length - 1].x4;
                        document.getElementById("x5").innerText = dataPoints[dataPoints.length - 1].x5;
                    }
                };
                xhr.send();
            }

            getData();
            setInterval(getData, 5000); // Pobieranie danych co 5 sekund
        }
    </script>
    <style>
  #wrapper {
    display: flex;
    flex-wrap: wrap;
    justify-content: space-between;
  }

  #chartContainer {
    width: 48%;
    height: 400px;
  }

  .image-container {
    width: 48%;
    height: 400px;
    position: relative;
  }

  .image-container img {
    width: 100%;
    height: 100%;
  }

  .image-container span {
    position: absolute;
    padding: 30px;
    font-size: 24px;
}

.x1 {
    top: 140px;
    left: 120px;
    background-color: <?php echo ($x1 < 10) ? 'blue' : (($x1 >= 10 && $x1 < 20) ? 'green' : (($x1 >= 20 && $x1 < 25) ? 'white' : (($x1 >= 25 && $x1 < 30) ? 'orange' : 'red'))); ?>;
}

.x2 {
    top: 160px;
    right: 350px;
    background-color: <?php echo ($x2 < 10) ? 'blue' : (($x2 >= 10 && $x2 < 20) ? 'green' : (($x2 >= 20 && $x2 < 25) ? 'white' : (($x2 >= 25 && $x2 < 30) ? 'orange' : 'red'))); ?>;
}

.x3 {
    top: 240px;
    left: 100px;
    background-color: <?php echo ($x3 < 10) ? 'blue' : (($x3 >= 10 && $x3 < 20) ? 'green' : (($x3 >= 20 && $x3 < 25) ? 'white' : (($x3 >= 25 && $x3 < 30) ? 'orange' : 'red'))); ?>;
}

.x4 {
    bottom: 260px;
    left: 330px;
    background-color: <?php echo ($x4 < 10) ? 'blue' : (($x4 >= 10 && $x4 < 20) ? 'green' : (($x4 >= 20 && $x4 < 25) ? 'white' : (($x4 >= 25 && $x4 < 30) ? 'orange' : 'red'))); ?>;
}

.x5 {
    bottom: -10px;
    right: 350px;
    background-color: <?php echo ($x5 < 10) ? 'blue' : (($x5 >= 10 && $x5 < 20) ? 'green' : (($x5 >= 20 && $x5 < 25) ? 'white' : (($x5 >= 25 && $x5 < 30) ? 'orange' : 'red'))); ?>;
}

  /* Define the color for each range */
  .blue { background-color: blue; }
  .green { background-color: green; }
  .white { background-color: white; }
  .orange { background-color: orange; }
  .red { background-color: red; }

  /* Define the ranges for each color */
  .x1.blue, .x2.blue, .x3.blue, .x4.blue, .x5.blue { color: white; }
  .x1.green, .x2.green, .x3.green, .x4.green, .x5.green { color: white; }
  .x1.white, .x2.white, .x3.white, .x4.white, .x5.white { color: black; }
  .x1.orange, .x2.orange, .x3.orange, .x4.orange, .x5.orange { color: black; }
  .x1.red, .x2.red, .x3.red, .x4.red, .x5.red { color: white; }
</style>
</head>
<body>
<div id="wrapper">
    <div id="chartContainer"></div>
    <div class="image-container">
        <img src="/z11/scada2.png">
<span class="x1"><?php echo $x1; ?></span>
<span class="x2"><?php echo $x2; ?></span>
<span class="x3"><?php echo $x3; ?></span>
<span class="x4"><?php echo $x4; ?></span>
<span class="x5"><?php echo $x5; ?></span>
</div>
</div>
</body>
</html>