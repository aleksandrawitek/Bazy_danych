<?php
        $hostName = "localhost";
        $username = "root";
        $password = "";
        $databaseName = "awitek_hotel_app";
        $conn = new PDO("mysql:host=$hostName;dbname=$databaseName", $username, $password);
        $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

        $Id=$_GET['Id'];
        $w_uzytku=$_GET['w_uzytku'];
        $posprzatany=$_GET['posprzatany'];

        try {
                $query = "UPDATE pokoj SET w_uzytku = $w_uzytku , posprzatany = $posprzatany WHERE nr_pokoju =  '".$Id."'";
                $prepared = $conn->prepare($query);
                $prepared->execute();
                $result = $prepared -> fetchAll(PDO::FETCH_ASSOC);
                ?>
                <?php
                } catch(PDOException $e) {
                echo "Error: " . $e->getMessage();
            }
?> 