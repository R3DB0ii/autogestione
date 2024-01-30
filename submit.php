<?php
// Connessione al database
$servername = "sql11.freesqldatabase.com";
$username = "sql11680864";
$password = "DtLGIdQCHg";
$dbname = "sql11680864";

$conn = new mysqli($servername, $username, $password, $dbname);

// Verifica della connessione
if ($conn->connect_error) {
    die("Connessione al database fallita: " . $conn->connect_error);
}

// Recupero dei dati dal modulo HTML
$nome = $_POST['nome'];
$corso = $_POST['corso'];
$giorno = $_POST['giorno'];
$fascia = $_POST['fascia'];

// Verifica del limite di iscrizioni
$limit = 25; // Limite di iscrizioni per ogni corso

$sql = "SELECT COUNT(*) as count FROM iscrizioni WHERE corso='$corso'";
$result = $conn->query($sql);
$row = $result->fetch_assoc();
$count = $row['count'];

if ($count >= $limit) {
    echo "Il corso ha raggiunto il limite di iscrizioni.";
} else {
    // Inserimento dei dati nel database
    $sql = "INSERT INTO iscrizioni (nome, corso, giorno, fascia) VALUES ('$nome', '$corso', '$giorno', '$fascia')";

    if ($conn->query($sql) === TRUE) {
        echo "Iscrizione effettuata con successo.";
    } else {
        echo "Errore durante l'iscrizione: " . $conn->error;
    }
}

$conn->close();
?>
