<?php
    include("Conectare.php");
    $error='';
    if (isset($_POST['submit']))
    {
        // preluam datele de pe formular
        $id_comanda = htmlentities($_POST['id_comanda'], ENT_QUOTES);
        $id_produs = htmlentities($_POST['id_produs'], ENT_QUOTES);
        $cantitate = htmlentities($_POST['cantitate'], ENT_QUOTES);
        $id_client = htmlentities($_POST['id_client'], ENT_QUOTES);
        $data_int = htmlentities($_POST['data_int'], ENT_QUOTES);
        $stare_com = htmlentities($_POST['stare_com'], ENT_QUOTES);
        $data_cump = htmlentities($_POST['data_cump'], ENT_QUOTES);
        // verificam daca sunt completate
        if ($id_comanda == '' || $id_produs == ''||$cantitate==''||$id_client==''||$data_int==''||$stare_com==''||$data_cump=='')
        {
            // daca sunt goale se afiseaza un mesaj
            $error = 'ERROR: Campuri goale!';
        } 
        else 
        {
            // insert
            if ($stmt = $mysqli->prepare("INSERT into comenzi (comenzi_id, produ_id, cantitate, client_id, data_introd, stare_comanda, data_cumparare) VALUES (?, ?, ?, ?, ?, ?, ?)"))
            {
                $stmt->bind_param("iiiisss", $id_comanda, $id_produs,$cantitate,$id_client,$data_int,$stare_com,$data_cump);
                $stmt->execute();
                $stmt->close();
            }
            // eroare le inserare
            else
            {
                echo "ERROR: Nu se poate executa insert.";
            }
        }
    }
    // se inchide conexiune mysqli
    $mysqli->close();
?>
<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01//EN" "http://www.w3.org/TR/html4/strict.dtd">
<html>
<head>
<title><?php echo "Inserare inregistrare"; ?> </title>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
</head> 
<body>
    <h1><?php echo "Inserare inregistrare"; ?></h1>
    <?php if ($error != '') {
    echo "<div style='padding:4px; border:1px solid red; color:red'>" . $error."</div>";} ?>
    <form action="" method="post">
        <div>
            <strong>ID comanda: </strong> <input type="text" name="id_comanda" value=""/><br/>
            <strong>ID Produs: </strong> <input type="text" name="id_produs" value=""/><br/>
            <strong>Cantitate: </strong> <input type="text" name="cantitate" value=""/><br/>
            <strong>ID Client: </strong> <input type="text" name="id_client" value=""/><br/>
            <strong>Data Int: </strong> <input type="text" name="data_int" value=""/><br/>
            <strong>Stare Comanda: </strong> <input type="text" name="stare_com" value=""/><br/>
            <strong>Data Cumparare: </strong> <input type="text" name="data_cump" value=""/><br/>
            <br/>
            <input type="submit" name="submit" value="Submit" />
            <a href="Comenzi_Vizualizare.php">Index</a>
        </div>
    </form>
</body>
</html>