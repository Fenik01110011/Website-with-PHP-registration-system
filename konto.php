<?php
	session_start();
	
	if ((!isset($_SESSION['zalogowany'])) || !$_SESSION['zalogowany'])
	{
		header('Location: aktualnosci');
		exit();
	}
	
	require_once "connect.php";

	if (isset($_POST['id_user']) && (isset($_POST['login']) || isset($_POST['haslo'])))
	{
		$id_user = $_POST['id_user'];

		if(isset($_POST['login']))
		{
			$polaczenie = @new mysqli($host, $db_user, $db_password, $db_name);

			if ($polaczenie->connect_errno!=0)
			{
				$_SESSION['message2'] = "Zmiana danych powiodła się. Nie można było nawiązać połączenia z bazą.";
			}
			else
			{	
				if($_POST['login'] != $_SESSION['login']){
					$_POST['login'] = htmlentities($_POST['login'], ENT_QUOTES, "UTF-8");
					$_POST['login'] = mysqli_real_escape_string($polaczenie,$_POST['login']);
		
					if ($rezultat = @$polaczenie->query("SELECT id FROM projekt_uzytkownicy WHERE login='".$_POST['login']."';")) {
						$ilu_userow = $rezultat->num_rows;
						if($ilu_userow > 0) {
							$_POST['login'] = $_SESSION['login'];
							$_SESSION['message2'] = "Podany login jest już zajęty.";
						}
					}
					else{
						$_POST['login'] = $_SESSION['login'];
						$_SESSION['message2'] = "Błąd zapytania do bazy.";
					}
						
				}

				$login = $_POST['login'];
				$email = $_POST['email'];
				$imie = $_POST['imie'];
				$nazwisko = $_POST['nazwisko'];
				$data_urodzenia = $_POST['data_urodzenia'];
				$adres = $_POST['adres'];
				$kodpocztowy = $_POST['kodpocztowy'];
				$miejscowosc = $_POST['miejscowosc'];
				$telefon = $_POST['telefon'];
				$www = $_POST['www'];
			
				$zapytanie = "UPDATE `projekt_uzytkownicy` SET `login` = '$login', `email` = '$email', `imie` = '$imie', `nazwisko` = '$nazwisko', `data_urodzenia` = '$data_urodzenia', `adres` = '$adres', `kodpocztowy` = '$kodpocztowy', `miejscowosc` = '$miejscowosc', `telefon` = '$telefon', `www` = '$www'";
				$zapytanie .= " WHERE `projekt_uzytkownicy`.`id` = $id_user;";

				if (@$polaczenie->query($zapytanie)) {
					if(isset($_SESSION['message2']))
						$_SESSION['message2'] .= "</br>Dane zostały zmienione.";
					else
						$_SESSION['message2'] = "Dane zostały zmienione.";
				}
				else
					$_SESSION['message2'] = "Error. Dane nie zostały zmienione.";
					
				$polaczenie->close();
			}
		}
		else if(isset($_POST['haslo'])){
			$polaczenie = @new mysqli($host, $db_user, $db_password, $db_name);
			$polaczenie -> query ('SET NAMES utf8');
			
			if ($polaczenie->connect_errno!=0)
			{
				$_SESSION['message2'] = "Nie można było nawiązać połączenia z bazą danych.";
			}
			else
			{
				if ($rezultat = @$polaczenie->query("SELECT haslo FROM projekt_uzytkownicy WHERE id=".$_POST['id_user']))
				{
					$ilu_userow = $rezultat->num_rows;
					if($ilu_userow > 0)
					{
						$wiersz = $rezultat->fetch_assoc();
						
						if (password_verify($_POST['haslo'], $wiersz['haslo']))
						{
							
							if($_POST['nowe_haslo1'] == $_POST['nowe_haslo2']){
								if ((strlen($_POST['nowe_haslo1']) < 4) || (strlen($_POST['nowe_haslo1'])>24))
								{
									$_SESSION['message2']="Hasło musi posiadać od 4 do 24 znaków!";
								}
								else if ($polaczenie->connect_errno!=0)
								{
									$_SESSION['message2'] = "Error: ".$polaczenie->connect_errno;
								}
								else
								{
									$nowe_haslo = password_hash($_POST['nowe_haslo1'], PASSWORD_DEFAULT);
									$zapytanie = "UPDATE `projekt_uzytkownicy` SET `haslo` = '$nowe_haslo' WHERE `projekt_uzytkownicy`.`id` = $id_user;";
									
									if (@$polaczenie->query($zapytanie)) 
										$_SESSION['message2'] = "Hasło zostało zmienione.";
									else
										$_SESSION['message2'] = "Wystąpił błąd. Hasło nie zostało zmienione.";
								}
							}
							else {
								$_SESSION['message2'] = "Podane hasła nie są identyczne.";
							}
						}
						else {
							$_SESSION['message2'] = "Nieprawidłowy obecne hasło!";
						}
						
					} else {
						$_SESSION['message2'] = "Wystąpił błąd. Hasło nie zostało zmienione.";
					}
					$rezultat->free_result();
				}
				
				$polaczenie->close();
				
			}
		}
	}
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
	<link rel="stylesheet" href="css/kont.css" type="text/css" />
	
	<link rel="stylesheet" href="fontello/css/fontello.css">
	<link href="https://fonts.googleapis.com/css?family=EB+Garamond:400,700&display=swap" rel="stylesheet"> 
