<?php
	session_start();
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
	<link rel="stylesheet" href="css/index.css" type="text/css" />
	
	<link rel="stylesheet" href="fontello/css/fontello.css">
	<link href="https://fonts.googleapis.com/css?family=EB+Garamond:400,700&display=swap" rel="stylesheet"> 
</head>
<body>
	
	<header>
		<img id="main_img" src="img/used/internet-siec-alpha.png" alt="internet siec media">
		<div id="headerText">
			<h1>Aktualności</h1>
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
				<a href="aktualnosci"><div style="background-color: #0b63a1;">Aktualności</div></a><a href="najnowsze-posty"><div>Najnowsze posty</div></a><a href="kategorie"><div>Kategorie</div></a><a href="regulamin"><div>Regulamin</div></a><a href="dodaj-post"><div style="color: #45d142;">Dodaj post</div></a>
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
				<img src="img/used/competence.jpg" alt="kompetencje">
				<div class="contentText">
					<h1>Lorem ipsum dolor sit amet</h1>
					<p>
					Lorem ipsum dolor sit amet, consectetur adipiscing elit. Suspendisse at aliquet lorem. Nullam et nunc purus. Quisque eget mauris mattis, ornare metus rhoncus, tempus mi. Donec gravida a tellus non luctus. Cras cursus metus nec nunc dictum aliquet. Duis a lorem nec diam tincidunt consectetur. Eget mauris mattis, ornare metus rhoncus, tempus mi. Donec gravida a tellus non luctus. Mauris mattis, ornare metus rhoncus, tempus mi. Donec gravida a tellus non luctus.
					</p>
				</div>
				<div style="clear: both;"></div>
			</div>
			<div class="content">
				<img src="img/used/bezpieczenstwo.jpg" alt="bezpieczenstwo">
				<div class="contentText">
					<h1>Lorem ipsum dolor sit amet</h1>
					<p>
					Lorem ipsum dolor sit amet, consectetur adipiscing elit. Suspendisse at aliquet lorem. Nullam et nunc purus. Quisque eget mauris mattis, ornare metus rhoncus, tempus mi. Donec gravida a tellus non luctus. Cras cursus metus nec nunc dictum aliquet.
					</p>
					<p>
					Duis nec eleifend risus. Etiam et tellus eu eros consectetur tempor. Morbi quis consequat risus, ut sollicitudin neque. Fusce risus urna, consectetur nec odio ac, aliquam elementum odio. Sed mauris lacus, imperdiet eu metus ac, tristique finibus ipsum.
					<p>
				</div>
				<div style="clear: both;"></div>
			</div>
			<div class="content">
				<img src="img/used/money.jpg" alt="zyski">
				<div class="contentText">
					<h1>Lorem ipsum dolor sit amet</h1>
					<p>
					Lorem ipsum dolor sit amet, consectetur adipiscing elit. Suspendisse at aliquet lorem. Nullam et nunc purus. Quisque eget mauris mattis, ornare metus rhoncus, tempus mi. Donec gravida a tellus non luctus. Cras cursus metus nec nunc dictum aliquet.
					</p>
					<p>
					Duis nec eleifend risus. Etiam et tellus eu eros consectetur tempor. Morbi quis consequat risus, ut sollicitudin neque. Fusce risus urna, consectetur nec odio ac, aliquam elementum odio. Sed mauris lacus, imperdiet eu metus ac, tristique finibus ipsum. Mauris semper quis nulla vel posuere. Nulla facilisi.
					<p>
				</div>
				<div style="clear: both;"></div>
			</div><div class="content">
				<img src="img/used/good-choice.jpg" alt="dobry wybór">
				<div class="contentText">
					<h1>Lorem ipsum dolor sit amet</h1>
					<p>
					Lorem ipsum dolor sit amet, consectetur adipiscing elit. Suspendisse at aliquet lorem. Nullam et nunc purus. Quisque eget mauris mattis, ornare metus rhoncus, tempus mi. Donec gravida a tellus non luctus. Cras cursus metus nec nunc dictum aliquet. Duis a lorem nec diam tincidunt consectetur.
					</p>
					<p>
					Duis nec eleifend risus. Etiam et tellus eu eros consectetur tempor. Morbi quis consequat risus, ut sollicitudin neque. Fusce risus urna, consectetur nec odio ac, aliquam elementum odio. Sed mauris lacus, imperdiet eu metus ac, tristique finibus ipsum. Mauris semper quis nulla vel posuere. Nulla facilisi. Proin et sapien sed diam commodo euismod eu vitae mi.
					<p>
					<p>
					Nec eleifend risus. Etiam et tellus eu eros consectetur tempor. Morbi quis consequat risus, ut sollicitudin neque. Fusce risus urna, consectetur nec odio ac, aliquam elementum odio. Sed mauris lacus, imperdiet eu metus ac, tristique finibus ipsum.
					<p>
				</div>
				<div style="clear: both;"></div>
			</div>
			<div class="content">
				<img src="img/used/czas.jpg" alt="czas">
				<div class="contentText">
					<h1>Lorem ipsum dolor sit amet</h1>
					<p>
					Lorem ipsum dolor sit amet, consectetur adipiscing elit. Suspendisse at aliquet lorem. Nullam et nunc purus. Quisque eget mauris mattis, ornare metus rhoncus, tempus mi. Donec gravida a tellus non luctus. Cras cursus metus nec nunc dictum aliquet. Duis a lorem nec diam tincidunt consectetur.
					</p>
					<p>
					Duis nec eleifend risus. Etiam et tellus eu eros consectetur tempor. Morbi quis consequat risus, ut sollicitudin neque. Fusce risus urna, consectetur nec odio ac, aliquam elementum odio. Sed mauris lacus, imperdiet eu metus ac, tristique finibus ipsum.
					<p>
				</div>
				<div style="clear: both;"></div>
			</div>
			<div class="content">
				<img src="img/used/cooperation.jpg" alt="współpraca">
				<div class="contentText">
					<h1>Lorem ipsum dolor sit amet</h1>
					<p>
					Lorem ipsum dolor sit amet, consectetur adipiscing elit. Suspendisse at aliquet lorem. Nullam et nunc purus. Quisque eget mauris mattis. Donec gravida a tellus non luctus. Cras cursus metus nec nunc dictum aliquet. Duis a lorem nec diam tincidunt consectetur.
					</p>
					<p>
					Duis nec eleifend risus. Etiam et tellus eu eros consectetur tempor. Morbi quis consequat risus, ut sollicitudin neque. Mauris semper quis nulla vel posuere. Nulla facilisi. Proin et sapien sed diam commodo euismod eu vitae mi.
					<p>
				</div>
				<div style="clear: both;"></div>
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
	
	<script src="https://skrypt-cookies.pl/id/4afa57651d4091df.js"></script>
</body>
</html>