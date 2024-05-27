<?php
session_start();

if ($_SERVER['REQUEST_METHOD'] === "POST" && isset($_POST["compra"])) {
    if (!isset($_SESSION['carrello']))
      $_SESSION['carrello'] = array();
    $nome = $_POST['compra'];
    $quantita = $_POST['quantita'];
    $_SESSION['carrello'][$nome] = isset($_SESSION['carrello'][$nome]) ? $_SESSION['carrello'][$nome] += $quantita : $quantita;
    // $_SESSION['spesa']+= $_SESSION['carrello'][$nome]['prezzo'];
  }
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <!--CSS-->
    <link rel="stylesheet" href="style.css">

    <!-- Per le icone (menu hamburger e X nel responsive)-->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css" />
    <title>Document</title>
</head>

<body>
    <nav class="navbar">
        <div class="max">

            <div class="home"><img src="" alt=""><a href="libreria.php"> Libreria Ulisse</a></div>
            <ul class="menu">
                <li>
                    <a href="doveSiamo.html"> Dove siamo <br /> </a>
                </li>

                <li>
                    <a href="inserisci.php"> Inserisci libro <br /> </a>
                </li>

                <li>
                    <a href="ricerca.php"> Ricerca libro <br /> </a>
                </li>

                <li>
                    <a href="carrello.php"> Carrello <br /> </a>
                </li>
            </ul>
    </nav>
    <div id="titlePrenotazione1">
        PRODOTTI
    </div>

    <!-- Form per la ricerca di un libro dal titolo -->
    <div id="ricerca">
        <form action="" method="get">
            <input type="text" id="barraRicerca" name="ricerca" placeholder="Ricerca">
            <input type="submit" id="lente" name="submit" value="">
            <label for="submit"> <i id="lenteImm"></i></label>
        </form>
    </div>

    <?php
    $format = function ($num) {
        return number_format((float)$num, 2, '.', '');
    };
    $conn = new mysqli('localhost', 'root', '', 'my_danieleboggian3g');
    if ($conn->connect_error) {
        print("Connessione fallita.");
        exit;
    }
    if (!empty($_GET['ricerca'])) {
        $ricerca = strtolower(trim($_GET['ricerca']));

        $sql = "SELECT * 
            FROM LIBRI
            WHERE Titolo LIKE '%$ricerca%'";
        $result = $conn->query($sql);

        // var_dump($sql);

        if ($result->num_rows > 0) {
            while ($row = $result->fetch_assoc()) {

                $id = $row['id'];
                $titolo = $row['Titolo'];
                $autore = $row['Autore'];
                $immagine = $row['urlImage'];
                $genere = $row['Genere'];
                $descrizione = $row['Descrizione'];
                $prezzo = $row['Prezzo'];
                $quantita = $row['Quantita'];
                $stampa = <<<HTML
    <div class = "container">
        <div class="titolo">$titolo</div>
        <div class="autore">$autore</div>
        <div class="immagine"><img src="$immagine"/></div>
        <div class="genere">$genere</div>
        <div class="descrizione">$descrizione</div>
        <div class="prezzo"> <div class = "costo"> Prezzo: {$format($prezzo)}€ </div> <div class = "bottone">

        <form action="" method="post">
            <div id="formAggiungi">
              <div class="quantita"><input type="number" name="quantita" min="0" max="$quantita" value="0"></div>
              <label for="compra$id" id="aggiungiProdotto">Aggiungi</label>
              <input type="submit" id="compra$id" name="compra" value="$id" style="display:none;">
            </div>
        </form>
        
    </div> </div>
    </div>
    HTML;
                echo $stampa;
            }
        }
    }

    ?>
</body>

</html>