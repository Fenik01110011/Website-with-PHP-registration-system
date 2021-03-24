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
	<link rel="stylesheet" href="css/regulami.css" type="text/css" />
	
	<link rel="stylesheet" href="fontello/css/fontello.css">
	<link href="https://fonts.googleapis.com/css?family=EB+Garamond:400,700&display=swap" rel="stylesheet"> 
</head>
<body>
	
	<header>
		<img id="main_img" src="img/used/komputery.jpg" alt="internet siec media">
		<div id="headerText">
			<h1>Regulamin</h1>
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
				<a href="aktualnosci"><div>Aktualności</div></a><a href="najnowsze-posty"><div>Najnowsze posty</div></a><a href="kategorie"><div>Kategorie</div></a><a href="regulamin"><div style="background-color: #0b63a1;">Regulamin</div></a><a href="dodaj-post"><div style="color: #45d142;">Dodaj post</div></a>
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
				<p>1. Najważniejszym jest to aby sobie pomagać, a nie utrudniać życię, a wtedy będzie dobrze.</p>
				<p>2. Każdy może dodawać posty o ile robi to mądrze.</p>
				<p>3. Warto najpierw poszukać odpowiedzi na pytanie w internecie zanim je się zada, bardzo możliwe, że odnajdzie się już wtedy to co trzeba.</p>
				<p>4. W grupie siła, więc jak potrzebujesz pomocy to pisz! Następnym razem Ty może pomożesz komuś innemu :)</p>
				<p>5. Tworzymy niesamowite forum, dlatego warto o nie dbać.</p>
				<p>6. Nie używamy wulgaryzmów i nie wstawiamy niestosownych oraz obraźliwych treści.</p>
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