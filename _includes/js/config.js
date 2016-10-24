window.onload = function() {
	// alert("Carregado");
};
$(function(){
	$('#formLogin label').hide();
	$('#formLogin input').focus(function() {
		$('#formLogin label[for="' + this.name + '"]').slideDown(300);
	}).blur(function() {
		$('#formLogin label[for="' + this.name + '"]').slideUp(300);
	});

	$(".jq_right").show( function () {
        $(".jq_right").animate({right : "3%"});
        //window.setTimeout(function () { $(".jq_some").animate({right: '-30%'}); }, 10000);
        $(".jq_right").click(function(){
            $(".jq_right").animate({right: '-30%'});
        });
    });

	$(".menu_login img").click(function(){		
		$(".painel_user").fadeToggle("slow");
		$(".painel_user").toggleClass("ds-block");
		$("body").toggleClass("lateral").css({"transition" : "all .4s", "overflow-x" : "hidden"});
	});

});