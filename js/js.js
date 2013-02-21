$(function() {
	$(document).keydown(function(event) {
		if ( event.which == 81 ) {
			showWord();
		}
	})

	$(document).keydown(function(event) {
		if ( event.which == 84 ) {
			selectText();
		}
	})
})

function showWord() {
	$('#word').load('index.php #word', function() {
		if ( status == 'error') {
			alert('ajax error');
		} 
	});

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

function reload() {
	window.location.reload();
}
