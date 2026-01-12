$(function (e){
	$width = $(window).innerWidth(),
    wWidth = windowWidth();

	$(document).ready(function (e){
		btnTop();
        datepicker();
        mainVisual();
        sponsorRolling();
		popup();
        subMenu();
        fileUpload();
        imgMap();
        subVisual();
        // toggleCon();

		if(wWidth < 769){
            loadMore(6);
		}else{
            loadMore(12);
		}
		
		resEvt();
	});

	// resize
	function resEvt(){
        popupRolling();
        subConHeight();

		if (wWidth < 1025){
			mGnb();
			if($('.js-dim').hasClass('mobile')){
				$('.js-dim').show();
				$('html, body').addClass('ovh');
                $('#gnb').css('right','0');
			}     
            $('.js-allmenu').stop().fadeOut();
            $('html, body').removeClass('ovh');
		} else{	
            // gnb();
            allMenu();	
            if($('.js-dim').hasClass('mobile')){
				$('.js-dim').hide();
				$('html, body').removeClass('ovh');
			}
            $('#gnb, .js-gnb > li > ul').removeAttr('style');
            $('.js-gnb > li').removeClass('on');
		}

		if(wWidth < 769){
			touchHelp();
			mTabMenu();
            // mSlideTabMenu();
            // mInnerTabMenu();
            // mMainTabDropDown();
            linkTabMenu(30);
            $('.js-tab-slidecon').height('');
		}else{
            MainTabDropDown();
            tabMenu();
            slideTabMenu();
            innerTabMenu();
            linkTabMenu(30);
			// $('.js-tab-drop-wrap ul').removeAttr('style');
            $('.js-sub-menu-list ul').removeAttr('style');
			$('.js-btn-sub-menu').removeClass('on');
            $('.js-sub-menu, .js-tab-menu, .js-btn-tab-menu + ul, .js-inner-tab-menu').removeAttr('style');
			$('.js-btn-tab-menu').removeClass('on');
		}
	}

	$(window).resize(function (e){
		$width = $(window).innerWidth(),
		wWidth = windowWidth();
		resEvt();
	});

	$(window).scroll(function(e){
		if($(this).scrollTop() > 200){
			$('.js-btn-top').addClass('on');
		}else{
			$('.js-btn-top').removeClass('on');
		}
	});
});

function Mobile(){
    return /Android|webOS|iPhone|iPad|iPod|BlackBerry|IEMobile|Opera Mini/i.test(navigator.userAgent);
}

function windowWidth(){
	if ($(document).innerHeight() > $(window).innerHeight()){
		if (Mobile()){
			return $(window).innerWidth();
		} else{
			return $(window).innerWidth() + 17;
		}
	} else{
		return $(window).innerWidth();
	}
}

function subConHeight(){
    $(document).ready(function(e){
        var subConHeight = $(window).outerHeight() - $('.js-header').outerHeight() - $('#footer').outerHeight() - $('.sub-menu-wrap').outerHeight();
        setTimeout(function(e){
            $('.sub-contents').css('min-height',subConHeight);
        },100);
    });	
}



/*
function gnb(){	
    $('.js-gnb > li > a').off('click');
	$('.js-gnb > li').on('mouseenter',function(e){
        $(this).find('ul').stop().slideDown();
        $('.js-gnb > li').not(this).find('ul').stop().slideUp();
    });
    $('.js-gnb').on('mouseleave', function(e){
        $('.js-gnb > li > ul').stop().slideUp();
    });
}
*/


/*
function gnb(){	
    var max_h = 0;
	var gnb_h = 0;
    $('.js-gnb > li > ul').each(function (e) {
        $(this).height('');
        var h = parseInt($(this).css('height'));
        if (max_h < h) {
            max_h = h;
        }
        gnb_h = max_h + 165;
    });
	
    $('.js-gnb > li > a').off('click');
	$('.js-gnb > li').on('mouseenter',function(e){
		$('.js-header').addClass('active').stop().animate({'height':gnb_h},400);
    });
    $('.js-gnb').on('mouseleave', function(e){
		$('.js-header').removeClass('active').stop().animate({'height':'165px'},300);
    });
}
*/


function mGnb(){
	$('.js-header').removeAttr('style');
    $('.js-gnb > li').off('mouseenter');
    $('.js-gnb').off('mouseleave');
    $('.js-gnb > li > a').off().on('click',function(e){
        if($(this).next('ul').length){
            $(this).parent('li').toggleClass('on');
            $('.js-gnb > li > a').not(this).parent('li').removeClass('on');
            $(this).next('ul').stop().slideToggle();
            $('.js-gnb > li > a').not(this).next('ul').stop().slideUp();
            return false;
        }
    });
    
    $('.js-btn-menu-open').on('click',function(e){
        $('html, body').addClass('ovh');
        $('.js-dim').addClass('mobile').stop().fadeIn(100);
        $('#gnb').stop().animate({'right':0},400); 
    });
    $('.js-btn-menu-close, .js-dim').on('click',function(e){
        $('html, body').removeClass('ovh');
        $('.js-dim').removeClass('mobile').stop().fadeOut(100);
        $('#gnb').stop().animate({'right':'-100%'},400);
    });
}

