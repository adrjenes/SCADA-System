<?php
error_reporting(E_ALL ^ E_NOTICE);
ini_set('display_errors', 1);

$link = mysqli_connect('localhost', 'UR_USER', 'UR_PASSWORD', 'UR_DATABASE');
if (!$link) {
    echo "Błąd: " . mysqli_connect_errno() . " " . mysqli_connect_error();
}
mysqli_query($link, "SET NAMES 'utf8'");

$ip = $_SERVER['REMOTE_ADDR'];

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
$res = $_POST["res"];
$windowres = $_POST["windowres"];
$color = $_POST["color"];
$cookies = $_POST["cookies"];
$java = $_POST["java"];
$language = $_POST["language"];

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
$list = array();
while ($row = mysqli_fetch_array($result)) {
    $list[] = $row;
}

if (!empty($list)) {
    foreach ($list as $user) {
        echo "<tr>
        <td>$user[browsername]</td>
        <td><a href='https://www.google.pl/maps/place/$coord'>Link</a></td>
        <td>$ip</td>
        <td>$user[screenwh]</td>
        <td>$user[windowwh]</td>
        <td>$user[cookie]</td>
        <td>$user[java]</td>
        <td>$user[language]</td>
      </tr>";
    }
}

mysqli_query($link, "INSERT INTO `goscieportalu` (`ipaddress`,`browsername`,`screenwh`,`windowwh`,`screencd`,`cookie`,`java`,`language`) VALUES ('$ip','$browser','$res','$windowres','$color','$cookies','$java','$language')");
?>

<script>
    function sendAjaxRequest(url, method, data, callback) {
        var xhr = new XMLHttpRequest();
        xhr.open(method, url, true);
        xhr.setRequestHeader('Content-Type', 'application/x-www-form-urlencoded');
        xhr.onreadystatechange = function() {
            if (xhr.readyState === XMLHttpRequest.DONE) {
                if (xhr.status === 200) {
                    var response = JSON.parse(xhr.responseText);
                    callback(response);
                } else {
                    console.error('Błąd żądania: ' + xhr.status);
                }
            }
        };
        xhr.send(data);
    }

    function updatePage(data) {
        var table = document.getElementById('user-table');
        table.innerHTML = '';
        for (var i = 0; i < data.length; i++) {
            var user = data[i];
            var row = table.insertRow();
            row.insertCell().textContent = user.browsername;
            row.insertCell().innerHTML = '<a href="https://www.google.pl/maps/place/' + user.loc + '">Link</a>';
            row.insertCell().textContent = user.ipaddress;
            row.insertCell().textContent = user.screenwh;
            row.insertCell().textContent = user.windowwh;
            row.insertCell().textContent = user.cookie;
            row.insertCell().textContent = user.java;
            row.insertCell().textContent = user.language;
        }
    }

    function refreshData() {
        sendAjaxRequest('insert.php', 'GET', null, function(response) {
            updatePage(response);
        });
    }

    setInterval(refreshData, 5000);
</script>
