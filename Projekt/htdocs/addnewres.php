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
            .tel {width: 8%;}
            .select {border-radius: 12px; background-color:#e6ffe6;}
        </style>
        <title> Nowa rezerwacja </title>
    </head>
<body>
<?php
        $hostName = "localhost";
        $username = "root";
        $password = "";
        $databaseName = "awitek_hotel_app";
        $conn = new PDO("mysql:host=$hostName;dbname=$databaseName", $username, $password);
        $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

        $Id=$_GET['Id'];


        try {
                $query = "SELECT * FROM gosc WHERE id_pesel = '".$Id."'";
                $prepared = $conn->prepare($query);
                $prepared->execute();
                $result = $prepared -> fetchAll(PDO::FETCH_ASSOC);
                ?>
                <?php
                foreach($result as $data) {
                ?>
                <table>
                <tr>
                <td><img id="prev" src="img/prev.png" onclick="window.location.href='his.php'"></td>
                </tr>
                </table>
                <center><p id='pesel' class = <?php echo $data['id_pesel'];?>>Pesel: <?php echo $data['id_pesel'];?></p><center>
                <center><p id='imie' class = <?php echo $data['imie']; ?>>Imię: <?php echo $data['imie']; ?></p><center>
                <center><p id='nazwisko' class = <?php echo $data['nazwisko'];?> >Nazwisko: <?php echo $data['nazwisko'];?></input></p><center>
                <center><p>Przyjazd: <input type = "date" id = "przyjazd"></input></p><center>
                <center><p>Wyjazd: <input type = "date" id = "wyjazd"></input></p><center>
                <center><p>Kwota/doba:<input id = "kwota/doba"></input></p><center>
                <center><p>Komentarz:<input id = "komentarz"></input></p><center>                
                <?php
                }
                ?>
                <?php
                $query = "SELECT nr_pokoju FROM pokoj WHERE w_uzytku=1 AND (przyjazd IS NULL AND wyjazd IS NULL)";
                $prepared = $conn->prepare($query);
                $prepared->execute();
                $result = $prepared -> fetchAll(PDO::FETCH_ASSOC);
                ?>
                <center><p>Numer pokoju:
                <select id='pokoj'>
                    <?php
                    foreach($result as $data) {
                    ?>

                        <option value=<?php echo $data['nr_pokoju'];?>><?php echo $data['nr_pokoju'];?></option>

                    <?php
                    }
                ?>
                </select>

                </p>
                <?php
                $query = "SELECT MAX(id_rezerwacji) AS maxval FROM rezerwacja";
                $prepared = $conn->prepare($query);
                $prepared->execute();
                $result = $prepared -> fetchAll(PDO::FETCH_ASSOC);
                ?>
                    <?php
                    $maxvalue = $data['maxval'] + 1;
                    foreach($result as $data) {
                    ?>
                    <?php
                    }
                ?>
                <button class = "select" id =<?php echo $maxvalue?>> Dodaj rezerwacje </button>

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
            var id=$(this).attr('id');
            var pesel=$("#pesel").attr('class');
            var imie=$("#imie").attr('class');
            var nazwisko=$("#nazwisko").attr('class');
            var przyjazd=document.getElementById("przyjazd").value;
            var wyjazd=document.getElementById("wyjazd").value;
            var kwota=document.getElementById("kwota/doba").value;
            var komentarz=document.getElementById("komentarz").value;
            var pokoj=document.getElementById("pokoj").value;

            
            $.ajax({
                url: 'addres.php?pesel='+pesel+"&imie="+imie+"&nazwisko="+nazwisko+"&przyjazd="+przyjazd+"&wyjazd="+wyjazd+"&kwota="+kwota+"&komentarz="+komentarz+"&pokoj="+pokoj+"&id="+id,
                method: 'POST',
                success: function () {
                    window.alert('Dodano nową rezerwację');
                    window.close();
                    location.reload();
                }

            });
        });
    });
    </script>
    
</body>
</html>