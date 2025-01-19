<?php
include '../includes/polaczenie.php'; // Połączenie z bazą danych
global $pdo;

// Pobierz dane z POST
$powrot_skad = isset($_POST['wybrany_dokad']) ? $_POST['wybrany_dokad'] : '';
$powrot_dokad = isset($_POST['wybrany_skad']) ? $_POST['wybrany_skad'] : '';
$data_od = isset($_POST['wybrany_data']) ? $_POST['wybrany_data'] : '';
$data_do = isset($_POST['data_do']) && !empty($_POST['data_do']) ? $_POST['data_do'] : '9999-12-31';
$klasa = isset($_POST['klasa']) ? $_POST['klasa'] : 'ekonomiczna';

// Przygotuj zapytanie SQL dla lotów powrotnych
$sql_powrot = "SELECT numer_lotu, miejsce_wylotu, miejsce_przylotu, data_lotu, ";
if ($klasa === 'ekonomiczna') {
    $sql_powrot .= "cena_eko AS cena, liczba_miejsc_eko AS miejsca, ";
} else {
    $sql_powrot .= "cena_biz AS cena, liczba_miejsc_biz AS miejsca, ";
}
$sql_powrot .= "godzina_wylotu, godzina_przylotu 
                FROM loty 
                WHERE miejsce_wylotu = :powrot_skad 
                  AND miejsce_przylotu = :powrot_dokad 
                  AND data_lotu >= :data_od";

$stmt_powrot = $pdo->prepare($sql_powrot);
$stmt_powrot->execute([
    ':powrot_skad' => $powrot_skad,
    ':powrot_dokad' => $powrot_dokad,
    ':data_od' => $data_od,
]);

$loty_powrot = $stmt_powrot->fetchAll(PDO::FETCH_ASSOC);
?>

<!DOCTYPE html>
<html lang="pl">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Wyniki powrotu</title>
</head>
<body>
<h1>Wyniki lotu powrotnego</h1>

<?php if (count($loty_powrot) > 0): ?>
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
            <th>Akcja</th>
        </tr>
        </thead>
        <tbody>
        <?php foreach ($loty_powrot as $lot): ?>
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
                    <a href="formularz_rezerwacji.php?numer_lotu=<?= htmlspecialchars($lot['numer_lotu']) ?>&skad=<?= htmlspecialchars($lot['miejsce_wylotu']) ?>&dokad=<?= htmlspecialchars($lot['miejsce_przylotu']) ?>&data_lotu=<?= htmlspecialchars($lot['data_lotu']) ?>&cena=<?= htmlspecialchars($lot['cena']) ?>&godzina_wylotu=<?= htmlspecialchars($lot['godzina_wylotu']) ?>&godzina_przylotu=<?= htmlspecialchars($lot['godzina_przylotu']) ?>">
                        <button>Wybierz</button>
                    </a>
                </td>
            </tr>
        <?php endforeach; ?>
        </tbody>
    </table>
<?php else: ?>
    <p>Brak lotów powrotnych spełniających kryteria.</p>
<?php endif; ?>

</body>
</html>