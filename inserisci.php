<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <!--CSS-->
  <link rel="stylesheet" href="style.css">

  <!-- Per le icone (menu hamburger e X nel responsive)-->
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css" />
  <title>Inserisci libro</title>
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

  <!-- Crea un form per l'inserimento di un libro  -->
  <!-- Nel form devi inserire il titolo del libro, l'autore, la copertina, il genere, la descrizione, il prezzo -->
  <!-- Con il bottone inserisci, aggiungi il libro nel database, che successivamente dovrà essere stampato nella home -->

  <div id="titlePrenotazione1">
    Inserisci libro
  </div>

  <div id="inserisci">
    <fieldset>
      <form action="" method="POST" enctype="multipart/form-data">
        <p>
          <label>Titolo del libro:</label>
          <input type="text" id="titolo" name="titolo" placeholder="Titolo" required />
        </p>

        <p>
          <label>Autore del libro:</label>
          <input type="text" id="autore" name="autore" placeholder="Autore" required />
        </p>

        <p>
          <label>Copertina del libro:</label>
          <input type="file" name="copertina" id="copertina" required />
        </p>

        <p>
          <label>Genere del libro:</label>
          <input type="text" id="genere" name="genere" placeholder="Genere" required />
        </p>

        <p>
          <label>Descrizione del libro:</label>
          <input type="text" id="descrizione" name="descrizione" placeholder="Descrizione" required />
        </p>

        <p>
          <label>Prezzo del libro:</label>
          <input type="text" id="prezzo" name="prezzo" placeholder="Prezzo" required />
        </p>

        <p>
          <label>Quantità disponibili:</label>
          <input type="number" name="quantita" id="quantita" required />
        </p>

        <p id="inserisciB">
          <input type="submit" id="inserisciBottone" name="Inserisci" value="Inserisci">
        </p>
      </form>
    </fieldset>

  </div>

  <?php

  if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $conn = new mysqli('localhost', 'root', '', 'my_danieleboggian3g');
    if ($conn->connect_error) {
      print("Connessione fallita.");
      exit;
    }

    $target_dir = "immagini/"; // Directory dove salvare l'immagine

    if (isset($_FILES['copertina']) && isset($_POST["Inserisci"])) {
      $file = $_FILES['copertina'];
      $fileName = basename($file['name']);
      $uploadFilePath = $target_dir . $fileName;

      if (file_exists($uploadFilePath)) {
        echo "Error: File already exists.";
      } else {
        if (move_uploaded_file($file['tmp_name'], $uploadFilePath)) {
          $baseUrl = "https://" . $_SERVER['HTTP_HOST'] . "/sitoCarrelloQuery" . "/";
          $urlImage = $baseUrl . $target_dir . $fileName;
          //var_dump($baseUrl);

          $titolo = $_POST['titolo'];
          $autore = $_POST['autore'];
          $genere = $_POST['genere'];
          $descrizione = $_POST['descrizione'];
          $prezzo = $_POST['prezzo'];
          $quantita = $_POST['quantita'];

          $query = "INSERT INTO LIBRI (Titolo, Autore, Immagine , Genere, Descrizione, Prezzo, Quantita, urlImage) 
                    VALUES ('$titolo', '$autore', '', '$genere', '$descrizione', '$prezzo', '$quantita', '$urlImage')";

          /*if ($conn->query($query) === true) {
            echo "File URL inserted into the database.";
          } else {
            echo "Error inserting file URL: " . $conn->error;
          }*/
        } /*else {
          echo "Error: Unable to upload the file.";
        }*/
      }
    } /*else {
      echo "No file uploaded.";
    }*/
  }
  ?>

  <!-- FOOTER -->

  <div class="footer">
    <!-- <p class="scrittaSocial">Social</p> -->
    <div class="social">
      <a href="#"><i class="fab fa-instagram"></i></a>
      <a href="#"><i class="fab fa-snapchat"></i></a>
      <a href="#"><i class="fab fa-twitter"></i></a>
      <a href="#"><i class="fab fa-facebook-f"></i></a>
    </div>
    <p class="copyright">Copyright by Boggian Daniele</p>
  </div>

</body>

</html>