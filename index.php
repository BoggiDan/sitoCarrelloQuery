<!-- Utente: Daniele
password: 1234 -->

<?php
session_start();
// var_dump($_SESSION);
if (isset($_SESSION["active_login"])) {header("Location: loginEffettuato.php"); exit();} // sessione già convalidata
if (isset($_POST["submit"])) { //premuto invio
    $user = $_POST["username"];
    $psw = $_POST["password"];
    if ($user == "Daniele" && $psw == "1234") { //coincidono user e pwd
        $_SESSION["active_login"] = $user; // memorizzo e attivo la sessione utente
        header("Location: libreria.php"); //invio alla pagina di elaborazione
        exit();
    } else $error = "Username o password errati!";
}
?>

<?php
// $_SESSION['utente'] = "";
$cookie_name = "utente";
$cookie_value = "Daniele";
setcookie($cookie_name, $cookie_value, time() + (86400 * 30), "/"); // scrive cookie, dando un mese come tempo di vita
?>
<?php
if (!isset($_COOKIE[$cookie_name])) {
    // echo "Cookie named '" . $cookie_name . "' is not set!";
} else {

    // echo "Cookie '" . $cookie_name . "' is set!<br>";
    // echo "Value is: " . $_COOKIE[$cookie_name]; //legge il cookie
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
    <title>Login</title>
</head>

<body>

    <!-- <nav class="navbar">
        <div class="max">

            <div class="home"><img src="" alt=""><a href="index.php"> Libreria </a></div>
            <ul class="menu">
                <li>
                    <a href="doveSiamo.html"> Dove siamo <br /> </a>
                </li>

                <li>
                    <a href="index.php"> Carrello <br /> </a>
                </li>
            </ul>
    </nav> -->

    <div id="immSfondoLogin">
        <div id="login">
            <p class="titlePrenotazioneLogin">
                LOGIN
            </p>
            <?= isset($error) ? "<p style=\"color: #F00;\">" . $error . "</p>" : "" ?>
            <form action="" method="POST" id="accesso">
                <fieldset id="fieldsetLogin">
                    <!-- <legend>Login</legend> -->
                    <p id="campiLogin">Username: <input type="text" name="username" value="<?= $_COOKIE['utente'] ?>"> </p>
                    <p id="campiLogin">Password: <input type="password" name="password"></p>
                    <input type="submit" class="button" name="submit" value="Accedi" id="bottoneAccedi">
                </fieldset>
            </form>
        </div>
    </div>


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