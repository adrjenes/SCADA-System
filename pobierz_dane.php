<?php
require_once 'phplot.php';

// Połączenie z bazą danych
$dbhost = "localhost";
$dbuser = "UR_USER";
$dbpassword = "UR_PASSWORD";
$dbname = "UR_DATABASE";
$polaczenie = mysqli_connect($dbhost, $dbuser, $dbpassword, $dbname);

// Pobranie danych z bazy danych
$rezultat = mysqli_query($polaczenie, "SELECT * FROM pomiary");
$data = array();
while ($wiersz = mysqli_fetch_array($rezultat)) {
    $data[] = array($wiersz[6], $wiersz[1], $wiersz[2], $wiersz[3], $wiersz[4], $wiersz[5]);
}

// Wygenerowanie wykresu
$plot = new PHPlot();
$plot->SetDataValues($data);
$plot->SetDataType('data-data');
$plot->SetTitle('Przyklad wykresu liniowego'); // Opcjonalny tytuł wykresu
$plot->DrawGraph();

// Zamknięcie połączenia z bazą danych
mysqli_close($polaczenie);
?>