// SITE js
var SITE = {
	isMobile : function(){	
		//var uagent = navigator.userAgent.toLowerCase();
		//if (uagent.search("iphone") > -1 || uagent.search("ipod") > -1){
		if( /Android|webOS|iPhone|iPod|BlackBerry/i.test(navigator.userAgent) ) {
			return true;
		}else{
			return false;
		}
	},
	//Tablet Condition
	isTablet : function(){	
		var uagent = navigator.userAgent.toLowerCase();
		//if (uagent.search("iphone") > -1 || uagent.search("ipod") > -1){
		if( /Android|iPad/i.test(navigator.userAgent) ) {
			return true;
		}else{
			return false;
		}
	},
	
	toTop:function(){
		jQuery('html, body').animate( { scrollTop: 0 }, 'slow' );
	},
	
	scrollToSection:function(){
		try{
			var hash = window.location.hash;
			if(hash && hash.length > 0){
				jQuery('html,body').animate({scrollTop:jQuery(hash).offset().top-0}, 'slow');
			}
			
			jQuery(".menu-item > .sub-menu > .menu-item > .sub-menu > li").on("click","a",function(event){		
				//event.preventDefault();
				var hash = this.hash; 
				jQuery('html,body').animate({scrollTop:jQuery(hash).offset().top-0}, 'slow');			
			});
			
			jQuery("a[href='#']").on("click",function(event){		
				event.preventDefault();
			});
		}catch(err) {
			//err.message;
			return false;
		}
		
	},
	
	initMobileMenu: function(){
		//	The menu on the left
		jQuery('#mobile_menu').mmenu({
			selectedClass  : "current_page_item"
		});
	},	
	 	
	//Show Form Error
	showErrorBox: function(error){
		var errorbox = '<div id="error-messages" class="error-popup mfp-hide"> <h2>Oops!</h2><ul id="error-list"></ul></div>';
		if(jQuery("#error-messages").size() == 0){
			jQuery(errorbox).appendTo("body");
		}
		jQuery("#error-list").empty().append(error);
		jQuery.magnificPopup.open({
		  items: {src: '#error-messages'},
		  type: 'inline'
		}, 0);
		return false;
	},
	
	toTitleCase: function(str) {
		 return str.replace(/\w\S*/g, function(txt){return txt.charAt(0).toUpperCase() + txt.substr(1).toLowerCase();});
	},	
	
	equalHeight: function(el){
		if(jQuery(el).size() > 0){
			var byRow = true;
			jQuery(el).matchHeight(byRow);
		}
	},
	
	//Accordian
	initAccordion: function(){
		var oAccordion = jQuery('.accordion_container');
		if(oAccordion.size() > 0){
			var menu_ul = jQuery('.accordion_container > li > div.accordion_content'), menu_a  = jQuery('.accordion_container > li > a'), default_open_slide =		jQuery('.accordion_container > li > div.default_open_slide');		
			menu_ul.hide();	
			default_open_slide.show();	
			menu_a.click(function(e) {
				e.preventDefault();
				if(!jQuery(this).hasClass('active')) {
					menu_a.removeClass('active');
					menu_ul.filter(':visible').slideUp('normal');
					jQuery(this).addClass('active').next().stop(true,true).slideDown('normal');
				} else {
					jQuery(this).removeClass('active');
					jQuery(this).next().stop(true,true).slideUp('normal');
				}
			});
		}
	},
	
	socialShare: function(o){
		var $a = jQuery(o);
		var social = $a.data('social');
		var params = $a.data("share-params");
		if(social == "facebook"){
			url = "https://www.facebook.com/sharer/sharer.php?"+params;
		}else if(social == "twitter"){
			url = "https://twitter.com/intent/tweet?"+params;
		}else if(social == "pinterest"){
			url = "https://pinterest.com/pin/create/button/?"+params;
		}else if(social == "gplus"){
			url = "https://plus.google.com/share?"+params;
		}
		
		window.open(url, 'social-share-dialog', 'width=626,height=436'); 
		return false;
	}, 

	initTabs: function(){
		jQuery(".tabs").on("click","a",function(event) {
            event.preventDefault();
            jQuery(this).parent().addClass("active");
            jQuery(this).parent().siblings().removeClass("active");
            var tab = jQuery(this).attr("href");
            jQuery(".tab-content").hide();
            jQuery(tab).show();
        });

        jQuery(".tabs a:eq(0)").click();
	},

	initSlider: function(slider,numSlides){
		var slideOptions = {}
		if(numSlides == 1){
			slideOptions = {
				controls  :  false,
				responsive:  true,
				auto: true,
				pause: 20000

			}
		}else if(numSlides == 3){
			slideOptions = {
				controls  :  false,
				responsive:  true,
				infiniteLoop: false,
				slideWidth: 380,
				minSlides: 1,
				maxSlides: 3,
				moveSlides: 1,
				slideMargin: 0,
				auto: true,
				pause: 15000
			}
		}else if(numSlides == 4){
			var slide_width = 300;
			if(SITE.isMobile()){
				slide_width = 340;
			}
			slideOptions = {
				pager  :  false,
				responsive:  true,
				infiniteLoop: false,
				nextSelector: '#team_next',
				prevSelector: '#team_prev',
				slideWidth: slide_width,
				minSlides: 1,
				maxSlides: 4,
				moveSlides: 1,
				slideMargin: 0,
				auto: true
			}
		}			
		jQuery(slider).bxSlider(slideOptions);	
	},

	stickyHeader: function(){
		if(jQuery(window).width() > 768){
			if(jQuery('body').scrollTop() >= 200){
				//sticky Header
				var iCurScrollPos = jQuery('body').scrollTop();
			    if (iCurScrollPos >= iScrollPos) {
			        //Scrolling Down
			        jQuery('#header').removeClass('sticky-header').css('opacity', '0');
			    } else {
			       //Scrolling Up
			       jQuery('#header').addClass('sticky-header').css('opacity', '1');
			    }
			    iScrollPos = iCurScrollPos;
			} else{
				jQuery('#header').removeClass('sticky-header').css('opacity', '1');
			}
		} else{
			jQuery('#header').removeClass('sticky-header').css('opacity', '1');
		}
	}
	
};


