<?php
// Connessione al database
$servername = "localhost";
$username = "username";
$password = "password";
$dbname = "nome_database";

$conn = new mysqli($servername, $username, $password, $dbname);

// Verifica della connessione
if ($conn->connect_error) {
    die("Connessione al database fallita: " . $conn->connect_error);
}

// Recupero dei dati dal modulo HTML
$corso = $_POST['corso'];
$giorno = $_POST['giorno'];
$ora = $_POST['ora'];

// Verifica del limite di iscrizioni
$limit = 10; // Limite di iscrizioni per ogni corso

$sql = "SELECT COUNT(*) as count FROM iscrizioni WHERE corso='$corso'";
$result = $conn->query($sql);
$row = $result->fetch_assoc();
$count = $row['count'];

if ($count >= $limit) {
    echo "Il corso ha raggiunto il limite di iscrizioni.";
} else {
    // Inserimento dei dati nel database
    $sql = "INSERT INTO iscrizioni (corso, giorno, ora) VALUES ('$corso', '$giorno', '$ora')";

    if ($conn->query($sql) === TRUE) {
        echo "Iscrizione effettuata con successo.";
    } else {
        echo "Errore durante l'iscrizione: " . $conn->error;
    }
}

$conn->close();
?>