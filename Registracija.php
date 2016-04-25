<?php

//define('Hostas', 'localhost');
$Hostas = 'localhost';
define('DBVardas', 'vartotojai');
define('DBVartotojas', 'root');
define('Slaptazodis', '');

$con = mysql_connect($Hostas, DBVartotojas, Slaptazodis) or die("Failed to connect to MySQL: " . mysql_error());
$db = mysql_select_db(DBVardas, $con) or die("Failed to connect to MySQL: " . mysql_error());

function NaujasVartotojas() {
    global $con;
    $Vardas_Pavarde = $_POST['Vardas_Pavarde'];
    $rajonas = $_POST['rajonas'];
    $telefonas = $_POST['telefonas'];
    $email = $_POST['email'];
    $slaptazodis = $_POST['slaptazodis'];
    $query = "INSERT INTO vartotojai (Vardas_Pavarde,rajonas,telefonas,email,slaptazodis) VALUES ('$Vardas_Pavarde','$rajonas','$telefonas','$email','$slaptazodis')";
    $data = mysql_query($query,$con) or die(mysql_error());
    if ($data) {
        return TRUE;
    }
}

function Registracija() {
    global $con;
    $email = $_POST['email'];
    if (isset($email)) {
        $query = "SELECT count(*) c FROM vartotojai WHERE email = '$email'";

        $data = mysql_query($query,$con) or die(mysql_error());
        $row = mysql_fetch_array($data) or die(mysql_error());      
       if ((int)$row['c'] == 0) {
            return TRUE;
        } else {
            return FALSE;
        }
    }
    else {
        return FALSE;
    }
}

if (isset($_POST['submit'])) {
    if (Registracija()) {
        NaujasVartotojas();
        echo "Vartotojas ".$_POST['email']." sukurtas";
    } else {
        echo "Vartotojas ".$_POST['email']." jau egzistuoja!";
    }
}

mysql_close($con);
?>