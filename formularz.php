<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="pl" lang="pl">
<head>
 <meta http-equiv="Content-Type" content="text/html; charset=utf-8">
</head>
<body>
Formularz logowania
<form method="post" action="dodaj.php">
 x1: <input type="float" name="x1" maxlength="40" size="40" required><br>
  x2: <input type="float" name="x2" maxlength="40" size="40" required><br>
   x3: <input type="float" name="x3" maxlength="40" size="40" required><br>
    x4: <input type="float" name="x4" maxlength="40" size="40" required><br>
     x5: <input type="float" name="x5" maxlength="40" size="40" required><br><br>
     <label>Pożar:</label>
<select name="pytania">
  <option value="tak">Tak</option>
  <option value="nie">Nie</option>
</select><br><br>

<label>Zalanie:</label>
<select name="pytania">
  <option value="tak">Tak</option>
  <option value="nie">Nie</option>
</select><br><br>
<label>Włamanie:</label>
<select name="pytania">
  <option value="tak">Tak</option>
  <option value="nie">Nie</option>
</select><br><br>
<label>Czujnik CO:</label>
<select name="pytania">
  <option value="tak">Tak</option>
  <option value="nie">Nie</option>
</select><br><br>
 <input type="submit" value="Send"/>
</form>
</body>
</html>
