// JavaScript Document
			$(document).ready(function(){
				//Caption Sliding (Partially Hidden to Visible)
				$('.boxgrid.caption').hover(function(){
					$(".cover", this).stop().animate({ opacity: 100}, {top:'70px'},{queue:false,duration:460});
				}, function() {
					$(".cover", this).stop().animate({ opacity: 10},{top:'172px'},{queue:false,duration:400}); /* -----make this 'top' the same as the 'top' value for .boxcaption on style.css */
				});
			});
