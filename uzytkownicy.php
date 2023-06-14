<?php
error_reporting(E_ALL ^ E_NOTICE);
ini_set('display_errors', 1);

$link = mysqli_connect('localhost', 'UR_USER', 'UR_PASSWORD', 'UR_DATABASE');

if (!$link) {
    echo "Błąd: " . mysqli_connect_errno() . " " . mysqli_connect_error();
    exit;
}

mysqli_query($link, "SET NAMES 'utf8'");

$ip = $_SERVER['REMOTE_ADDR'];

$ipaddress = $_SERVER["REMOTE_ADDR"];

function ip_details($ip)
{
    $json = file_get_contents("http://ipinfo.io/{$ip}/geo");
    $details = json_decode($json);
    return $details;
}

$details = ip_details($ip);

function get_browser_name($user_agent)
{
    if (strpos($user_agent, 'Opera') || strpos($user_agent, 'OPR/')) {
        return 'Opera';
    } elseif (strpos($user_agent, 'Edge')) {
        return 'Edge';
    } elseif (strpos($user_agent, 'Chrome')) {
        return 'Chrome';
    } elseif (strpos($user_agent, 'Safari')) {
        return 'Safari';
    } elseif (strpos($user_agent, 'Firefox')) {
        return 'Firefox';
    } elseif (strpos($user_agent, 'MSIE') || strpos($user_agent, 'Trident/7')) {
        return 'Internet Explorer';
    }

    return 'Other';
}

$browser = get_browser_name($_SERVER['HTTP_USER_AGENT']);
$coord = $details->loc;

echo "<table border=1>";
echo "<tr>";
echo "<th>Przeglądarka</th>";
echo "<th>Loc</th>";
echo "<th>IP</th>";
echo "<th>Rozdzielczość ekranu</th>";
echo "<th>Rozdzielczość przeglądarki</th>";
echo "<th>Cookies</th>";
echo "<th>Aplety Java</th>";
echo "<th>Język</th>";
echo "</tr>";

$result = mysqli_query($link, "SELECT * FROM goscieportalu");

while ($row = mysqli_fetch_assoc($result)) {
    echo "<tr>";
    echo "<td>{$row['browsername']}</td>";
    echo "<td><a href='https://www.google.pl/maps/place/$coord'>Link</a></td>";
    echo "<td>$ip</td>";
    echo "<td>{$row['screenwh']}</td>";
    echo "<td>{$row['windowwh']}</td>";
    echo "<td>{$row['cookie']}</td>";
    echo "<td>{$row['java']}</td>";
    echo "<td>{$row['language']}</td>";
    echo "</tr>";
}

mysqli_close($link);
?>