</head>
<body>
	
	<header>
		<div id="headerText">
			<h1>Ustawienia konta</h1>
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
					$polaczenie = @new mysqli($host, $db_user, $db_password, $db_name);
					$polaczenie -> query ('SET NAMES utf8');
					
					if ($polaczenie->connect_errno!=0)
					{
						$_SESSION['message2'] = "Error: ".$polaczenie->connect_errno;
					}
					else
					{	
						if ($rezultat = @$polaczenie->query("SELECT * FROM projekt_uzytkownicy WHERE id=".$_SESSION['id_user']))
						{
							$wiersz = $rezultat->fetch_assoc();

				?>
							<form action="" method="POST">
								<input type="hidden" name="id_user" value="<?php echo $wiersz['id'];?>">
								<table>
									<tr> 
										<td colspan="2"><b><font size="2"><h2>Zmiana danych konta</h2></font></b></td> 
									</tr>
									<tr>
										<td>Login:</td>
										<td><input type="text" name="login" value="<?php echo $wiersz['login']; ?>" required></td>
									</tr>
									<tr>
										<td>Email:</td>
										<td><input type="email" name="email" value="<?php echo $wiersz['email']; ?>" required></td>
									</tr>
									<tr>
										<td>Imię:</td>
										<td><input type="text" name="imie" value="<?php echo $wiersz['imie']; ?>"></td>
									</tr>
									<tr>
										<td>Nazwisko:</td>
										<td><input type="text" name="nazwisko" value="<?php echo $wiersz['nazwisko']; ?>"></td>
									</tr>
									<tr>
										<td>Data urodzenia:</td>
										<td><input type="text" name="data_urodzenia" value="<?php echo $wiersz['data_urodzenia']; ?>"></td>
									</tr>
									<tr>
										<td>Adres:</td>
										<td><input type="text" name="adres" value="<?php echo $wiersz['adres']; ?>"></td>
									</tr>
									<tr>
										<td>Kod pocztowy:</td>
										<td><input type="text" name="kodpocztowy" value="<?php echo $wiersz['kodpocztowy']; ?>"></td>
									</tr>
									<tr>
										<td>Miejscowość:</td>
										<td><input type="text" name="miejscowosc" value="<?php echo $wiersz['miejscowosc']; ?>"></td>
									</tr>
									<tr>
										<td>Telefon:</td>
										<td><input type="text" name="telefon" value="<?php echo $wiersz['telefon']; ?>"></td>
									</tr>
									<tr>
										<td>Strona internetowa:</td>
										<td><input type="text" name="www" value="<?php echo $wiersz['www']; ?>"></td>
									</tr>
									<tr>
										<td colspan="2"><input type="submit" value="Zapisz"></td>
									</tr>
								</table>
							</form>
				<?php
					if (isset($_SESSION['message2']))
					{		
						echo $_SESSION['message2'];
						unset($_SESSION['message2']);
					}
				?>
							<form action="" method="POST">
								<input type="hidden" name="id_user" value="<?php echo $wiersz['id'];?>">
								<table>
									<tr> 
										<td colspan="2"><b><font size="2"><h2>Zmiana hasła</h2></font></b></td> 
									</tr>
									<tr>
										<td>Obecne hasło:</td>
										<td><input type="password" name="haslo" required></td>
									</tr>
									<tr>
										<td>Nowe hasło:</td>
										<td><input type="password" name="nowe_haslo1" required></td>
									</tr>
									<tr>
										<td>Powtórz nowe hasło:</td>
										<td><input type="password" name="nowe_haslo2" required></td>
									</tr>
									<tr>
										<td colspan="2"><input type="submit" value="Zapisz"></td>
									</tr>
								</table>
							</form>
				<?php
							$rezultat->free_result();
						}
						else
							$_SESSION['message2'] = "Błąd zapytania do bazy.";

						$polaczenie->close();
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