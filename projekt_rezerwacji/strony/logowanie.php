<?php
session_start();
$host = 'localhost';
$user = 'root';
$password = '';
$database = 'bazarezerwacji';

try {
    $pdo = new PDO("mysql:host=$host;dbname=$database;charset=utf8", $user, $password);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

} catch (PDOException $e) {
    die("Błąd połączenia: " . $e->getMessage());

}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $email = $_POST['email'];
    $password = $_POST['password'];

    try {
        global $pdo;
        $stmt = $pdo->prepare("SELECT * FROM users WHERE email = :email");
        $stmt->execute([':email' => $email]);
        $user = $stmt->fetch();

        if ($user && password_verify($password, $user['password'])) {
            echo "Zalogowano pomyślnie!";
        } else {
            echo "Nieprawidłowy e-mail lub hasło.";
        }
    } catch (PDOException $e) {
        echo "Błąd: " . $e->getMessage();
    }
}


if ($_SERVER["REQUEST_METHOD"] === "POST") {
    $email = filter_input(INPUT_POST, 'email', FILTER_VALIDATE_EMAIL);
    $password = $_POST['password'];
    $confirmPassword = $_POST['confirm_password'];

    // Walidacja pól
    if (!$email) {
        $errors[] = "Podaj poprawny adres e-mail.";
    }
    if (strlen($password) < 6) {
        $errors[] = "Hasło musi mieć co najmniej 6 znaków.";
    }
    if ($password !== $confirmPassword) {
        $errors[] = "Hasła nie są zgodne.";
    }

    // Jeśli brak błędów, dodaj użytkownika do bazy danych
    if (empty($errors)) {
        $hashedPassword = password_hash($password, PASSWORD_DEFAULT); // Szyfrowanie hasła

        try {
            $stmt = $pdo->prepare("INSERT INTO users (email, password) VALUES (:email, :password)");
            $stmt->execute([
                ':email' => $email,
                ':password' => $hashedPassword
            ]);

            $_SESSION['success'] = "Rejestracja zakończona pomyślnie. Możesz się zalogować.";
            header("Location: logowanie.php");
            exit;

        } catch (PDOException $e) {
            if ($e->getCode() === '23000') { // Kod błędu dla duplikatu (unique constraint violation)
                $errors[] = "Podany adres e-mail jest już zarejestrowany.";
            } else {
                $errors[] = "Wystąpił problem podczas rejestracji: " . $e->getMessage();
            }
        }
    }
}
?>

<!DOCTYPE html>
<html lang="pl">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Rejestracja</title>
    <link rel="stylesheet" href="../css/rejestStyle.css">
</head>
<body>
<div class="registration-container">
    <h1>Załóż konto</h1>
    <p>Wprowadź dane do rejestracji:</p>
    <form action="logowanie.php" method="POST" class="registration-form">
        <!-- E-mail -->
        <div class="form-group">
            <label for="email">E-mail *</label>
            <input type="email" id="email" name="email" required>
        </div>

        <!-- Hasło -->
        <div class="form-group">
            <label for="password">Hasło *</label>
            <input type="password" id="password" name="password" required>
            <ul class="password-requirements">
                <li>Minimum 8 znaków</li>
                <li>Minimum jedna wielka litera</li>
                <li>Minimum jedna mała litera</li>
                <li>Minimum jedna cyfra</li>
            </ul>
        </div>

        <!-- Powtórz hasło -->
        <div class="form-group">
            <label for="confirm_password">Powtórz hasło *</label>
            <input type="password" id="confirm_password" name="confirm_password" required>
        </div>

        <!-- Zgody -->
        <div class="form-group">
            <p>Witaj nowy użytkowniku. Zaznacz interesujące Cię zgody (zgody wymagane są oznaczone gwiazdką):</p>
            <div class="checkbox-group">
                <label>
                    <input type="checkbox" id="all_agreements">
                    Zaznacz wszystkie zgody
                </label>
                <label>
                    <input type="checkbox" name="terms" required>
                    * Zapoznałem się i akceptuję <a href="#">Regulamin Świadczenia Usług Drogą Elektroniczną</a>
                </label>
                <label>
                    <input type="checkbox" name="promotions">
                    Tak, chcę otrzymywać informacje o promocjach, nowych produktach i usługach drogą elektroniczną.
                </label>
                <label>
                    <input type="checkbox" name="partners">
                    Tak, chcę otrzymywać informacje o produktach i usługach partnerów.
                </label>
            </div>
        </div>

        <!-- Przyciski -->
        <div class="form-actions">
            <button type="submit" class="btn-submit">Kontynuuj</button>
        </div>
    </form>
</div>
</body>
</html>

