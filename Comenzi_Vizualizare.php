<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01//EN" "http://www.w3.org/TR/html4/strict.dtd">
<html>
<head>
    <title>Vizualizare Inregistrari</title>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
</head>
<body>
    <h1>Inregistrarile din tabela Comenzi</h1>
    <p><b>Toate inregistrarile din comenzi</b</p>
    <?php
        // connectare bazadedate
         include("Conectare.php");
        // se preiau inregistrarile din baza de date
        if ($result = $mysqli->query("SELECT * FROM comenzi ORDER BY comenzi_id "))
        { // Afisare inregistrari pe ecran
            if ($result->num_rows > 0)
            {
            // afisarea inregistrarilor intr-o table
            echo "<table border='1' cellpadding='10'>";
            // antetul tabelului
            echo "<tr><th>ID Comanda</th><th>ID Produs</th><th>Cantitate</th><th>ID Client</th><th>Data Introd</th><th>Stare Comanda</th><th>Data Cumparare</th><th></th><th></th></tr>";
            while ($row = $result->fetch_object())
            {
                // definirea unei linii pt fiecare inregistrare
                echo "<tr>";
                echo "<td>" . $row->comenzi_id . "</td>";
                echo "<td>" . $row->produ_id . "</td>";
                echo "<td>" . $row->cantitate . "</td>";
                echo "<td>" . $row->client_id . "</td>";
                echo "<td>" . $row->data_introd . "</td>";
                echo "<td>" . $row->stare_comanda . "</td>";
                echo "<td>" . $row->data_cumparare . "</td>";
                echo "<td><a href='Comenzi_Modificare.php?id=" . $row->comenzi_id . "'>Modificare</a></td>";
                echo "<td><a href='Comenzi_Stergere.php?id=" .$row->comenzi_id . "'>Stergere</a></td>";
                echo "</tr>";
            }
                echo "</table>";
            }
            // daca nu sunt inregistrari se afiseaza un rezultat de eroare
            else
            {
                echo "Nu sunt inregistrari in tabela!";
            }
        }
        // eroare in caz de insucces in interogare
        else
        { 
            echo "Error: " . $mysqli->error(); 
        }
        // se inchide
        $mysqli->close();
    ?>
    <a href="Comenzi_Inserare.php">Adaugarea unei noi inregistrari</a>
    <!--<//?=$_SESSION["username"]?><a href="logout.php">LOGOUT</a> -->
</body>
</html>