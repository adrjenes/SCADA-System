<?php
require_once 'phplot.php';

$dbhost = "localhost";
$dbuser = "UR_USER";
$dbpassword = "UR_PASSWORD";
$dbname = "UR_DATABASE";
$polaczenie = mysqli_connect($dbhost, $dbuser, $dbpassword, $dbname);
$rezultat = mysqli_query($polaczenie, "SELECT * FROM pomiary ORDER BY `id` DESC LIMIT 5");

$data = array();
$x1 = array();
$x2 = array();
$x3 = array();
$x4 = array();
$x5 = array();

while ($wiersz = mysqli_fetch_array ($rezultat)) 
{
    $x1[] = $wiersz[1];
    $x2[] = $wiersz[2];
    $x3[] = $wiersz[3];
    $x4[] = $wiersz[4];
    $x5[] = $wiersz[5];
}

$data[] = array_merge([''], $x1);
$data[] = array_merge([''], $x2);
$data[] = array_merge([''], $x3);
$data[] = array_merge([''], $x4);
$data[] = array_merge([''], $x5);

$plot = new PHPlot();
$plot->SetDataValues($data);
$plot->SetDataType('data-data');
$plot->SetPlotType('lines');
$plot->SetLegend(['$x1', '$x2', '$x3', '$x4', '$x5']);
$plot->SetTitle('Wykres liniowy');
$plot->DrawGraph();
mysqli_close($polaczenie);
?>







