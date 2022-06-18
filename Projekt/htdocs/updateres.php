<?php
        $hostName = "localhost";
        $username = "root";
        $password = "";
        $databaseName = "awitek_hotel_app";
        $conn = new PDO("mysql:host=$hostName;dbname=$databaseName", $username, $password);
        $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

        $id=$_GET['id'];
        $przyjazd=$_GET['przyjazd'];
        $wyjazd=$_GET['wyjazd'];
        $kwota=$_GET['kwota'];
        $komentarz=$_GET['komentarz'];


        try {
                $query = "UPDATE `rezerwacja` SET `komentarz`='".$komentarz."', `przyjazd`='".$przyjazd."', `wyjazd`='".$wyjazd."', `kwota/doba`='".$kwota."' WHERE `id_rezerwacji` = $id";
                //$query = "UPDATE rezerwacja SET przyjazd='".$przyjazd."',wyjazd='".$wyjazd."','kwota/doba'='".$kwota."','komentarz'='".$komentarz."' WHERE id_rezerwacji='".$id."'";
                $prepared = $conn->prepare($query);
                $prepared->execute();
                $result = $prepared -> fetchAll(PDO::FETCH_ASSOC);
                ?>
                <?php
                } catch(PDOException $e) {
                echo "Error: " . $e->getMessage();
            }
?> 