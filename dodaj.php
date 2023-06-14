<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="pl" lang="pl">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script> <!-- Pobieramy jQuery -->
<script>
$(document).ready(function() {
  // Funkcja obsługująca wysyłkę formularza za pomocą AJAX
  $('form').submit(function(e) {
    e.preventDefault(); // Zatrzymujemy domyślne zachowanie formularza
    
    // Pobieramy dane z formularza
    var x1 = $('input[name="x1"]').val();
    var x2 = $('input[name="x2"]').val();
    var x3 = $('input[name="x3"]').val();
    var x4 = $('input[name="x4"]').val();
    var x5 = $('input[name="x5"]').val();
    
    // Tworzymy obiekt FormData i dodajemy do niego dane
    var formData = new FormData();
    formData.append('x1', x1);
    formData.append('x2', x2);
    formData.append('x3', x3);
    formData.append('x4', x4);
    formData.append('x5', x5);
    
    // Wysyłamy dane za pomocą AJAX
    $.ajax({
      url: 'get_data.php', // Adres pliku, który odbierze dane
      type: 'POST',
      data: formData,
      contentType: false,
      processData: false,
      success: function(response) {
        // Po udanej wysyłce wykonujemy odpowiednie czynności
        console.log(response); // Możesz wyświetlić odpowiedź serwera w konsoli
        // Dodaj tutaj kod do obsługi odpowiedzi serwera
      },
      error: function(xhr, status, error) {
        // Obsługa błędu
        console.log(error);
      }
    });
  });
});
</script>
</head>
<body>
<?php
 $x1 = $_POST['x1'];
 $x2 = $_POST['x2']; 
 $x3 = $_POST['x3']; 
 $x4 = $_POST['x4']; 
 $x5 = $_POST['x5']; 
 
 $link = mysqli_connect('localhost', 'UR_USER', 'UR_PASSWORD', 'UR_DATABASE'); 
 if (!$link) { 
   echo "Błąd: " . mysqli_connect_errno() . " " . mysqli_connect_error(); 
   exit;
 }
 mysqli_query($link, "SET NAMES 'utf8'"); // Ustawienie polskich znaków
 
 $sql = "INSERT INTO pomiary (`x1`, `x2`, `x3`, `x4`, `x5`) VALUES ('$x1', '$x2', '$x3', '$x4', '$x5')";
 if ($link->query($sql) === TRUE) {
   echo "New record created successfully";
 } else {
   echo "Niezgodność haseł lub brak połączenia z bazą danych.";
 }
?>
</body>
</html>