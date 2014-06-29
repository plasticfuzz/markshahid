// JavaScript Document

$(document).ready(function(){
	$('div.catcontent').hide().css({opacity:0});
	$('h4').
		addClass('clickable').
		click(function(){				
			toggleSection2($(this).next());
			$(this).blur();
			return false;
		}).
		keypress(function(e){
			if(e.which == 13){
				toggleSection2($(e.target).next());
				$(this).blur();
			}
		});
});

function toggleSection2(section2){
	if(section2.is(':visible')){
		section2.removeClass('open');
		section2.animate({opacity:0}, {duration:300, queue: false});
		section2.slideUp(500, 'easeInOutCubic');
	} else {
		$('div.open').animate({opacity:0}, {duration:300, queue: false});
		$('div.open').slideUp(500, 'easeInOutCubic');
		section2.addClass('open');
		section2.slideDown({duration:300, queue: false, easing:'easeInOutCubic'});
		section2.animate({opacity:1, duration:200, easing:'easeInOutCubic'});
	}	
}