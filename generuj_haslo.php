<?php
$servername = "localhost"; 
$username = "root"; 
$password = ""; 
$dbname = "generator_hasla"; 

$conn = new mysqli($servername, $username, $password, $dbname);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

$minMaleLitery = isset($_POST['minMaleLitery']) ? (int)$_POST['minMaleLitery'] : 0;
$minDuzeLitery = isset($_POST['minDuzeLitery']) ? (int)$_POST['minDuzeLitery'] : 0;
$minCyfry = isset($_POST['minCyfry']) ? (int)$_POST['minCyfry'] : 0;
$minZnakiSpecjalne = isset($_POST['minZnakiSpecjalne']) ? (int)$_POST['minZnakiSpecjalne'] : 0;

$dlugosc = isset($_POST['dlugosc']) ? (int)$_POST['dlugosc'] : 10;
$uzyjMaleLitery = isset($_POST['ch1']);
$uzyjDuzeLitery = isset($_POST['ch2']);
$uzyjCyfry = isset($_POST['ch3']);
$uzyjZnakiSpecjalne = isset($_POST['ch4']);

if ($dlugosc < $minMaleLitery + $minDuzeLitery + $minCyfry + $minZnakiSpecjalne) {
    echo "Nie można utworzyć hasła z błędnymi danymi!";
    exit;
}

$maleLitery = 'abcdefghijklmnopqrstuvwxyz';
$duzeLitery = 'ABCDEFGHIJKLMNOPQRSTUVWXYZ';
$cyfry = '0123456789';
$znakiSpecjalne = '!@#$%^&*()_+[]{}|;:,.<>?';

$znakiHasla = '';
$haslo = '';

if ($uzyjMaleLitery) $znakiHasla .= $maleLitery;
if ($uzyjDuzeLitery) $znakiHasla .= $duzeLitery;
if ($uzyjCyfry) $znakiHasla .= $cyfry;
if ($uzyjZnakiSpecjalne) $znakiHasla .= $znakiSpecjalne;

function losoweZnaki($znaki, $ilosc) {
    $wynik = '';
    $length = strlen($znaki);
    for ($i = 0; $i < $ilosc; $i++) {
        $wynik .= $znaki[rand(0, $length - 1)];
    }
    return $wynik;
}

$haslo .= losoweZnaki($maleLitery, $minMaleLitery);
$haslo .= losoweZnaki($duzeLitery, $minDuzeLitery);
$haslo .= losoweZnaki($cyfry, $minCyfry);
$haslo .= losoweZnaki($znakiSpecjalne, $minZnakiSpecjalne);

$pozostalaDlugosc = $dlugosc - strlen($haslo);
$haslo .= losoweZnaki($znakiHasla, $pozostalaDlugosc);

$haslo = str_shuffle($haslo);

$dataWygenerowania = date("Y-m-d H:i:s");
$sql = "INSERT INTO generated_passwords (haslo, kiedy) VALUES ('$haslo', '$dataWygenerowania')";

if ($conn->query($sql) === TRUE) {
    header("Location: index.php?password=" . urlencode($haslo));
} else {
    echo "Błąd: " . $sql . "<br>" . $conn->error;
}

$conn->close();
?>
