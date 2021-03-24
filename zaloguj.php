<?php

	session_start();
	
	if ((!isset($_POST['login'])) || (!isset($_POST['haslo'])))
	{
		header('Location: aktualnosci');
		$_SESSION['message'] = "Oba pola muszą być wepełnione.";
		exit();
	}

	require_once "connect.php";

	$polaczenie = @new mysqli($host, $db_user, $db_password, $db_name);
	$polaczenie -> query ('SET NAMES utf8');
	
	if ($polaczenie->connect_errno!=0)
	{
		$_SESSION['message'] = "Nie można było nawiązać połączenia z bazą danych.";
	}
	else
	{
		$login = $_POST['login'];
		$haslo = $_POST['haslo'];
		
		$login = htmlentities($login, ENT_QUOTES, "UTF-8");
	
		if ($rezultat = @$polaczenie->query(
		sprintf("SELECT * FROM projekt_uzytkownicy WHERE login='%s'",
		mysqli_real_escape_string($polaczenie,$login))))
		{
			$ilu_userow = $rezultat->num_rows;
			if($ilu_userow > 0)
			{
				$wiersz = $rezultat->fetch_assoc();
				
				if (password_verify($_POST['haslo'], $wiersz['haslo']))
				{
					$_SESSION['zalogowany'] = true;
					$_SESSION['id_user'] = $wiersz['id'];
					$_SESSION['login'] = $wiersz['login'];
					$_SESSION['typ_konta'] = $wiersz['typ_konta'];
					$_SESSION['ilosc_postow'] = $wiersz['ilosc_postow'];
					$_SESSION['blokada'] = $wiersz['blokada'];
					
					unset($_SESSION['message']);
				}
				else 
				{
					$_SESSION['message'] = "Nieprawidłowe login lub hasło!";
				}
				
			} else {
				$_SESSION['message'] = "Nieprawidłowy login lub hasło!";
			}
			
			$rezultat->free_result();
		}
		
		$polaczenie->close();
		
	}
	header('Location: aktualnosci');
?>