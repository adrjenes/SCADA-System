<!DOCTYPE html>
<html>
<head>
  <script type="text/javascript" src="https://www.gstatic.com/charts/loader.js"></script>
  <script type="text/javascript">
    google.charts.load('current', {'packages':['gauge']});
    google.charts.setOnLoadCallback(drawChart);

    function drawChart() {
      <?php 
        $dbhost="localhost"; 
        $dbuser="UR_USER"; 
        $dbpassword="UR_PASSWORD"; 
        $dbname="UR_NAME";
        $polaczenie = mysqli_connect($dbhost, $dbuser, $dbpassword, $dbname);
        $rezultat = mysqli_query($polaczenie, "SELECT * FROM pomiary ORDER BY id DESC LIMIT 1");
        $wiersz = mysqli_fetch_array($rezultat);
        $x1 = $wiersz[1];
        $x2 = $wiersz[2];
        $x3 = $wiersz[3];
        $x4 = $wiersz[4];
        $x5 = $wiersz[5];
        mysqli_close($polaczenie);
      ?>

      var data = google.visualization.arrayToDataTable([
        ['Label', 'Value'],
        ['X1', <?php echo $x1; ?>],
        ['X2', <?php echo $x2; ?>],
        ['X3', <?php echo $x3; ?>],
        ['X4', <?php echo $x4; ?>],
        ['X5', <?php echo $x5; ?>]
      ]);

      var options = {
        width: 400, height: 120,
        redFrom: 90, redTo: 100,
        yellowFrom:75, yellowTo: 90,
        minorTicks: 5
      };

      var chart = new google.visualization.Gauge(document.getElementById('chart_div'));

      chart.draw(data, options);

      setInterval(function() {
        data.setValue(0, 1, 40 + Math.round(60 * Math.random()));
        chart.draw(data, options);
      }, 13000);
      setInterval(function() {
        data.setValue(1, 1, 40 + Math.round(60 * Math.random()));
        chart.draw(data, options);
      }, 5000);
      setInterval(function() {
        data.setValue(2, 1, 60 + Math.round(20 * Math.random()));
        chart.draw(data, options);
      }, 26000);
    }
  </script>
</head>
<body>
  <div id="chart_div" style="width: 400px; height: 120px;"></div>
</body>
</html>