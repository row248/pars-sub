$(function() {
	$('*').keypress(function(event) {
		if ( event.which == 113 ) {
			window.location.reload()
		}

		return false;
	})

	$('*').keypress(function(event) {
		if ( event.which == 116 ) {
			selectText();
		}
	})
})

function selectText() {
	var text = document.getElementById('content');
	var selection = window.getSelection();
	var range = document.createRange();
	range.selectNodeContents(text);
	selection.removeAllRanges();
	selection.addRange(range);
}

function reload() {
	window.location.reload();
}
