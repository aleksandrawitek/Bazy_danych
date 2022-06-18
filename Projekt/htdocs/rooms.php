<!DOCTYPE html>
<html>
    <head>
        <style>
            body {background-image: url("img/background.png");}
            #submit {border-radius: 12px; background-color:#ffb3b3;}
            input {border-radius: 12px;}
            #prev {width: 10%; height: 10%;}
            #all {border-collapse: collapse;}
            #all tr {border:solid black;}
            #all td {width:10%;}
            .select {border-radius: 12px; background-color: grey;}
        </style>
        <title> Pokoje </title>
    </head>
<body>
    <table>
     <tr>
        <td><img id="prev" src="img/prev.png" onclick="window.location.href='main.html'"></td>
    </tr>
    </table>
    <?php
        $hostName = "localhost";
        $username = "root";
        $password = "";
        $databaseName = "awitek_hotel_app";
        $conn = new PDO("mysql:host=$hostName;dbname=$databaseName", $username, $password);
        $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

        try {
                $query = "SELECT * FROM pokoj ORDER BY nr_pokoju ASC";
                $prepared = $conn->prepare($query);
                $prepared->execute();
                $result = $prepared -> fetchAll(PDO::FETCH_ASSOC);
                ?>
                <table id = "all">
                <tr>
                <center><td><b> Edytuj</td><center>
                <center><td><b> Numer pokoju </td><center>
                <center><td><b> Numer rezerwacji </td><center>
                <center><td><b> Posprzątany </td><center>
                <center><td><b> Wolny </td><center>
                <center><td><b> Włączony do użytku </td><center>
                <center><td><b> Przyjazd </td><center>
                <center><td><b> Wyjazd </td><center>
                </tr>
                <?php
                foreach($result as $data) {
                ?>
                <tr>
                <center><td><button class = "select" id =<?php echo $data['nr_pokoju']; ?>> Edytuj </button></td><center>
                <center><td><?php echo $data['nr_pokoju']; ?> </td><center>
                <center><td><?php echo $data['rezerwacja_id']; ?> </td><center>
                <center><td><?php if ($data['posprzatany'] == 0){echo 'Nie';} else {echo 'Tak';} ?>  </td><center>
                <center><td><?php if ($data['wolny'] == 0){echo 'Nie';} else {echo 'Tak';} ?> </td><center>
                <center><td><?php if ($data['w_uzytku'] == 0){echo 'Nie';} else {echo 'Tak';} ?> </td><center>
                <center><td><?php echo $data['przyjazd']; ?> </td><center>
                <center><td><?php echo $data['wyjazd']; ?> </td><center>
                </tr>
                <?php
                }
                ?>
                </table>
                <?php
                } catch(PDOException $e) {
                echo "Error: " . $e->getMessage();
            }
    ?> 
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script> 
    <script>
        $(".select").click(function() {
            var Id=$(this).attr('id');
            window.close();
            window.open('roomdetails.php?Id='+Id);
            location.close();
        });
    </script>
    
</body>
</html>