$(function() {

	var Q_button = 81;
	var A_button = 65;
	var T_button = 84;

	var widthForImg = $('.close-img').css('width'); // store property
	var heigthForImg = $('.close-img').css('heigth'); // store property

	/**
	* Keydown events
	*/

	$(document).keydown(function(event) {
		if ( event.which == Q_button ) {
			showWordNext();
		}
	})

	$(document).keydown(function(event) {
		if ( event.which == A_button ) {
			showWordPrevious();
		}
	})

	$(document).keydown(function(event) {
		if ( event.which == T_button ) {
			selectText();
		}
	})


	/**
	* Event with propertys css
	*/

	$('.close-img').mouseover(function() {
		$(this).css({
			width:  '+=2px',
			cursor: 'pointer'
		});
	})

	$('.close-img').mouseout(function() {
		$(this).css({
			width: widthForImg,
			heigth: heigthForImg,
			cursor: 'default'
		});
	})

	$('.close-img').click(function() {
		$('#number').toggleClass('active');
	})


	$('.showRules').click(function() {
		$('.rules').toggleClass('active');
	})
})



function showWordNext() {
	$('#word').load('index.php?next=next #word');
	$('#number').load('index.php #number');

	return false;
}

function showWordPrevious() {
	$('#word').load('index.php?previous=previous #word');
	$('#number').load('index.php #number');

	return false;
}

function selectText() {
	var text = document.getElementById('content');
	var selection = window.getSelection();
	var range = document.createRange();
	range.selectNodeContents(text);
	selection.removeAllRanges();
	selection.addRange(range);

	return false;
}

