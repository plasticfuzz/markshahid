// JavaScript Document
			$(document).ready(function(){
				//Caption Sliding (Partially Hidden to Visible)
				$('.boxgrid.caption').hover(function(){
					$(".cover", this).stop().animate({top:'70px'},{queue:false,duration:460});
				}, function() {
					$(".cover", this).stop().animate({top:'230px'},{queue:false,duration:400}); /* -----make this 'top' the same as the 'top' value for .boxcaption on style.css */
				});
			});
