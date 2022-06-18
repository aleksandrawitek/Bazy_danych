<?php
        $hostName = "localhost";
        $username = "root";
        $password = "";
        $databaseName = "awitek_hotel_app";
        $conn = new PDO("mysql:host=$hostName;dbname=$databaseName", $username, $password);
        $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

        $res=$_GET['res'];
        $pokoj=$_GET['pokoj'];
        $usluga=$_GET['usluga'];
        $kwota=$_GET['kwota'];


        try {
                $query = "INSERT INTO platnosc (rezerwacja_id, nr_pokoju, usluga, kwota) VALUES ('".$res."', '".$pokoj."', '".$usluga."', '".$kwota."')";
                $prepared = $conn->prepare($query);
                $prepared->execute();
                $result = $prepared -> fetchAll(PDO::FETCH_ASSOC);
                $query = "UPDATE zameldowany SET platnosc = platnosc + $kwota WHERE rezerwacja_id = '".$res."'";
                $prepared = $conn->prepare($query);
                $prepared->execute();
                $result = $prepared -> fetchAll(PDO::FETCH_ASSOC);
                ?>
                <?php
                } catch(PDOException $e) {
                echo "Error: " . $e->getMessage();
            }
    ?> 