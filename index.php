<!DOCTYPE html>
<html lang="pl">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Generator Haseł</title>
    <link rel="stylesheet" href="style.css">
</head>
<body onload="aktualizujDlugosc()">
    <nav id="naglowek">
        <h1>Generator</h1>
        <h1>Hasła</h1>
    </nav>
    <nav id="nTwo">
        <div id="haslo">
            <p>Twoje hasło:</p>
            <p id="wynik"><?php echo isset($_GET['password']) ? htmlspecialchars($_GET['password']) : ''; ?></p>
        </div>
    </nav>
    <div id="main">
        <form id="opcje" action="generuj_haslo.php" method="post">
            <div id="ml" class="o">
                <p>Chcesz małe litery?</p>
                <input type="checkbox" name="ch1" id="ch1" checked>
                <label for="minMaleLitery">Min:</label>
                <input type="number" id="minMaleLitery" name="minMaleLitery" min="0" value="3" oninput="Liczby(this)">
            </div>
            <div id="dl1" class="o">
                <p>Chcesz duże litery?</p>
                <input type="checkbox" name="ch2" id="ch2" checked>
                <label for="minDuzeLitery">Min:</label>
                <input type="number" id="minDuzeLitery" name="minDuzeLitery" min="0" value="3" oninput="Liczby(this)">
            </div>
            <div id="cy" class="o">
                <p>Chcesz cyfry?</p>
                <input type="checkbox" name="ch3" id="ch3" checked>
                <label for="minCyfry">Min:</label>
                <input type="number" id="minCyfry" name="minCyfry" min="0" value="2" oninput="Liczby(this)">
            </div>
            <div id="zs" class="o">
                <p>Chcesz znaki specjalne?</p>
                <input type="checkbox" name="ch4" id="ch4" checked>
                <label for="minZnakiSpecjalne">Min:</label>
                <input type="number" id="minZnakiSpecjalne" name="minZnakiSpecjalne" min="0" value="2" oninput="Liczby(this)">
            </div>
            <div id="dl2">
                <p>Długość znaków: </p>
                <p id="dl-wynik"></p>
                <input type="range" name="dlugosc" id="dlugosc" onchange="aktualizujDlugosc()" min="1" max="20" value="10">
            </div>
            <div id="przycisk">
                <button type="submit" style="cursor: pointer;">Generuj</button>
            </div>
        </form>
    </div>
    
    <script>
    function Liczby(input) {
        input.value = input.value.replace(/[^0-9]/g, ''); 
    }

    function aktualizujDlugosc() {
        document.getElementById('dl-wynik').textContent = document.getElementById('dlugosc').value;
    }
    </script>

</body>
</html>
