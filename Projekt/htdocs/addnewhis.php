<?php
        $hostName = "localhost";
        $username = "root";
        $password = "";
        $databaseName = "awitek_hotel_app";
        $conn = new PDO("mysql:host=$hostName;dbname=$databaseName", $username, $password);
        $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

        $pesel=$_GET['pesel'];
        $imie=$_GET['imie'];
        $nazwisko=$_GET['nazwisko'];
        $rabat=$_GET['rabat'];
        $telefon=$_GET['telefon'];


        try {
                $query = "INSERT INTO gosc (id_pesel, imie, nazwisko, rabat, telefon, historia) VALUES ('".$pesel."', '".$imie."', '".$nazwisko."', '".$rabat."', '".$telefon."', NULL)";
                $prepared = $conn->prepare($query);
                $prepared->execute();
                $result = $prepared -> fetchAll(PDO::FETCH_ASSOC);
                ?>
                <?php
                } catch(PDOException $e) {
                echo "Error: " . $e->getMessage();
            }
    ?> 