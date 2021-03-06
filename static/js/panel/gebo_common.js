function is_touch_device() {
  return !!('ontouchstart' in window);
}
$(document).ready(function() {
	$('#side_accordion').on('hidden shown', function () {
		gebo_sidebar.make_active();
		gebo_sidebar.update_scroll();
	});
	//* resize elements on window resize
	var lastWindowHeight = $(window).height();
	var lastWindowWidth = $(window).width();
	$(window).on("debouncedresize",function() {
		if($(window).height()!=lastWindowHeight || $(window).width()!=lastWindowWidth){
			lastWindowHeight = $(window).height();
			lastWindowWidth = $(window).width();
			gebo_sidebar.update_scroll();
			if(!is_touch_device()){
				$('.sidebar_switch').qtip('hide');
			}
		}
	});
	//* tooltips
	gebo_tips.init();
	if(!is_touch_device()){
		//* popovers
		gebo_popOver.init();
	}
	//* sidebar
	gebo_sidebar.init();
	gebo_sidebar.make_active();
	
	//* pre block prettify
	if(typeof prettyPrint == 'function') {
		prettyPrint();
	}
	//* accordion icons
	gebo_acc_icons.init();
	//* colorbox single
	gebo_colorbox_single.init();
	//* main menu mouseover
	gebo_nav_mouseover.init();
	//* top submenu
	gebo_submenu.init();
	
	gebo_sidebar.make_scroll();
	gebo_sidebar.update_scroll();
});

gebo_sidebar = {
	init: function() {
		// sidebar onload state
		if($(window).width() > 979){
			if(!$('body').hasClass('sidebar_hidden')) {
				if( $.cookie('gebo_sidebar') == "hidden") {
					$('body').addClass('sidebar_hidden');
					$('.sidebar_switch').toggleClass('on_switch off_switch').attr('title','Show Sidebar');
				}
			} else {
				$('.sidebar_switch').toggleClass('on_switch off_switch').attr('title','Show Sidebar');
			}
		} else {
			$('body').addClass('sidebar_hidden');
			$('.sidebar_switch').removeClass('on_switch').addClass('off_switch');
		}

		gebo_sidebar.info_box();
		//* sidebar visibility switch
		$('.sidebar_switch').click(function(){
			$('.sidebar_switch').removeClass('on_switch off_switch');
			if( $('body').hasClass('sidebar_hidden') ) {
				$.cookie('gebo_sidebar', null);
				$('body').removeClass('sidebar_hidden');
				$('.sidebar_switch').addClass('on_switch').show();
				$('.sidebar_switch').attr( 'title', "Hide Sidebar" );
			} else {
				$.cookie('gebo_sidebar', 'hidden');
				$('body').addClass('sidebar_hidden');
				$('.sidebar_switch').addClass('off_switch');
				$('.sidebar_switch').attr( 'title', "Show Sidebar" );
			}
			gebo_sidebar.info_box();
			gebo_sidebar.update_scroll();
			$(window).resize();
		});
		//* prevent accordion link click
		$('.sidebar .accordion-toggle').click(function(e){e.preventDefault()});
	},
	info_box: function(){
		var s_box = $('.sidebar_info');
		var s_box_height = s_box.actual('height');
		s_box.css({
			'height'        : s_box_height
		});
		$('.push').height(s_box_height);
		$('.sidebar_inner').css({
			'margin-bottom' : '-'+s_box_height+'px',
			'min-height'    : '100%'
		});
	},
	make_active: function() {
		var thisAccordion = $('#side_accordion');
		thisAccordion.find('.accordion-heading').removeClass('sdb_h_active');
		var thisHeading = thisAccordion.find('.accordion-body.in').prev('.accordion-heading');
		if(thisHeading.length) {
			thisHeading.addClass('sdb_h_active');
		}
	},
	make_scroll: function() {
		antiScroll = $('.antiScroll').antiscroll().data('antiscroll');
	},
	update_scroll: function() {
		if($('.antiScroll').length) {
			if( $(window).width() > 979 ){
				$('.antiscroll-inner,.antiscroll-content').height($(window).height() - 40);
			} else {
				$('.antiscroll-inner,.antiscroll-content').height('600px');
			}
			antiScroll.refresh();
		}
	}
};

gebo_tips = {
	init: function() {
		if(!is_touch_device()){
			var shared = {
			style		: {
					classes: 'ui-tooltip-shadow ui-tooltip-tipsy'
				},
				show		: {
					delay: 100,
					event: 'mouseenter focus'
				},
				hide		: { delay: 0 }
			};
			if($('.ttip_b').length) {
				$('.ttip_b').qtip( $.extend({}, shared, {
					position	: {
						my		: 'top center',
						at		: 'bottom center',
						viewport: $(window)
					}
				}));
			}
			if($('.ttip_t').length) {
				$('.ttip_t').qtip( $.extend({}, shared, {
					position: {
						my		: 'bottom center',
						at		: 'top center',
						viewport: $(window)
					}
				}));
			}
			if($('.ttip_l').length) {
				$('.ttip_l').qtip( $.extend({}, shared, {
					position: {
						my		: 'right center',
						at		: 'left center',
						viewport: $(window)
					}
				}));
			}
			if($('.ttip_r').length) {
				$('.ttip_r').qtip( $.extend({}, shared, {
					position: {
						my		: 'left center',
						at		: 'right center',
						viewport: $(window)
					}
				}));
			};
		}
	}
};

gebo_popOver = {
	init: function() {
		$(".pop_over").popover();
	}
};

gebo_acc_icons = {
	init: function() {
		var accordions = $('.main_content .accordion');
		
		accordions.find('.accordion-group').each(function(){
			var acc_active = $(this).find('.accordion-body').filter('.in');
			acc_active.prev('.accordion-heading').find('.accordion-toggle').addClass('acc-in');
		});
		accordions.on('show', function(option) {
			$(this).find('.accordion-toggle').removeClass('acc-in');
			$(option.target).prev('.accordion-heading').find('.accordion-toggle').addClass('acc-in');
		});
		accordions.on('hide', function(option) {
			$(option.target).prev('.accordion-heading').find('.accordion-toggle').removeClass('acc-in');
		});	
	}
};

gebo_nav_mouseover = {
	init: function() {
		$('header li.dropdown').mouseenter(function() {
			if($('body').hasClass('menu_hover')) {
				$(this).addClass('navHover')
			}
		}).mouseleave(function() {
			if($('body').hasClass('menu_hover')) {
				$(this).removeClass('navHover open')
			}
		});
	}
};

gebo_colorbox_single = {
	init: function() {
		if($('.cbox_single').length) {
			$('.cbox_single').colorbox({
				maxWidth	: '80%',
				maxHeight	: '80%',
				opacity		: '0.2', 
				fixed		: true
			});
		}
	}
};

gebo_submenu = {
	init: function() {
		$('.dropdown-menu li').each(function(){
			var $this = $(this);
			if($this.children('ul').length) {
				$this.addClass('sub-dropdown');
				$this.children('ul').addClass('sub-menu');
			}
		});
		
		$('.sub-dropdown').on('mouseenter',function(){
			$(this).addClass('active').children('ul').addClass('sub-open');
		}).on('mouseleave', function() {
			$(this).removeClass('active').children('ul').removeClass('sub-open');
		})
		
	}
};

