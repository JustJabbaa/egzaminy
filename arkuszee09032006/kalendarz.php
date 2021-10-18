<!DOCTYPE html>
<html lang="pl">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="styl5.css" rel="stylesheet">
    <title>Mój kalendarz</title>
</head>
<body>
    <banner class="pierwszy">
        <img src="logo1.png" alt="Mój kalendarz">
    </banner>
    <banner class="drugi">
        <h1>KALENDARZ</h1>
        <?php
        $db = new mysqli('localhost', 'root', '', 'egzamin5');
        $query = $db->prepare("SELECT `zadania`.`miesiac`, `zadania`.`rok`, `zadania`.`dataZadania` FROM `zadania` WHERE `zadania`.`dataZadania` = '2020-07-01'");
        $query->execute();
        $result = $query->get_result();
        while($row = $result->fetch_assoc()) {
            echo '<h3>';
            $m = $row['miesiac'];
            $r = $row['rok'];
            echo 'miesiąc: ' . $m . ', rok: ' . $r;
            echo '</h3>';
        }
        ?>
    </banner>
    <main>
        <?php
            $query2 = $db->prepare("SELECT `zadania`.`dataZadania`, `zadania`.`wpis` FROM `zadania` WHERE `zadania`.`miesiac` = 'lipiec'");
            $query2->execute();
            $result2 = $query2->get_result();
            while($row2 = $result2->fetch_assoc()) {
                $data = $row2['dataZadania'];
                $wpis = $row2['wpis'];
                echo "<section>";
                echo "<h5>".$data."</h5>";
                echo "<p>".$wpis."</p>";
                echo "</section>";
                /*foreach($data as $value)
                {
                echo '<section>';
                echo '';
                echo '</section>';
                };*/
            };
        ?>
    </main>
    <footer>
        <?php
        if (isset($_REQUEST['wpis'])) {
            $wpis2 = $_REQUEST['wpis'];
            $qr = "UPDATE zadania SET wpis = '$wpis2' WHERE dataZadania = '2020-07-13'";
            $db->query($qr);
            header("location:kalendarz.php");
            $db->close();
        }
        ?>
        <form method="POST">
            dodaj wpis: <input type="text" name="wpis">
            <button type="submit">DODAJ</button>
        </form>
        <p>Strone wykonał: 0000000000000</p>
    </footer>
</body>
</html>