function mainVisual() {
    $('.js-main-slide').each(function(e){
		$(this).not('.slick-initialized').slick({
			dots: true,
			arrows: false,
			autoplay: true,
			autoplaySpeed: 3000,
			speed: 1000,
			infinite: true,
			slidesToShow: 1,
			slidesToScroll: 1,
		});
    });
}

function sponsorRolling(){
    $('.js-sponsor-rolling').each(function(e){
		$(this).not('.slick-initialized').slick({
			dots: false,
			arrows: true,
			autoplay: true,
			autoplaySpeed: 3000,
			speed: 1000,
			infinite: true,
			slidesToShow: 6,
			slidesToScroll: 1,
			responsive: [
				{
					breakpoint: 1024,
					settings:{
						slidesToShow: 4,
						slidesToScroll: 1
					}
				},
				{
					breakpoint: 768,
					settings:{
						slidesToShow: 3,
						slidesToScroll: 1
					}
				},
				{
					breakpoint: 480,
					settings:{
						slidesToShow: 2,
						slidesToScroll: 1
					}
				}
			]
		});
    });
}

function subMenu(){
	$('.js-btn-sub-menu').off().on('click', function (e){
		$(this).next('ul').stop().slideToggle();
		$(this).toggleClass('on');
		$('.js-btn-sub-menu').not(this).removeClass('on').next('ul').stop().slideUp();
		return false;
	});
	$('body').off().on('click', function (e){
		if ($('.js-sub-menu-list').has(e.target).length == 0){
			$('.js-btn-sub-menu').removeClass('on');
			$('.js-btn-sub-menu:visible +  ul').stop().slideUp();
		}
	});
}

function tabMenu(){
    $('.js-tab-menu').each(function(){
        var cnt = $(this).children('li').length;
        $(this).addClass('n' + cnt);
    });

    $('.tab-wrap').each(function(){
        var $wrap = $(this);
        var $tabMenu = $wrap.find('.js-tab-menu');
        var $tabCon  = $wrap.find('.js-tab-con');

        $tabMenu.children('li').off('click').on('click', function(e){
            e.preventDefault();
            var idx = $(this).index();
            $(this).addClass('on').siblings().removeClass('on');
            $tabCon.hide().eq(idx).stop().fadeIn();
            $wrap.find('.js-img-rolling').slick('setPosition');
        });
    });
}

function mTabMenu(){
    $('.js-btn-tab-menu').each(function(e){
        var activeTab = $(this).next('ul').find('li.on > a').html();
        $(this).html(activeTab);

        $(this).off().on('click',function(e){
            $(this).toggleClass('on');
            $(this).next('ul').stop().slideToggle();
            return false;
        });
        $(this).next('ul:not(.board-cate-menu):not(.board-cate-list)').find('li').off().on('click',function(e){
            var currentTab = $(this).html();
            var cnt = $(this).index();
            $(this).parents('.sub-tab-wrap').find('.js-btn-tab-menu').html(currentTab);
    
            $(this).addClass('on');
            $(this).siblings().removeClass('on');
    
            $(this).parent('ul').stop().slideUp();
            $('.js-btn-tab-menu').removeClass('on');
            $('.js-tab-con').hide().eq(cnt).stop().fadeIn();
        });
    });
}

function slideTabMenu(){
    $('.js-tab-slide > li').off().on('click',function(e){
        $(this).addClass('on');
        $('.js-tab-slide > li').not(this).removeClass('on');
        if(!$(this).hasClass('all')){
            var cnt = $(this).index() - 1;
            $('.js-tab-slidecon').stop().slideUp().eq(cnt).stop().slideDown();
        }else{
            $('.js-tab-slidecon').stop().slideDown();
        }
        return false;
    });
}
function mSlideTabMenu(){
	var activeTab = $('.js-btn-tab-menu + .js-tab-slide > li.on > a').html();
	$('.js-btn-tab-menu').html(activeTab);
	$('.js-btn-tab-menu').off().on('click',function(e){
		$(this).toggleClass('on');
		$(this).next('ul').stop().slideToggle();
		return false;
	});
	$('.js-btn-tab-menu + .js-tab-slide > li').off().on('click',function(e){		
		var currentTab = $(this).html();
		$('.js-btn-tab-menu').html(currentTab);

		$(this).addClass('on');
		$(this).siblings().removeClass('on');

		$(this).parent('ul').stop().slideUp();
		$('.js-btn-tab-menu').removeClass('on');

        $('.js-tab-slide > li').not(this).removeClass('on');
        if(!$(this).hasClass('all')){
            var cnt = $(this).index() - 1;
            $('.js-tab-slidecon').stop().slideUp().eq(cnt).stop().slideDown();
        }else{
            $('.js-tab-slidecon').stop().slideDown();
        }
        return false;
	});
}

