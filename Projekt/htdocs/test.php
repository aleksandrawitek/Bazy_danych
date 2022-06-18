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
            #checkin {border-radius: 12px; background-color: #e6ffe6;}
            #edit {border-radius: 12px; background-color: grey;}
        </style>
        <title> Zameldowani </title>
    </head>
<body>
    <table>
     <tr>
        <td><img id="prev" src="img/prev.png" onclick="window.location.href='main.html'"></td>
        <td>
            <form method="post">
            <input type="date" id="date" name="date">
            <input id='submit' name="set" type="submit" value="Akceptuj">
            </form>
        </td>
    </tr>
    </table>
     <?php
        $date = $_POST['date'];
        echo "<h2> Wybrana data: ";
        echo $date;
        echo "</h2>";
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            $hostName = "localhost";
            $username = "root";
            $password = "";
            $databaseName = "awitek_hotel_app";
            $conn = new PDO("mysql:host=$hostName;dbname=$databaseName", $username, $password);
            $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

        try {
                $query = "SELECT * FROM rezerwacja WHERE przyjazd = '".$date."'";
                $prepared = $conn->prepare($query);
                $prepared->execute();
                $result = $prepared -> fetchAll(PDO::FETCH_ASSOC);
                ?>
                <table id = "all">
                <th>
                <center><td> Zamelduj lub Edytuj </td><center>
                <center><td> Nr rezerwacji </td><center>
                <center><td> Pesel </td><center>
                <center><td> Imię </td><center>
                <center><td> Nazwisko </td><center>
                <center><td> Przyjazd </td><center>
                <center><td> Wyjazd </td><center>
                <center><td> Numer pokoju </td><center>
                <center><td> Kwota/doba </td><center>
                <center><td> Komentarz </td><center>
                </th>
                <?php
                foreach($result as $data) {
                
                ?>
                <tr>
                <center><td><?php echo $sn; ?> </td><center>
                <center><td><button id = "checkin" onclick = "checkin()"> Zamelduj </button> <button id = "edit" onclick = "edit()"> Edytuj </button></td><center>
                <center><td><?php echo $data['id_rezerwacji']; ?> </td><center>
                <center><td><?php echo $data['pesel_id']; ?> </td><center>
                <center><td><?php echo $data['imie']; ?> </td><center>
                <center><td><?php echo $data['nazwisko']; ?> </td><center>
                <center><td><?php echo $data['przyjazd']; ?> </td><center>
                <center><td><?php echo $data['wyjazd']; ?> </td><center>
                <center><td><?php echo $data['numer_pokoju']; ?> </td><center>
                <center><td><?php echo $data['kwota/doba']; ?> </td><center>
                <center><td><?php echo $data['komentarz']; ?> </td><center>
                </tr>
                <?php
                }
                ?>
                </table>
                <?php
                } catch(PDOException $e) {
                echo "Error: " . $e->getMessage();
            }}
    ?>
    <?php
        $hostName = "localhost";
        $username = "root";
        $password = "";
        $databaseName = "awitek_hotel_app";
        $conn = new PDO("mysql:host=$hostName;dbname=$databaseName", $username, $password);
        $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

        try {
            $date = date("Y-m-d");
            echo "<h2> Dzisiejsza data: ";
            echo $date;
            echo "</h2>";
            $query = "SELECT * FROM rezerwacja WHERE przyjazd = '".$date."'";
            $prepared = $conn->prepare($query);
            $prepared->execute();
            $result = $prepared -> fetchAll(PDO::FETCH_ASSOC);
            ?>
            <table id = "all">
            <th>
            <center><td> Zamelduj lub Edytuj </td><center>
            <center><td> Nr rezerwacji </td><center>
            <center><td> Pesel </td><center>
            <center><td> Imię </td><center>
            <center><td> Nazwisko </td><center>
            <center><td> Przyjazd </td><center>
            <center><td> Wyjazd </td><center>
            <center><td> Numer pokoju </td><center>
            <center><td> Kwota/doba </td><center>
            <center><td> Komentarz </td><center>
            </th>
            <?php
            foreach($result as $data) {
            
            ?>
            <tr>
            <center><td><?php echo $sn; ?> </td><center>
            <center><td><button id = "checkin" onclick = "checkin()"> Zamelduj </button> <button id = "edit" onclick = "edit()"> Edytuj </button></td><center>
            <center><td><?php echo $data['id_rezerwacji']; ?> </td><center>
            <center><td><?php echo $data['pesel_id']; ?> </td><center>
            <center><td><?php echo $data['imie']; ?> </td><center>
            <center><td><?php echo $data['nazwisko']; ?> </td><center>
            <center><td><?php echo $data['przyjazd']; ?> </td><center>
            <center><td><?php echo $data['wyjazd']; ?> </td><center>
            <center><td><?php echo $data['numer_pokoju']; ?> </td><center>
            <center><td><?php echo $data['kwota/doba']; ?> </td><center>
            <center><td><?php echo $data['komentarz']; ?> </td><center>
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
    <script>

        // dzien dzisiejszy aby wyznaczycz przyjazdy z obecnego dnia

        var today = new Date();
        var year = today.getFullYear();
        var month = today.getMonth()+1; // styczen - 0, grudzien - 11 itp.
        var day = today.getDate();

        if(day<10)
        {
            day = '0'+ day;
        }
        if(month<10)
        {
            month = '0'+ month;
        }

        document.getElementById("date").defaultValue=year+ "-" + month + "-" + day;

    </script>
    
</body>
</html>