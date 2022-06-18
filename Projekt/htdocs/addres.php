<?php
        $hostName = "localhost";
        $username = "root";
        $password = "";
        $databaseName = "awitek_hotel_app";
        $conn = new PDO("mysql:host=$hostName;dbname=$databaseName", $username, $password);
        $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

        $pesel=$_GET['pesel'];
        $id=$_GET['id'];
        $imie=$_GET['imie'];
        $nazwisko=$_GET['nazwisko'];
        $przyjazd=$_GET['przyjazd'];
        $wyjazd=$_GET['wyjazd'];
        $kwota=$_GET['kwota'];
        $komentarz=$_GET['komentarz'];
        $pokoj=$_GET['pokoj'];

        try {
                //$query = "INSERT INTO rezerwacja (id_rezerwacji,pesel_id, imie, nazwisko, przyjazd, wyjazd, numer_pokoju, 'kwota/doba', komentarz) VALUES (NULL, '".$pesel."','".$imie."', '".$nazwisko."', '".$przyjazd."', '".$wyjazd."', '".$pokoj."', '".$kwota."', '".$komentarz."')";
                $query = "INSERT INTO `rezerwacja`(`id_rezerwacji`, `pesel_id`, `imie`, `nazwisko`, `przyjazd`, `wyjazd`, `numer_pokoju`, `kwota/doba`, `komentarz`) VALUES (NULL, '".$pesel."', '".$imie."', '".$nazwisko."', '".$przyjazd."', '".$wyjazd."', '".$pokoj."', '".$kwota."', '".$komentarz."')";
                $prepared = $conn->prepare($query);
                $prepared->execute();
                $result = $prepared -> fetchAll(PDO::FETCH_ASSOC);

                $query = "UPDATE pokoj SET rezerwacja_id = (SELECT id_rezerwacji FROM rezerwacja WHERE pesel_id = '".$pesel."'), przyjazd = '".$przyjazd."', wyjazd = '".$wyjazd."' WHERE nr_pokoju = '".$pokoj."'";
                $prepared = $conn->prepare($query);
                $prepared->execute();
                $result = $prepared -> fetchAll(PDO::FETCH_ASSOC);
                ?>
                <?php
                } catch(PDOException $e) {
                echo "Error: " . $e->getMessage();
            }
        
    ?> 