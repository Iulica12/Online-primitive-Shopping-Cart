<?php
// se adauga si asta in vizualizare
session_start();
echo $_SESSION['id'];
?>
<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01//EN" "http://www.w3.org/TR/html4/strict.dtd">
<html>
<head>
    <title>Vizualizare Inregistrari</title>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
</head>
<body>
    <h1>Inregistrarile din tabela datepers</h1> 
    <p style="text-align: right"><a href="logout.php" class="btn btn-info btn-lg">
          <span class="glyphicon glyphicon-log-out"></span> Log out
        </a> </p>
    <p><b>Toate inregistrarile din datepers</b</p>
    <?php
        // connectare bazadedate
         include("Conectare.php");
        // se preiau inregistrarile din baza de date
        if ($result = $mysqli->query("SELECT * FROM tbl_product ORDER BY id "))
        { // Afisare inregistrari pe ecran
            if ($result->num_rows > 0)
            {
            // afisarea inregistrarilor intr-o table
            echo "<table border='1' cellpadding='10'>";
            // antetul tabelului
            echo "<tr><th>ID</th><th>Nume Produs</th><th>Cod Produs</th><th>Imagine</th><th>Descriere</th><th>Categorie</th><th></th><th></th></tr>";
            while ($row = $result->fetch_object())
            {
                // definirea unei linii pt fiecare inregistrare
                echo "<tr>";
                echo "<td>" . $row->id . "</td>";
                echo "<td>" . $row->name . "</td>";
                echo "<td>" . $row->code . "</td>";
                echo "<td>" . "<img src='$row->image' width='200' height='250'/>". "</td>";
                echo "<td>" . $row->descriere . "</td>";
                echo "<td>" . $row->categorie . "</td>";
                echo "<td><a href='Produse_Modificare.php?id=" . $row->id . "'>Modificare</a></td>";
                echo "<td><a href='Produse_Stergere.php?id=" .$row->id . "'>Stergere</a></td>";
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
    <a href="Produse_Inserare.php">Adaugarea unei noi inregistrari</a>
    <!--<//?=$_SESSION["username"]?><a href="logout.php">LOGOUT</a> -->
</body>
</html>