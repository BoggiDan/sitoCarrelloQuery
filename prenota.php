<?php
session_start();
include_once("dati.php");
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
    <title>Fattura</title>
</head>

<body>
<?php
      $n = $_POST['fname'];
      $c = $_POST['lname'];
      $to = $_POST['email'];
      $from = "libreriaulisse@gmail.com";
      $telefono = $_POST['telefono'];

      $_SESSION['fname']=$n;
      $_SESSION['lname']=$c;
      $_SESSION['email']=$to;
      $_SESSION['from']=$from;
      $_SESSION['telefono']=$telefono;
      $subject = "Prenotazione Libreria Ulisse";
      $message = <<<HTML
        Salve, la sua prenotazione sul sito Libreria Ulisse è stata confermata con successo.
        Di seguito i suoi dati inseriti al momento della prenotazione: 
        Nome: $n
        Cognome: $c
        Telefono: $telefono 
      HTML;
    
      if (mail($to, $subject, $message)) {
        echo <<<JS
        <script>
            setTimeout(() => {
              window.location = "fattura.php";
            }, 1000);
            alert("Prenotazione effettuata con successo");
        </script>
        JS;
      } else {
        echo "Errore. Nessuna prenotazione inviata.";
      }
    ?>

</body>

</html>