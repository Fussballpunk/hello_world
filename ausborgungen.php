<?php
    include("includes/config.inc.php");
    include("includes/common.inc.php");
    include("includes/db.inc.php");

    $conn = dbConnect();

    if !(count($_GET)>0) {
        echo('Fehler');
    }
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Ausborgungen</title>
    
</head>
<body>
    <nav>
        <a href="user.php">Zurück</a>
    </nav>
    <h1>Ausborgungen</h1>
    <ul>
        <?php
        $_sql = "
            SELECT 
                Nachname, 
                Vorname
            FROM tbl_user
            LEFT JOIN tbl_personen ON FIDPerson = ID Person
            WHERE

        ";

        $sql= "
            SELECT 
                FIDUser,
                Beginn,
                Ende,
                Titel,
                Nachname,
                Vorname
            FROM tbl_ausborgeliste
            RIGHT JOIN tbl_user ON FID_User = IDUser
            LEFT JOIN tbl_personen ON FIDPeron = IDPerson
            LEFT JOIN tbl_buecher ON FIDBuch = IDBUCH
            WHERE FIDUser = '".$_GET["user"]."'
        ";
        $ausborgung = dbQuery ($conn, $sql);
        $name = $ausborgung -> fetch_object();
        echo('
            <h2>'.$name->Nachname.','.name->Vorname.'</h2>
                <h3>Aktuelle Ausborgungen</h3>
        ');
        while ($a = $ausborgung-> fetch_object()){
            echo('                
                <li>');         
            if (is_null($a->Ende)){
                echo(
                    $a->Titel.'<br>
                    Enleihbeginn: '.$a->Beginn
                );
            }
            
            echo('</li>');
        }
        echo('<h3>Historische Ausborgungen</h3>');
        while ($a = $ausborgung-> fetch_object()){
            echo('                
                <li>');    
            if !(is_null($a->Ende)){
                echo(
                    $a->Titel.'<br>
                    Enleihbeginn: '.$a->Beginn.'
                    Entleihende: '.$a->Ende
                );
            }
        ?>
    </ul>
</body>
</html>