var SITEForms = {
	onlyInteger: function(){
        jQuery('.only-integer').keypress(function (event) {
            var charCode = (event.which) ? event.which : event.keyCode;
            if (charCode > 31 && (charCode < 48 || charCode > 57) && charCode != 37 && charCode != 39 && charCode != 46) {
                return false;
            }
            return true;
        });
    },
	onlyFloat: function(){
        jQuery('.only-float').keypress(function (event) {
            var charCode = (event.which) ? event.which : event.keyCode;
            if (charCode > 31 && (charCode < 48 || charCode > 59) && charCode != 37 && charCode != 39 && charCode != 46) {
                return false;
            } // prevent if not number/dot

            if (charCode == 46 && jQuery(this).val().indexOf('.') != -1) {
                return false;
            } // prevent if already dot
            return true;
        });
    },
	isValidEmail: function(v){
		var filter_email = /^([a-zA-Z0-9_\.\-])+\@(([a-zA-Z0-9\-])+\.)+([a-zA-Z0-9]{2,4})+$/;
		if (filter_email.test(v)==false){
			return false;
		}else{
			return true;
		}
	},
	
	isValidZip: function(v){
		var filter_zipcode =  /^(\d{5}-\d{4}|\d{5}|\d{9})$|^([a-zA-Z]\d[a-zA-Z]( )?\d[a-zA-Z]\d)$/;
		if (filter_zipcode.test(v)==false){
			return false;
		}else{
			return true;
		}
	},
	
	isValidPhone: function(v){
		var filter_phone = /^([0-9]( |-)?)?(\(?[0-9]{3}\)?|[0-9]{3})( |-)?([0-9]{3}( |-)?[0-9]{4}|[a-zA-Z0-9]{7})$/;
		if (filter_phone.test(v)==false){
			return false;
		}else{
			return true;
		}
	},
	
	getValue: function(fieldID){
		var value = jQuery.trim(jQuery("#"+fieldID).val());
		jQuery("#"+fieldID).val(value);
		return value;
	},
	
	isInt: function (n){
    	return Number(n) === n && n % 1 === 0;
	},
	
	isFloat: function(n){
    	return Number(n) === n && n % 1 !== 0;
	}
	
}      