function linkTabMenu(h){
    $('.js-tab-link > li > a').on('click',function(e){
        $(this).parent('li').addClass('on');
        $('.js-tab-link > li > a').not(this).parent('li').removeClass('on');
        if($(this).attr('href')){
            $('html, body').stop().animate({
                scrollTop: $(this.hash).offset().top - h
            }, 400);
        }
        return false;
    });
}

function innerTabMenu(){
	$('.js-tab-con').each(function(e){
		var innerTabMenu = $(this).find('.js-inner-tab-menu'),
			innerTabCon = $(this).find('.js-inner-tab-con');

        innerTabMenu.children('li').off().on('click',function(e){
			var cnt = $(this).index();
			$(this).addClass('on');
			$(this).siblings().removeClass('on');
			innerTabCon.hide().eq(cnt).stop().fadeIn();
			return false;
		});
	});
}

function mInnerTabMenu(){
    $('.inner-tab-wrap').each(function(e){
        $(this).children('.js-btn-tab-menu').each(function(e){
            var activeTab = $(this).next('ul').find('li.on > a').html();
            $(this).html(activeTab);

            $(this).off().on('click',function(e){
                $(this).toggleClass('on');
                $(this).next('ul').stop().slideToggle();
                return false;
            });
            $(this).next('ul:not(.board-cate-menu)').find('li').off().on('click',function(e){
                var currentTab = $(this).html();
                var cnt = $(this).index();
                $(this).parents('.inner-tab-wrap').find('.js-btn-tab-menu').html(currentTab);
        
                $(this).addClass('on');
                $(this).siblings().removeClass('on');
        
                $(this).parent('ul').stop().slideUp();
                $('.js-btn-tab-menu').removeClass('on');
                $(this).parents('.js-tab-con').find('.js-inner-tab-con').hide().eq(cnt).stop().fadeIn();
            });
        });
    });
}

function quickMenu(){
	var currentPosition = parseInt($('.js-quick-menu').css('top')); 
	$(window).scroll(function(){ 		
		$('.js-quick-menu').show();
		var position = $(window).scrollTop();
		
		if($(window).scrollTop() + $(window).height() > $(document).height() - 200){ 
			$('.js-quick-menu').stop().animate({'top':position + currentPosition - 200 + "px"},800); 
		}else{
			$('.js-quick-menu').stop().animate({'top':position + currentPosition + "px"},800); 
		}
	});	
}

function btnTop(){
	$('.js-btn-top').on('click',function(e){
	    $('html, body').stop().animate({'scrollTop':0},400);
		return false;
	});
}

function touchHelp(){
	$('.scroll-x').each(function(e){
		if($(this).height() < 180){
			$(this).addClass('small');
		}
		$(this).scroll(function(e){
			$(this).removeClass('touch-help');
		});
	});
}

function fileUpload(option=null){
    $('.file-upload').each(function(e){
        $(this).parent().find('.upload-name').attr('readonly','readonly');
        $(this).on('change',function(){
            var fileName = $(this).val().split("\\").pop();
            $(this).parent().find('.upload-name').val(fileName);
        });
    });
}

function datepicker(){
	if($('.datepicker').length){
		$('.datepicker').datepicker({
			dateFormat : "yy-mm-dd",
			dayNamesMin : ["��", "��", "��", "紐�", "湲�", "��", "��"],
			monthNamesShort : ["1", "2", "3", "4", "5", "6", "7", "8", "9", "10", "11", "12"],
			showMonthAfterYear: true, 
			changeMonth : true,
			changeYear : true
		});
	}
}

function popup(){
    $('.js-pop-open').on('click',function(e){
        var popCnt = $(this).attr('href');
        $('html, body').addClass('ovh');
        $(popCnt).stop().fadeIn();
        $('.popup-wrap .scroll-y').scrollTop(0);
        return false;
    });
    $('.js-pop-close').on('click',function(e){
        $('html, body').removeClass('ovh');
        $(this).parents('.popup-wrap').stop().fadeOut();
        return false;
    });
    $('.popup-wrap.dim-click').off().on('click', function (e){
        if ($('.popup-contents').has(e.target).length == 0){
            $('html, body').removeClass('ovh');
            $('.popup-wrap').stop().fadeOut();
        }
    });
}

function imgMap(){
    $('img[usemap]').each(function(e){
        $('img[usemap]').rwdImageMaps();
    });
}

