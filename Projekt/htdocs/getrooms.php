<?php
        $hostName = "localhost";
        $username = "root";
        $password = "";
        $databaseName = "awitek_hotel_app";
        $conn = new PDO("mysql:host=$hostName;dbname=$databaseName", $username, $password);
        $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

        $Id=$_GET['Id'];

        try {
            $query = "SELECT nr_pokoju FROM pokoj where pokoj.przyjazd!='".$przyjazd."' AND (pokoj.przyjazd>'".$przyjazd."' OR pokoj.przyjazd<=DATEADD('".$przyjazd."','".$wyjazd."'))";
            $prepared = $conn->prepare($query);
            $prepared->execute();
            $result = $prepared -> fetchAll(PDO::FETCH_ASSOC);
            ?>

            <?php
            foreach($result as $data) {
            ?>

            <?php
            }
            ?>
            <?php
            } catch(PDOException $e) {
            echo "Error: " . $e->getMessage();
        }
    ?> 