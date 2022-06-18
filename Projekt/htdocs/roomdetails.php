<!DOCTYPE html>
<html>
    <head>
        <style>
            body {background-image: url("img/background.png");}
            #delete {border-radius: 12px; background-color:#ffb3b3;}
            input {border-radius: 12px;}
            #prev {width: 10%; height: 10%;}
            #all {border-collapse: collapse;}
            #all tr {border:solid black;}
            #all td {width:10%;}
            #select {border-radius: 12px; background-color: grey;}
        </style>
        <title> Szczegóły </title>
    </head>
<body>
    <table>
     <tr>
        <td><img id="prev" src="img/prev.png" onclick="window.location.href='rooms.php'"></td>
    </tr>
    </table>
    <?php
        $hostName = "localhost";
        $username = "root";
        $password = "";
        $databaseName = "awitek_hotel_app";
        $conn = new PDO("mysql:host=$hostName;dbname=$databaseName", $username, $password);
        $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

        $Id=$_GET['Id'];

        try {
                $query = "SELECT * FROM pokoj WHERE nr_pokoju= '".$Id."'";
                $prepared = $conn->prepare($query);
                $prepared->execute();
                $result = $prepared -> fetchAll(PDO::FETCH_ASSOC);
                ?>
                <?php
                foreach($result as $data) {
                ?>
                <p><b>Numer pokoju: <?php echo $data['nr_pokoju']; ?></b>  </p>
                <p>Wolny: <?php if ($data['wolny'] == 0){echo 'Nie';}else{echo 'Tak';}?></p>
                <p> Numer rezerwacji: <?php if ($data['rezerwacja_id'] == NULL){echo '-';}else{echo $data['rezerwacja_id'];} ?></p>
                <p> Przyjazd: <?php if ($data['przyjazd'] == NULL){echo '-';}else{echo $data['przyjazd'];} ?></p>
                <p> Wyjazd: <?php if ($data['wyjazd'] == NULL){echo '-';}else{echo $data['wyjazd'];} ?> </p>

                Posprzątany:
                <select id="posprzatanylist">
                    <option value=<?php if ($data['posprzatany'] == 0){echo 'Nie';}else{echo 'Tak';}?>><?php if ($data['posprzatany'] == 0){echo 'Nie';}else{echo 'Tak';}?></option>
                    <option value=<?php if ($data['posprzatany'] != 0){echo 'Nie';}else{echo 'Tak';}?>><?php if ($data['posprzatany'] != 0){echo 'Nie';}else{echo 'Tak';}?></option>
                </select>
    
                W uzytku:
                <select id="wuzytkulist">
                    <option value=<?php if ($data['w_uzytku'] == 0){echo 'Nie';}else{echo 'Tak';}?>><?php if ($data['w_uzytku'] == 0){echo 'Nie';}else{echo 'Tak';}?></option>
                    <option value=<?php if ($data['w_uzytku'] != 0){echo 'Nie';}else{echo 'Tak';}?>><?php if ($data['w_uzytku'] != 0){echo 'Nie';}else{echo 'Tak';}?></option>
                </select>
                <button class = "select" id =<?php echo $data['nr_pokoju']; ?>> Aktualizuj </button>
                <?php
                }
                ?>
                <?php
                } catch(PDOException $e) {
                echo "Error: " . $e->getMessage();
            }
    ?>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>  
    <script>
        $(document).ready(function(){
            $(".select").click(function(e) {
            e.preventDefault();
            var Id=$(this).attr('id');
            var w_uzytku=$("#wuzytkulist option:selected").text();
            var posprzatany=$("#posprzatanylist option:selected").text();

            if (w_uzytku == 'Tak')
            {
                w_uzytku = 1;
            }
            else
            {
                w_uzytku = 0;
            }
            if (posprzatany == 'Tak')
            {
                posprzatany = 1;
            }
            else
            {
                posprzatany = 0;
            }
            $.ajax({
                url: 'updateroom.php?Id='+Id+"&w_uzytku="+w_uzytku+"&posprzatany="+posprzatany,
                method: 'POST',
                success: function () {
                    window.alert('Poprawnie zaktualizowano');
                    location.reload();
                }

            });
        });
    });
    </script>
    
</body>
</html>