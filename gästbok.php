<?php

// Hämta inläggsdata från HTML-formuläret
$name = $_POST['name'];
$comment = $_POST['comment'];

// Anslut till databasen
$conn = mysqli_connect("localhost", "root", "", "webbserverprogrammering");

// Kontrollera om anslutningen lyckades
if (!$conn) {
    die("Anslutningen misslyckades: " . mysqli_connect_error());
}

// Skapa SQL-frågan för att lägga till inlägget i databasen
$query = "INSERT INTO guestbook (name, comment) VALUES ('$name', '$comment')";

// Kör SQL-frågan
if (mysqli_query($conn, $query)) {
    echo "Inlägget har sparats i databasen!";
} else {
    echo "Ett fel uppstod när inlägget skulle sparas: " . mysqli_error($conn);
}

// Skapa SQL-fråga för att hämta alla inlägg från databasen
$query = "SELECT name, comment FROM guestbook ORDER BY id DESC";

// Kör SQL-frågan
$result = mysqli_query($conn, $query);

// Kontrollera om frågan returnerade några resultat
if (mysqli_num_rows($result) > 0) {
    // Loopa igenom alla inlägg
    while ($row = mysqli_fetch_assoc($result)) {
        echo "TIDIGARE INLÄGG:    Name: " . $row["name"] . "<br>";
        echo "Comment: " . $row["comment"] . "<br><br>";
    }
} else {
    echo "Inga inlägg hittades i databasen.";
}

// Stäng anslutningen till databasen
mysqli_close($conn);
