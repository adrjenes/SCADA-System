<?php
$dbhost = "localhost";
$dbuser = "UR_USER";
$dbpassword = "UR_PASSWORD";
$dbname = "UR_DATABASE";
$polaczenie = mysqli_connect($dbhost, $dbuser, $dbpassword, $dbname);

$rezultat = mysqli_query($polaczenie, "SELECT * FROM pomiary ORDER by id ASC") or die("SQL error 2: $dbname");
$dataPoints = array();

while ($wiersz = mysqli_fetch_array($rezultat)) {
    $id = $wiersz[0];
    $x1 = $wiersz[1];
    $x2 = $wiersz[2];
    $x3 = $wiersz[3];
    $x4 = $wiersz[4];
    $x5 = $wiersz[5];

    $dataPoints[] = array("label" => $id, "x1" => $x1, "x2" => $x2, "x3" => $x3, "x4" => $x4, "x5" => $x5);
}

mysqli_close($polaczenie);

header('Content-Type: application/json');
echo json_encode($dataPoints, JSON_NUMERIC_CHECK);
?>