<?php
// KONTROLER strony kalkulatora
require_once dirname(__FILE__).'/../config.php';

// W kontrolerze niczego nie wysyła się do klienta.
// Wysłaniem odpowiedzi zajmie się odpowiedni widok.
// Parametry do widoku przekazujemy przez zmienne.

// 1. pobranie parametrów

$x = isset($_REQUEST['x']) ? $_REQUEST['x'] : '';
$y = isset($_REQUEST['y']) ? $_REQUEST['y'] : '';
$operation = isset($_REQUEST['op']) ? $_REQUEST['op'] : '';

// 2. walidacja parametrów z przygotowaniem zmiennych dla widoku

//domyślnie pokazuj wstęp strony (tytuł i tło)
$hide_intro = false;

// sprawdzenie, czy parametry zostały przekazane - jeśli nie to wyświetl widok bez obliczeń
if ( isset($_REQUEST['x']) && isset($_REQUEST['y']) && isset($_REQUEST['op']) ) {
	//nie pokazuj wstępu strony gdy tryb obliczeń (aby nie trzeba było przesuwać)
	$hide_intro = true;

	$infos [] = 'Przekazano parametry.';
		

	// sprawdzenie, czy potrzebne wartości zostały przekazane
	if ( $x == "") {
		$messages [] = 'Nie podano liczby 1';
	}
	if ( $y == "") {
		$messages [] = 'Nie podano liczby 2';
	}
	
	//nie ma sensu walidować dalej gdy brak parametrów
	if ( !isset ( $messages ) ) {
	
		// sprawdzenie, czy $x i $y są liczbami całkowitymi
		if (! is_numeric( $x )) {
			$messages [] = 'Pierwsza wartość nie jest liczbą';
		}
	
		if (! is_numeric( $y )) {
			$messages [] = 'Druga wartość nie jest liczbą';
		}
	
	}
	
	// 3. wykonaj zadanie jeśli wszystko w porządku
	
	if ( !isset ( $messages ) ) { // gdy brak błędów
		
		$infos [] = 'Parametry poprawne. Wykonuję obliczenia.';
		
		//konwersja parametrów na int
		$x = floatval($x);
		$y = floatval($y);
	
		//wykonanie operacji
		switch ($operation) {
		case 'minus' :
			$result = $x - $y;
			$operation_name = '-';
			break;
		case 'times' :
			$result = $x * $y;
			$operation_name = '*';
			break;
		case 'div' :
			$result = $x / $y;
			$operation_name = '/';
			break;
		default :
			$result = $x + $y;
			$operation_name = '+';
			break;
		}
	}
}

// 4. Wywołanie widoku, wcześniej ustalenie zawartości zmiennych elementów szablonu

$page_title = 'Przykład 03';
$page_description = 'Najprostsze szablonowanie oparte na budowaniu widoku poprzez dołączanie kolejnych części HTML zdefiniowanych w różnych plikach .php';
$page_header = 'Proste szablony';
$page_footer = 'przykładowa tresć stopki wpisana do szablonu z kontrolera';

include 'calc_view.php';