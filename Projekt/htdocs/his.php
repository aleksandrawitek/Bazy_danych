<!DOCTYPE html>
<html>
    <head>
        <style>
            body {background-image: url("img/background.png");}
            .newres {border-radius: 12px; background-color:#e6ffe6;}
            .new {border-radius: 12px; background-color:#e6ffe6;}
            input {border-radius: 12px;}
            #prev {width: 10%; height: 10%;}
            #all {border-collapse: collapse;}
            #all tr {border:solid black;}
            #all td {width:10%;}
            .select, .add {border-radius: 12px; background-color: grey;}
        </style>
        <title> Kartoteka </title>
    </head>
<body>
    <table>
     <tr>
        <td><img id="prev" src="img/prev.png" onclick="window.location.href='main.html'"></td>
        <td>
        <form method="post">
            <select id="tosearch" name = "tosearch">
                <option value="">Wyszukaj po: </option>
                <option value="pesel">Numerze pesel</option>
                <option value="imie">Imieniu</option>
                <option value="nazwisko">Nazwisku</option>
                <option value="imnazw">Imieniu i nazwisku</option>
            </select>
            </td>
            <td>
            <input id="wyszukajpo" name="wyszukajpo">
            <input id='submit' name="set" type="submit" value="Wyszukaj">
        </form>
        </td>
</td>
    </tr>
    <tr>
        <td></td>
        <td><button class = "new" id = "dodajwpis"><b>Dodaj nową osobę</b> </button></td>
        <td></td>
    </tr>
    <tr></tr>
    </table>
    <?php
        $hostName = "localhost";
        $username = "root";
        $password = "";
        $databaseName = "awitek_hotel_app";
        $conn = new PDO("mysql:host=$hostName;dbname=$databaseName", $username, $password);
        $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            $text = $_POST['wyszukajpo'];
            $tosearch = $_POST['tosearch'];
            $hostName = "localhost";
            $username = "root";
            $password = "";
            $databaseName = "awitek_hotel_app";
            $conn = new PDO("mysql:host=$hostName;dbname=$databaseName", $username, $password);
            $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

        try {
                if($tosearch=="imie"){
                    $query = "SELECT * FROM gosc WHERE imie =  '".$text."'";
                } elseif($tosearch=="nazwisko"){
                    $query = "SELECT * FROM gosc WHERE nazwisko =  '".$text."'";
                } elseif($tosearch=="pesel"){
                    $query = "SELECT * FROM gosc WHERE id_pesel = '".$text."'";
                } elseif($tosearch=="imnazw"){
                    $all = explode(" ", $text);
                    $query = "SELECT * FROM gosc WHERE imie =  '".$all[0]."' AND nazwisko = '".$all[1]."' ";
                } else{
                    $query = "SELECT * FROM gosc order by nazwisko, imie asc";
                }
                $prepared = $conn->prepare($query);
                $prepared->execute();
                $result = $prepared -> fetchAll(PDO::FETCH_ASSOC);
                ?>
                <table id = "all">
                <tr>
                <center><td><b> Edytuj/Dodaj rezerwację</td><center>
                <center><td><b> Pesel </td><center>
                <center><td><b> Imię </td><center>
                <center><td><b> Nazwisko </td><center>
                <center><td><b> Rabat</td><center>
                <center><td><b> Telefon </td><center>
                </tr>
                <?php
                foreach($result as $data) {
                ?>
                <tr>
                <center><td><button class = "select" id =<?php echo $data['pesel_id']; ?>> Edytuj </button><button class = "newres" id = <?php echo $data['id_pesel'];?>> Dodaj rezerwację </button></td><center>
                <center><td><?php echo $data['id_pesel']; ?> </td><center>
                <center><td><?php echo $data['imie']; ?> </td><center>
                <center><td><?php echo $data['nazwisko']; ?> </td><center>
                <center><td><?php echo $data['rabat']; ?> </td><center>
                <center><td><?php echo $data['telefon']; ?> </td><center>
                </tr>
                <?php
                }
                ?>
                </table>
                <?php
                } catch(PDOException $e) {
                echo "Error: " . $e->getMessage();
            }}

        else{
        try {
                $query = "SELECT * FROM gosc order by nazwisko, imie asc";
                $prepared = $conn->prepare($query);
                $prepared->execute();
                $result = $prepared -> fetchAll(PDO::FETCH_ASSOC);
                ?>
                <table id = "all">
                <tr>
                <center><td><b> Edytuj/Dodaj rezerwację</td><center>
                <center><td><b> Pesel </td><center>
                <center><td><b> Imię </td><center>
                <center><td><b> Nazwisko </td><center>
                <center><td><b> Rabat</td><center>
                <center><td><b> Telefon </td><center>
                </tr>
                <?php
                foreach($result as $data) {
                ?>
                <tr>
                <center><td><button class = "select" id =<?php echo $data['id_pesel']; ?>> Edytuj </button><button class = "newres" id = <?php echo $data['id_pesel'];?>> Dodaj rezerwację </button></td><center>
                <center><td><?php echo $data['id_pesel']; ?> </td><center>
                <center><td><?php echo $data['imie']; ?> </td><center>
                <center><td><?php echo $data['nazwisko']; ?> </td><center>
                <center><td><?php echo $data['rabat']; ?> </td><center>
                <center><td><?php echo $data['telefon']; ?> </td><center>
                </tr>
                <?php
                }
                ?>
                </table>
                <?php
                } catch(PDOException $e) {
                echo "Error: " . $e->getMessage();
            }}
    ?>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script> 
    <script>
        $(".select").click(function() {
            var Id=$(this).attr('id');
            window.close();
            window.open('hisdetails.php?Id='+Id);
            location.close();
        });

        $("#dodajwpis").click(function() {
            window.close();
            window.open('addhis.php');
            location.close();
        });

        $(".newres").click(function() {
            var Id=$(this).attr('id');
            window.close();
            window.open('addnewres.php?Id='+Id);
            location.close();
        });
      
    </script>
    
</body>
</html>