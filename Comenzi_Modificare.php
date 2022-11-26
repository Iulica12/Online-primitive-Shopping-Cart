<?php 
// connectare bazadedate
    include("Conectare.php");
    //Modificare datelor
    // se preia id din pagina vizualizare
    $error='';
    if (!empty($_POST['id']))
    { 
        if (isset($_POST['submit']))
        { 
            // verificam daca id-ul din URL este unul valid
            if (is_numeric($_POST['id']))
            { 
            // preluam variabilele din URL/form
                $id = $_POST['id'];
                $id_produs = htmlentities($_POST['id_produs'], ENT_QUOTES);
                $cantitate = htmlentities($_POST['cantitate'], ENT_QUOTES);
                $id_client = htmlentities($_POST['id_client'], ENT_QUOTES);
                $data_int = htmlentities($_POST['data_int'], ENT_QUOTES);
                $stare_com = htmlentities($_POST['stare_com'], ENT_QUOTES);
                $data_cump = htmlentities($_POST['data_cump'], ENT_QUOTES);
                // verificam daca sunt completate
                if ($id_produs == ''||$cantitate==''||$id_client==''||$data_int==''||$stare_com==''||$data_cump=='')
                {
                    // daca sunt goale se afiseaza un mesaj
                    $error = 'ERROR: Campuri goale!';
                } 
                else
                { 
                    // daca nu sunt erori se face update name, code, image, price, descriere, categorie
                    if ($stmt = $mysqli->prepare("UPDATE comenzi SET produ_id=?,cantitate=?,client_id=?,data_introd=?, stare_comanda=?, data_cumparare=? WHERE comenzi_id='".$id."'"))
                    {
                        $stmt->bind_param("iiisss",$id_produs,$cantitate,$id_client,$data_int,$stare_com,$data_cump);
                        $stmt->execute();
                         $stmt->close();
                    }
                    // mesaj de eroare in caz ca nu se poate face update
                    else
                    {
                        echo "ERROR: nu se poate executa update.";}
                    }
            }
    // daca variabila 'id' nu este valida, afisam mesaj de eroare
    else
    {
        echo "id incorect!";
    } 
        }
    }
?>
<html> 
<head>
    <title> <?php if ($_GET['id'] != '') { echo "Modificare inregistrare"; }?> </title>
    <meta http-equiv="Content-Type" content="text/html; charset=utf8"/></head>
<body>
    <h1>
    <?php 
        if ($_GET['id'] != '') { echo "Modificare Inregistrare"; }
    ?>
    </h1>
    <?php 
    if ($error != '') {echo "<div style='padding:4px; border:1px solid red; color:red'>" . $error."</div>";} 
    ?>
    <form action="" method="post">
        <div>
            <?php if ($_GET['id'] != '') { ?>
            <input type="hidden" name="id" value="<?php echo $_GET['id'];?>" />
            <p>ID: <?php echo $_GET['id'];
            if ($result = $mysqli->query("SELECT * FROM comenzi where comenzi_id='".$_GET['id']."'"))
            {
            if ($result->num_rows > 0)
            { $row = $result->fetch_object();?></p>
            <strong>ID Produs: </strong> <input type="text" name="id_produs" value="<?php echo$row->produ_id;?>"/><br/>
            <strong>Cantitate: </strong> <input type="text" name="cantitate" value="<?php echo$row->cantitate;?>"/><br/>
            <strong>ID Client: </strong> <input type="text" name="id_client" value="<?php echo$row->client_id;?>"/><br/>
            <strong>Data Int: </strong> <input type="text" name="data_int" value="<?php echo$row->data_introd;?>"/><br/>
            <strong>Stare Comanda: </strong> <input type="text" name="stare_com" value="<?php echo$row->stare_comanda;?>"/><br/>
            <strong>Data Cumparare: </strong> <input type="text" name="data_cump" value="<?php echo$row->data_cumparare;}}}?>"/><br/>
            <br/>
            <input type="submit" name="submit" value="Submit" />
            <a href="Comenzi_Vizualizare.php">Index</a>
        </div>
    </form>
</body>
</html>