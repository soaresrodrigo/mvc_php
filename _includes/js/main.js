$(function(){

	$('#formLogin label').hide();
	$('#formLogin input').focus(function() {
		$('#formLogin label[for="' + this.name + '"]').slideDown(300);
	}).blur(function() {
		$('#formLogin label[for="' + this.name + '"]').slideUp(300);
	});

	$(".jq_some").fadeIn(1000, function () {
        window.setTimeout(function () { $(".jq_some").fadeOut(1000); }, 5000);
    });
});
