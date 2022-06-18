<?php
        $hostName = "localhost";
        $username = "root";
        $password = "";
        $databaseName = "awitek_hotel_app";
        $conn = new PDO("mysql:host=$hostName;dbname=$databaseName", $username, $password);
        $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

        $Id=$_GET['Id'];
        $pesel=$_GET['pesel'];
        $imie=$_GET['imie'];
        $nazwisko=$_GET['nazwisko'];
        $przyjazd=$_GET['przyjazd'];
        $wyjazd=$_GET['wyjazd'];
        $pokoj=$_GET['pokoj'];
        $kwota=$_GET['kwota'];
        $komentarz=$_GET['komentarz'];


        try {
            $query = "INSERT INTO `zameldowany`(`rezerwacja_id`, `pesel_id`, `imie`, `nazwisko`, `nr_pokoju`, `platnosc`, `rozliczony`, `uwagi`) VALUES ('".$Id."',(SELECT pesel_id FROM rezerwacja where id_rezerwacji ='".$Id."'),(SELECT imie FROM rezerwacja where id_rezerwacji ='".$Id."'),(SELECT nazwisko FROM rezerwacja where id_rezerwacji ='".$Id."'),(SELECT numer_pokoju FROM rezerwacja where id_rezerwacji ='".$Id."'),(SELECT `kwota/doba` FROM rezerwacja where id_rezerwacji ='".$Id."'),'0','')";
            $prepared = $conn->prepare($query);
            $prepared->execute();
            $result = $prepared -> fetchAll(PDO::FETCH_ASSOC);
            $query = "UPDATE pokoj SET posprzatany='0', wolny='0' WHERE nr_pokoju= '".$pokoj."'";
            $prepared = $conn->prepare($query);
            $prepared->execute();
            $result = $prepared -> fetchAll(PDO::FETCH_ASSOC);
            ?>
            <?php
            } catch(PDOException $e) {
            echo "Error: " . $e->getMessage();
        }
    ?> 