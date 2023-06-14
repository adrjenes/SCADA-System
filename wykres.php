<?php
require_once 'phplot.php';

// Dane dostępu do bazy danych
$dbhost = "localhost";
$dbuser = "UR_USER";
$dbpassword = "UR_PASSWORD";
$dbname = "UR_DATABASE";

// Połączenie z bazą danych
$polaczenie = mysqli_connect($dbhost, $dbuser, $dbpassword, $dbname);

// Sprawdzenie połączenia
if (!$polaczenie) {
    die("Błąd połączenia z bazą danych: " . mysqli_connect_error());
}

// Zapytanie SQL do pobrania danych z tabeli
$query = "SELECT datetime, x1, x2 FROM pomiary";

// Wykonanie zapytania
$result = mysqli_query($polaczenie, $query);

// Sprawdzenie wyników zapytania
if (!$result) {
    die("Błąd zapytania SQL: " . mysqli_error($polaczenie));
}

// Przygotowanie danych do wykresu
$data = array();
while ($row = mysqli_fetch_assoc($result)) {
    $datetime = $row['datetime'];
    $x1 = (float) $row['x1'];
    $x2 = (float) $row['x2'];
    $data[] = array($datetime, $x1, $x2);
}

// Zwolnienie zasobów zapytania
mysqli_free_result($result);

// Zamknięcie połączenia z bazą danych
mysqli_close($polaczenie);

// Utworzenie obiektu PHPlot
$plot = new PHPlot();
$plot->SetDataValues($data);
$plot->SetDataType('data-data');
$plot->SetTitle('Przykład wykresu liniowego');

// Wygenerowanie wykresu
$plot->DrawGraph();
?>