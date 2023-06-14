<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="pl" lang="pl">
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8">
    <title> Gidaszewski </title>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
</head>
<a href="scada.php">SCADA</a><br/><br/>
<a href="formularz.php">FORMULARZ</a><br/><br/>
<a href="uzytkownicyy.html">UŻYTKOWNICY</a><br/><br/>
<a href="wykres.php">PIERWSZY WYKRES</a><br/><br/>
<a href="wykres2.php">DRUGI WYKRES</a><br/><br/>
<a href="wykres3.php">TRZECI WYKRES</a><br/><br/>
<a href="tabella.html">TABELA</a><br/><br/>
<a href="google_tabella.html">TABELA GOOGLE</a><br/><br/>
<a href="google_tabela2.php">TABELA GOOGLE 2</a><br/><br/>

<script>
$(document).ready(function(){
    const form = $('#loginform');
    let res = screen.width + "x" + screen.height;
    let windowres = window.innerWidth + "x" + window.innerHeight;
    let color = screen.colorDepth;
    let cookies = navigator.cookieEnabled;
    let language = navigator.language;
    let java = navigator.javaEnabled();
    $.ajax({
        url:'insert.php',
        method:'POST',
        data:{
            res:res,
            windowres:windowres,
            color:color,
            cookies:cookies,
            language:language,
            java:java
        },
        success: (data) => {
            form.submit();
        }
    })
});
</script>