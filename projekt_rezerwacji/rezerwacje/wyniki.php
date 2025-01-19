<?php
include '../includes/polaczenie.php'; // Dołącz połączenie z bazą danych
global $pdo;

// Pobierz dane z formularza - to dobrze
$skad = isset($_GET['skad']) ? $_GET['skad'] : '';
$dokad = isset($_GET['dokad']) ? $_GET['dokad'] : '';
$data_od = isset($_GET['wylot']) ? date('Y-m-d', strtotime(str_replace('.', '-', $_GET['wylot']))) : '';
$data_do = isset($_GET['powrot']) && !empty($_GET['powrot']) ? date('Y-m-d', strtotime(str_replace('.', '-', $_GET['powrot']))) : '9999-12-31';
$klasa = isset($_GET['klasa']) ? $_GET['klasa'] : 'ekonomiczna';

// Przygotuj zapytanie SQL
$sql = "SELECT numer_lotu, miejsce_wylotu, miejsce_przylotu, data_lotu, ";
if ($klasa === 'ekonomiczna') {
    $sql .= "cena_eko AS cena, liczba_miejsc_eko AS miejsca, ";
} else {
    $sql .= "cena_biz AS cena, liczba_miejsc_biz AS miejsca, ";
}
$sql .= "godzina_wylotu, godzina_przylotu 
         FROM loty 
         WHERE miejsce_wylotu = :skad 
           AND miejsce_przylotu = :dokad 
           AND data_lotu BETWEEN :data_od AND :data_do";

// Debugowanie SQL (opcjonalne, usuń w wersji produkcyjnej)
//echo "Zapytanie SQL: $sql<br>";
//echo "Parametry: Skąd: $skad, Dokąd: $dokad, Data od: $data_od, Data do: $data_do<br>";

// Przygotuj i wykonaj zapytanie
$stmt = $pdo->prepare($sql);
$stmt->execute([
    ':skad' => $skad,
    ':dokad' => $dokad,
    ':data_od' => $data_od,
    ':data_do' => $data_do,
]);

// Pobierz wyniki tu dobrze
$loty = $stmt->fetchAll(PDO::FETCH_ASSOC);
?>

<!DOCTYPE html>
<html lang="pl">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Wyniki wylotu</title>
</head>
<body>
<h1>Wyniki lotu docelowego</h1>

<?php if (count($loty) > 0): ?>
    <table border="1">
        <thead>
        <tr>
            <th>Numer lotu</th>
            <th>Skąd</th>
            <th>Dokąd</th>
            <th>Data lotu</th>
            <th>Cena</th>
            <th>Liczba miejsc</th>
            <th>Godzina wylotu</th>
            <th>Godzina przylotu</th>
        </tr>
        </thead>
        <tbody>
        <?php foreach ($loty as $lot): ?>
            <tr>
                <td><?= htmlspecialchars($lot['numer_lotu']) ?></td>
                <td><?= htmlspecialchars($lot['miejsce_wylotu']) ?></td>
                <td><?= htmlspecialchars($lot['miejsce_przylotu']) ?></td>
                <td><?= htmlspecialchars($lot['data_lotu']) ?></td>
                <td><?= htmlspecialchars($lot['cena']) ?></td>
                <td><?= htmlspecialchars($lot['miejsca']) ?></td>
                <td><?= htmlspecialchars($lot['godzina_wylotu']) ?></td>
                <td><?= htmlspecialchars($lot['godzina_przylotu']) ?></td>
                <td>
                    <form action="wyniki_powrot.php" method="POST">
                        <input type="hidden" name="wybrany_dokad" value="<?= htmlspecialchars($lot['miejsce_przylotu']) ?>">
                        <input type="hidden" name="wybrany_skad" value="<?= htmlspecialchars($lot['miejsce_wylotu']) ?>">
                        <input type="hidden" name="wybrany_data" value="<?= htmlspecialchars($lot['data_lotu']) ?>">
                        <input type="hidden" name="klasa" value="<?= htmlspecialchars($klasa) ?>">
                        <button type="submit">Wybierz</button>
                    </form>
                </td>
            </tr>
        <?php endforeach; ?>
        </tbody>
    </table>
<?php else: ?>
    <p>Brak lotów spełniających kryteria wyszukiwania.</p>
<?php endif; ?>

</body>
</html>