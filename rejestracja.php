<?php
	session_start();
	
	require_once "connect.php";

	$error = false;
	$message = "";
	if(!empty($_POST['login']) && !empty($_POST['email']) && !empty($_POST['haslo1']) && !empty($_POST['haslo2'])) {
		if($_POST['haslo1'] != $_POST['haslo2']){
			$zgodne_hasla = false;
			$error = true;
		}
		if(!isset($_POST['regulamin'])){
			$akceptacja_regulaminu = false;
			$error = true;
		}

		if(!$error){

			$polaczenie = @new mysqli($host, $db_user, $db_password, $db_name);

			if ($polaczenie->connect_errno!=0)
			{
				$message = "Rejestracja nie powiodła się. Nie można było nawiązać połączenia z bazą danych.";
			}
			else
			{	
				$_POST['login'] = htmlentities($_POST['login'], ENT_QUOTES, "UTF-8");
				$_POST['login'] = mysqli_real_escape_string($polaczenie,$_POST['login']);
	
				if ($rezultat = @$polaczenie->query("SELECT id FROM projekt_uzytkownicy WHERE login='".$_POST['login']."';")) {
					$ilu_userow = $rezultat->num_rows;
					if($ilu_userow == 0) {
						$zapytanie = "INSERT INTO `projekt_uzytkownicy` (`id`, `login`, `email`, `haslo`, `imie`, `nazwisko`, `data_urodzenia`, `adres`, `kodpocztowy`, `miejscowosc`, `telefon`, `www`, `typ_konta`, `ilosc_postow`, `blokada`) VALUES (NULL, '".$_POST['login']."', '".$_POST['email']."', '".password_hash($_POST['haslo1'], PASSWORD_DEFAULT)."', '', '', '', '', '', '', '', '', '1', '0', '0');";
				
						if (@$polaczenie->query($zapytanie)) 
							$zapisano_dane = true;
						else
							$message = "Nie udało się zapisać danych w bazie";
					}
					else
						$message = "Podany login jest już zajęty.";
				}
				else
					$message = "Błąd zapytania do bazy.";
					
				$polaczenie->close();
			}
		}
	}
	else
		$niekompletne_dane = true;
?>

<!DOCTYPE HTML>
<html lang="pl">
<head>
	<meta charset="utf-8" />
	<meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1" />
	
	<link rel="shortcut icon" href="img/used/logo-Phoenix-Web.png">
	<title>Phoenix Web - Strony internetowe tworzone z pasją!</title>
	
	<meta name="description" content="Tworzymy wyjątkowe strony internetowe robiąć to z pasją i zaangażowaniem. Zajmujemy się również pozycjonowaniem, starając się, aby strony naszych klientów były zawsze pierwsze w rankingach!"/>
	<meta name="keywords" content="projektowanie, tworzenie, stron, internetowych, pozycjonowanie, SEO" />
	<meta name="author" content="Marcin Białecki">
	
	<link rel="stylesheet" href="css/main.css" type="text/css" />
	<link rel="stylesheet" href="css/rejestracj.css" type="text/css" />
	
	<link rel="stylesheet" href="fontello/css/fontello.css">
	<link href="https://fonts.googleapis.com/css?family=EB+Garamond:400,700&display=swap" rel="stylesheet"> 
