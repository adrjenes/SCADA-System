<?php
$dbhost = "localhost";
$dbuser = "UR_USER";
$dbpassword = "UR_PASSWORD";
$dbname = "UR_DATABASE";

$polaczenie = mysqli_connect($dbhost, $dbuser, $dbpassword, $dbname);

if (!$polaczenie) {
    die("Błąd połączenia z bazą danych: " . mysqli_connect_error());
}

$rezultat = mysqli_query($polaczenie, "SELECT * FROM pomiary");
$data = array();

while ($wiersz = mysqli_fetch_array($rezultat)) {
    $data[] = $wiersz;
}

mysqli_close($polaczenie);

header('Content-Type: application/json');
echo json_encode($data);
?>