//---------------------------------------------
jQuery(window).load(function() {	
	//equal div height on image load
	if(jQuery('.eq-parent .eq-child').size() > 0){
		jQuery('.eq-parent .eq-child').waitForImages( function() {
			SITE.equalHeight(".eq-parent .eq-child");
		});
	}
	
	if(typeof FastClick !== 'undefined') {      
      if (typeof document.body !== 'undefined') {
        FastClick.attach(document.body);
      }
    }

	SITE.initMobileMenu();
	
	if(jQuery("#single_slide_slider").size() > 0){
		SITE.initSlider('#single_slide_slider',1);
	}

	if (jQuery(".only-integer").size() > 0) {
        SITEForms.onlyInteger();
    }

    if (jQuery(".only-float").size() > 0) {
        SITEForms.onlyFloat();
    }
	SITE.scrollToSection();
	
	if(jQuery(".phone-mask").size() > 0){
		jQuery(".phone-mask").mask("(999) 999-9999");
	}

	//jQuery('#frm_calculator_construction_loan').parsley();
	
	jQuery('.popup-gallery').magnificPopup({
		delegate: 'a.gthumb',
		type: 'image',
		tLoading: 'Loading image #%curr%...',
		mainClass: 'mfp-img-mobile',
		gallery: {
			enabled: true,
			navigateByImgClick: true,
			preload: [0,1] // Will preload 0 - before current, and 1 after the current image
		},
		image: {
			tError: '<a href="%url%">The image #%curr%</a> could not be loaded.',
			titleSrc: function(item) {
				return item.el.attr('title');
			}
		}
	});
	
	jQuery('.popup-content-gallery').magnificPopup({
		delegate: 'a.popup-content',
		type: 'inline',
		tLoading: 'Loading content #%curr%...',
		mainClass: 'mfp-img-mobile',
		gallery: {
			enabled: true,
			navigateByImgClick: true,
			preload: [0,1] // Will preload 0 - before current, and 1 after the current image
		},
		callbacks: {
		    buildControls: function() {
		      // re-appends controls inside the main container
		      this.contentContainer.append(this.arrowLeft.add(this.arrowRight));
		    }
		}

		//prependTo: '#section_capitalvalues .popup-content-gallery'
	});
	
	jQuery('.popup-youtube').magnificPopup({         
		type: 'iframe',
		mainClass: 'mfp-fade',
		removalDelay: 160,
		preloader: false
	});
	
	jQuery('.popup-iframe').magnificPopup({         
	  type: 'iframe',
	  mainClass: 'mfp-fade',
	  removalDelay: 160,
	  preloader: false
	 });
 
	jQuery('.popup-inline').magnificPopup({
          type: 'inline',
          preloader: false
	});	
	
	jQuery('.popup-modal').magnificPopup({
		type: 'inline',
		preloader: false,
		modal: true
	});
	
	jQuery(document).on('click', '.popup-modal-dismiss', function (e) {
		e.preventDefault();
		jQuery.magnificPopup.close();
	});
	
	jQuery('.image-popup').magnificPopup({
		type: 'image',
		closeOnContentClick: true,
		closeBtnInside: true,
		mainClass: 'mfp-fade',
		image: {
			verticalFit: true
		}
	});
	
	if(jQuery("iframe").size() > 0 && jQuery(".iframe_video").size() > 0){
		fluidvids.init({
		  selector: ['.iframe_video'], // runs querySelectorAll()
		  players: ['www.youtube.com', 'player.vimeo.com'] // players to support
		});
	}

	if(jQuery('.select').size() > 0){
		jQuery('.select').niceSelect();
 	}
});

// Resize header div's height
jQuery( window ).on( 'debouncedresize', function() {
	jQuery.fn.matchHeight._update();
	jQuery.fn.matchHeight._maintainScroll = true;		
	var mobile_menu_api = jQuery("#mobile_menu").data( "mmenu" );
	mobile_menu_api.close();   
	SITE.stickyHeader();   
});

//sticky Header var
var iScrollPos = 0;
jQuery(window).scroll(function() {
	SITE.stickyHeader();
});