function subVisual(){
    setTimeout(function(e){
        $('.js-sub-visual').addClass('on');
    },100);
}

function loadMore(int){
    $('.js-btn-more').hide();
    if($('.js-more-list > li').length > int){
        $('.js-btn-more').show();
    }
    $('.js-more-list > li').slice(0, int).css('display','flex');
    $('.js-btn-more').off().on('click',function(e){
        e.preventDefault();
        if(!$('.js-more-list > li:hidden').length == 0){
            $('.js-more-list > li:hidden').slice(0, int).css('display','flex');
        }else{
            alert('占쎈똻肉�옙占� 占쎈냱�울옙�덈뼄.');
            //$('.js-btn-more').hide();
        }
    });
}

function allMenu(){
    $('.js-allmenu-open').on('click',function(e){
        $('.js-allmenu').stop().fadeIn();
        $('html, body').addClass('ovh');
    });
    $('.js-allmenu-close').on('click',function(e){
        $('.js-allmenu').stop().fadeOut();
        $('html, body').removeClass('ovh');
    });
}

function popupRolling(){
    $('.popup-rolling-wrap .js-pop-close').each(function(e){
        $(this).on('click',function(e){
            $(this).parents('.popup-contents').remove();
        });
    });

    if($('.js-popup-rolling .popup-contents').length > 1){
        if($('.js-popup-rolling').hasClass('n3')){
            var $setting = '',
                $num1 = 3,
                $num2 = 1;
        }else{
            var $setting = 'unslick',
                $num1 = '',
                $num2 = '';
        }
        $('.js-popup-rolling').not('.slick-initialized').slick({
            dots: false,
            arrows: true,
            autoplay: true,
            autoplaySpeed: 3000,
            speed: 1000,
            infinite: false,
            adaptiveHeight: true,
            slidesToShow: 3,
            slidesToScroll: 1,
            adaptiveHeight: true,
            responsive: [{
                breakpoint: 9999,
                settings: $setting,
                slidesToShow: $num1,
                slideToScroll: $num1,
            },{
                breakpoint: 1024,
                settings:{
                    slidesToShow: 2,
                    slidesToScroll: 1
                }
            },{
                breakpoint: 768,
                settings:{
                    slidesToShow: 1,
                    slidesToScroll: 1,
                }
            }]
        });
    }
}


function toggleCon(){
    $('.js-btn-toggle').on('click',function(e){
        var thisText = $('.js-btn-toggle .text').text();
        console.log(thisText);
        $(this).toggleClass('on').find('.text').text('野껓옙占쎈맩媛� 占쎈떯由�');
        if(!$(this).hasClass('on')){
            $(this).find('.text').text('野껓옙占쎈맩媛� 占썬꺁由�');
        }
        $(this).parent().next('.js-toggle-con').stop().slideToggle();
    });
}


function mMainTabDropDown() {
    if( $('.js-tab-drop-wrap').length ){

        $('.js-tab-drop-wrap').each(function () {
            var $wrap = $(this);
            var activeTab = $wrap.find('li.on > a').html();
            $wrap.find('.js-btn-tab-drop').html(activeTab);

            $wrap.find('.js-btn-tab-drop').off().on('click', function (e) {
                $(this).toggleClass('on');
                $(this).next('ul').stop().slideToggle();
                return false;
            });

            $wrap.find('li > a').off().on('click', function (e) {
                var currentTab = $(this).html();
                $wrap.find('.js-btn-tab-drop').html(currentTab);

                $wrap.find('li').removeClass('on');
                $(this).parent().addClass('on');

                $wrap.find('ul').stop().slideUp();
                $wrap.find('.js-btn-tab-drop').removeClass('on');
            });
        });

        $('body').off().on('click', function (e) {
            if ($('.js-tab-drop-wrap').has(e.target).length == 0) {
                $('.js-tab-drop-wrap .js-btn-tab-drop').removeClass('on');
                $('.js-tab-drop-wrap .js-btn-tab-drop:visible +  ul').stop().slideUp();
            }
        });
    }
}

function MainTabDropDown() {
    if( $('.js-tab-drop-wrap').length ){
        $('.js-tab-drop-wrap').each(function () {
            var $wrap = $(this);
            $wrap.find('li > a').off().on('click', function (e) {
                $wrap.find('li').removeClass('on');
                $(this).parent().addClass('on');
            });
        });
    }
}

function linkTabMenu(h){
    $('.js-tab-link > li > a').on('click',function(e){
        $(this).parent('li').addClass('on');
        $('.js-tab-link > li > a').not(this).parent('li').removeClass('on');
        if($(this).attr('href')){
            $('html, body').stop().animate({
                scrollTop: $(this.hash).offset().top - h
            }, 400);
        }
    });
}
