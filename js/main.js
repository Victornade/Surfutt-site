jQuery(function($) {'use strict',
	
	//Countdown js
	 $("#countdown").countdown({
			date: "6 april 2016 13:00:00", //+1h pour le fuseau horaire
			format: "on"
		},
		
		function() {
			// callback function
			countdown_proc()
		});
	

	
	//Scroll Menu

	function menuToggle()
                    {
		var windowWidth = $(window).width();

		if(windowWidth > 767 ){
			$(window).on('scroll', function(){
				if( $(window).scrollTop()>405 ){
					$('.main-nav').addClass('fixed-menu animated slideInDown');
				} else {
					$('.main-nav').removeClass('fixed-menu animated slideInDown');
				}
			});
		}else{
			
			$('.main-nav').addClass('fixed-menu animated slideInDown');
				
		}
	}

	menuToggle();
	
	
	// Carousel Auto Slide Off
	$('#event-carousel, #twitter-feed, #sponsor-carousel ').carousel({
		interval: false
	});


/*
                    
                    // Contact form validation
	var form = $('.contact-form');
	form.submit(function () {'use strict',
		$this = $(this);
		$.post($(this).attr('action'), function(data) {
			$this.prev().text(data.message).fadeIn().delay(3000).fadeOut();
		},'json');
		return false;
	});
                    
      */
   jQuery(function($) {'use strict',                 
$('.contact-form').submit(function () {'use strict',
    $this = $(this);
    $.post("sendemail.php", $(".contact-form").serialize(),function(result){
        if(result.type == 'success'){
            $this.prev().text(result.message).fadeIn().delay(3000).fadeOut();
        }
    });
    return false;
});
});
                    /*
var form = $('#main-contact-form');
var data = $form.serialize()
form.submit(function(event){
    event.preventDefault();
    var form_status = $('<div class="form_status"></div>');
    $.ajax({
        type: "POST",
        dataType: "json",
        data: data,
        url: $(this).attr('action'),

        beforeSend: function(){
            form.prepend( form_status.html('<p><i class="fa fa-spinner fa-spin"></i> Email is sending...</p>').fadeIn() );
        }
    }).done(function(data){
        form_status.html('<p class="text-success">' + data.message + '</p>').delay(3000).fadeOut();
    });
});
                    
 */                   

	$( window ).resize(function() {
		menuToggle();
	});

	$('.main-nav ul').onePageNav({
		currentClass: 'active',
	    changeHash: false,
	    scrollSpeed: 900,
	    scrollOffset: 0,
	    scrollThreshold: 0.3,
	    filter: ':not(.no-scroll)'
	});

});


// Google Map Customization
(function(){

	var map;

	map = new GMaps({
		el: '#gmap',
		lat: 43.7924379,
		lng: -1.4040016,
		scrollwheel:false,
		zoom: 16,
		zoomControl : false,
		panControl : false,
		streetViewControl : false,
		mapTypeControl: false,
		overviewMapControl: false,
		clickable: false
	});
    
map.drawOverlay({
        lat: map.getCenter().lat()-0.0009,
        lng: map.getCenter().lng(),
        layer: 'overlayLayer',
        content: '<div class="overlay">Camping Municipal Les Sablères ***<div class="overlay_arrow above"></div></div>',
        verticalAlign: 'top',
        horizontalAlign: 'center'
      });
    
	var image = 'images/map-icon.png';
	map.addMarker({
		llat: 43.7924379,
		lng: -1.4040016,
		icon: image,
		animation: google.maps.Animation.DROP,
		verticalAlign: 'bottom',
		horizontalAlign: 'center',
		backgroundColor: '#3e8bff',
	});


	var styles = [ 

	{
		"featureType": "road",
		"stylers": [
		{ "color": "#b4b4b4" }
		]
	},{
		"featureType": "water",
		"stylers": [
		{ "color": "#d8d8d8" }
		]
	},{
		"featureType": "landscape",
		"stylers": [
		{ "color": "#f1f1f1" }
		]
	},{
		"elementType": "labels.text.fill",
		"stylers": [
		{ "color": "#000000" }
		]
	},{
		"featureType": "poi",
		"stylers": [
		{ "color": "#d9d9d9" }
		]
	},{
		"elementType": "labels.text",
		"stylers": [
		{ "saturation": 1 },
		{ "weight": 0.1 },
		{ "color": "#000000" }
		]
	}

	];

	map.addStyle({
		styledMapName:"Styled Map",
		styles: styles,
		mapTypeId: "map_style"  
	});

	map.setStyle("map_style");
}());