</head>
<body>
	
	<header>
		<div id="headerText">
			<h1>Rejestracja</h1>
		</div>
		
		<a id="logoLink" href="aktualnosci">
			<div id="logo">
				<img id="logoImg" src="img/used/logo-Phoenix-Web.png" alt="logo phoenix">
				<div id="logoText">Phoenix Web</div>
				<div id="logoText">Forum</div>
			</div>
		</a>
		
		<nav id="topnav">
			<div id="menu">
				<a href="aktualnosci"><div>Aktualności</div></a><a href="najnowsze-posty"><div>Najnowsze posty</div></a><a href="kategorie"><div>Kategorie</div></a><a href="regulamin"><div>Regulamin</div></a><a href="dodaj-post"><div style="color: #45d142;">Dodaj post</div></a>
			</div>
			<div></div>
			<?php 
				if(isset($_SESSION['zalogowany']) && $_SESSION['zalogowany']) {
			?>
					<div id="login">
						<div>Konto: <strong><?=$_SESSION['login']?></strong></div>
						<div>Posty: <strong><?=$_SESSION['ilosc_postow']?></strong></div>
						<div>Typ konta: <strong>
							<?php
								switch($_SESSION['typ_konta']){
									case 0: echo "Gość"; break;
									case 1: echo "Użytkownik"; break;
									case 2: echo "Moderator"; break;
									case 3: echo "Administrator"; break;
								}
							?>
							</strong></div>
						<div id="link_ustawienia_konta"><a href="konto">Ustawienia konta</a></div>
						<div><a href="wyloguj">Wyloguj</a></div>
					</div>
			<?php 
				}
				else {
			?>
					<div id="login">
						<form action="zaloguj" method="post">
						Login: <input type="text" name="login"/>
						Hasło: <input type="password" name="haslo"/>
						<button type="submit">Zaloguj</button>
						<a href="rejestracja">&nbsp;&nbsp;&nbsp;Zarejestruj się</a>
						</form>
					</div>
			<?php 		
				}
				if(isset($_SESSION['message'])) {
			?>
					<div></div>
					<div id="login_error">
						<div><?=$_SESSION['message']?></div>
					</div>
			<?php
					unset($_SESSION['message']);
				}
					
			?>
		</nav>
		
		<div id="logo2Div">
			<a id="logo2Link" href="https://www.popko.pl" target="_blank">
				<div id="logo2">
					<img id="logo2Img" src="img/used/PBZ.png" alt="Znak PBZ">
					<div id="logo2Text">Wspieramy idee Edenu!</div>
				</div>
			</a>
		</div>
	</header>
	
	<div id="background">
		<main id="container">
			<div class="content">
				<?php 
					if(isset($zapisano_dane) && $zapisano_dane){
				?>
					<h2 style="color: green">
					Dziękujemy za rejestrację!<br/>
					Możesz się już zalogować na swoje nowe konto!
					</h2>
				<?php 
					}
					else{
				?>
					<h3>W celu rejestracji podaj potrzebne dane:</h3>
					<form action="" method="post">

					Login: <br/> <input type="text" name="login" value="<?php if (isset($_POST['login'])) echo $_POST['login'];?>"/><br/>
					
					E-mail: <br/> <input type="email" name="email" value="<?php if (isset($_POST['email'])) echo $_POST['email'];?>"/><br/>
					
					Hasło: <br/> <input type="password" name="haslo1" /><br/>
					
					Powtórz hasło: <br/> <input type="password" name="haslo2" /><br/>
				<?php if(isset($zgodne_hasla) && !$zgodne_hasla) echo "<span style='color: red'>Wpisane hasła nie były takie same.</span><br/>"?>
					<label>
						<input type="checkbox" name="regulamin" <?php if (isset($_POST['regulamin'])) echo "checked";?>>
						Akceptuje <a href="regulamin.html" target="_blank">regulamin</a>
					</label>
				<?php if(isset($akceptacja_regulaminu) && !$akceptacja_regulaminu) echo "<br/><span style='color: red'>Akceptacja regulaminu jest wymagana.</span>"?>
					<br/>
					<input type="submit" value="Zarejestruj się" />
					</form>
				<?php
						if(isset($_POST['login']) && isset($niekompletne_dane) && $niekompletne_dane) echo "<span style='color: red'>Nie wprowadzono wszystkich danych.</span><br/>";
					}
						if($message) {
							echo "<span style='color: red'>$message</span><br/>";
							$message = "";
						}
				?>
			</div>
		</main>
	
		<footer>
			<div class="socials">
				<div class="socialdivs">
					<a href="https://www.facebook.com" target="_blank">
						<div class="fb">
							<i class="icon-facebook"></i>
						</div>
					</a>
					<a href="https://www.youtube.com" target="_blank">
						<div class="yt">
							<i class="icon-youtube"></i>
						</div>
					</a>
					<a href="https://twitter.com" target="_blank">
						<div class="tw">
							<i class="icon-twitter"></i>
						</div>
					</a>
					<div style="clear:both;"></div>
				</div>
			</div>
			
			<div class="info">
				Wspieramy idee <a href="https://www.popko.pl" target="_blank">Edenu!</a>
				<br>
				2020 &copy; Wszelkie prawa zastrzeżone. Projekt i realizacja: Marcin Białecki
			</div>
		</footer>
	</div>
</body>
</html>