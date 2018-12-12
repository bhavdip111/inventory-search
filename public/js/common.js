$(document).ready(function() {
	$('.only-number').on('keyup', function() {
	    this.value = this.value.replace(/[^0-9]/gi, '');
	});
	$('.price-number').on('keyup', function() {
	    this.value = this.value.replace(/[^0-9.]/gi, '');
	});
	setTimeout(function(){ $('.alert').fadeOut('fast'); }, 3000);
});
