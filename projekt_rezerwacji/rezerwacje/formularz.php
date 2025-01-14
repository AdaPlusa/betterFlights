<!DOCTYPE html>
<html lang="pl">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>ddsd</title>
    <link rel="stylesheet" href="../css/style.css">
</head>
<body>
<div class="formularz">
    <div class="menu-gorne">
        <a href="#zarezerwuj" class="zakladka aktywna">Zarezerwuj</a>
        <a href="#panel_administracyjny" class="zakladka">Panel administracyjny</a>
    </div>
    <div class="typ-lotu">
        <button id="lot-obie-strony" class="aktywny" type="button">Lot w obie strony</button>
        <button id="lot-jedna-strona" type="button">Lot w jedną stronę</button>
    </div>

    <form action="#" method="post">
        <!-- Skąd -->
        <div class="pole">
            <label for="skad">Skąd</label>
            <select id="skad" name="skad">

            </select>
        </div>

        <!-- Dokąd -->
        <div class="pole">
            <label for="dokad">Dokąd</label>
            <select id="dokad" name="dokad">

            </select>
        </div>

        <!-- Data wylotu -->
        <div class="pole">
            <label for="wylot">Wylot</label>
            <input type="date" id="wylot" name="wylot" required>
        </div>

        <!-- Data powrotu -->
        <div class="pole">
            <label for="powrot">Powrót</label>
            <input type="date" id="powrot" name="powrot">
        </div>


        <!-- Klasa -->
        <div class="pole">
            <label for="klasa">Klasa podróży</label>
            <select id="klasa" name="klasa">
                <option value="ekonomiczna">Ekonomiczna</option>
                <option value="biznesowa">Biznesowa</option>
            </select>
        </div>
        <!-- pasażerowie -->
        <div class="pole liczba-pasazerow">
            <label for="pasazerowie">Pasażerowie</label>
            <div class="kontener-pasazerowie">
                <button type="button" id="minus" class="przycisk">-</button>
                <input type="number" id="pasazerowie" name="pasazerowie" value="1" min="1" max="10" readonly>
                <button type="button" id="plus" class="przycisk">+</button>
            </div>
        </div>

        <!-- Przycisk wyszukiwania -->
        <div class="pole">
            <button type="submit" id="szukaj">Szukaj</button>
        </div>
    </form>
</div>




<script src="../js/skrypt.js"></script>
</body>
</html>
