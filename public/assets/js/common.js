$(function (e) {
	$width = $(window).innerWidth(),
    wWidth = windowWidth();

	$(document).ready(function (e) {
		btnTop();
        datepicker();
        mainVisual();
        speakersRolling();
        sponsorRolling();
		popup();
        subMenu();
        //tabMenu();
        fileUpload();
        imgMap();
        subVisual();
        allMenu(); //해당 script 안먹어서  $document 추가
        menuRolling();

		if(wWidth < 769){
            loadMore(6);		
		}else{
            loadMore(12);
		}
		
		resEvt();
	});

	// resize
	function resEvt() {
        popupRolling();

		if (wWidth < 1025) {
			mGnb();		
			subConHeight();

			if($('.js-dim').hasClass('mobile')){
				$('.js-dim').show();
				$('html, body').addClass('ovh');
                $('#gnb').css('right','0');
			}     

            linkTabMenu(30);
			
		} else {	
            gnb();	
			if($('.js-dim').hasClass('mobile')){
				$('.js-dim').hide();
				$('html, body').removeClass('ovh');
			}
            $('#gnb, .js-gnb > li > ul').removeAttr('style');
            $('.js-gnb > li').removeClass('on');

            
            linkTabMenu(50);
		}

		if(wWidth < 769){
			touchHelp();
			mTabMenu();
            mSlideTabMenu();
            $('.js-tab-slidecon').height('');
		}else{
            tabMenu();
            slideTabMenu();
			$('.js-sub-menu-list ul').removeAttr('style');
			$('.js-btn-sub-menu').removeClass('on');
            $('.js-sub-menu, .js-tab-menu, .js-btn-tab-menu + ul').removeAttr('style');
			$('.js-btn-tab-menu').removeClass('on');
		}
	}

	$(window).resize(function (e) {
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

function Mobile() {
  return /Android|webOS|iPhone|iPad|iPod|BlackBerry|IEMobile|Opera Mini/i.test(navigator.userAgent);
}

function windowWidth() {
	if ($(document).innerHeight() > $(window).innerHeight()) {
		if (Mobile()) {
			return $(window).innerWidth();
		} else {
			return $(window).innerWidth() + 17;
		}
	} else {
		return $(window).innerWidth();
	}
}

function subConHeight(){
    $(document).ready(function(e){
        var subConHeight = $(window).outerHeight() - $('.js-header').outerHeight() - $('#footer').outerHeight();
        setTimeout(function(e){
            $('.sub-contents').css('min-height',subConHeight);
        },100);
    });	
}

function gnb() {	
    $('.js-gnb > li > a').off('click');
	$('.js-gnb > li').on('mouseenter',function(e){
        $(this).find('ul').stop().slideDown();
        $('.js-gnb > li').not(this).find('ul').stop().slideUp();
    });
    $('.js-gnb').on('mouseleave', function(e){
        $('.js-gnb > li > ul').stop().slideUp();
    });
}

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

function mainVisual(){
    if($('.js-main-visual .main-visual-con').length > 1){
        $('.js-main-visual').not('.slick-initialized').slick({
            dots: true,
            arrows: false,
			autoplay: true,
			autoplaySpeed: 3000,
			speed: 1000,
			infinite: true,
            fade: true
		});
    }
}

function speakersRolling(){
    $('.js-speakers-rolling').not('.slick-initialized').slick({
        dots: false,
        arrows: true,
        autoplay: true,
        autoplaySpeed: 3000,
        speed: 1000,
        infinite: true,
        slidesToShow: 5,
        slidesToScroll: 1,
        adaptiveHeight: true,
        responsive: [
            {
                breakpoint: 1200,
                settings: {
                slidesToShow: 3,
                slidesToScroll: 1,
                }
            },
            {
                breakpoint: 768,
                settings: {
                    slidesToShow: 2,
                    slidesToScroll: 1,
                }
                }
            ]
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
					settings: {
						slidesToShow: 4,
						slidesToScroll: 1
					}
				},
				{
					breakpoint: 768,
					settings: {
						slidesToShow: 3,
						slidesToScroll: 1
					}
				}
			]
		});
    });
}

function subMenu(){
	$('.js-btn-sub-menu').off().on('click', function (e) {
		$(this).next('ul').stop().slideToggle();
		$(this).toggleClass('on');
		$('.js-btn-sub-menu').not(this).removeClass('on').next('ul').stop().slideUp();
		return false;
	});
	$('body').off().on('click', function (e) {
		if ($('.js-sub-menu-list').has(e.target).length == 0) {
			$('.js-btn-sub-menu').removeClass('on');
			$('.js-btn-sub-menu:visible +  ul').stop().slideUp();
		}
	});
}

function tabMenu(){
    $('.js-tab-menu').each(function(e){
        var cnt = $(this).children('li').length;
        $(this).addClass('n'+cnt+'');
    });

    var btnTabMenu = $('.js-btn-tab-menu'),
        tabMenu = $('.js-tab-menu'),
        tabCon = $('.js-tab-con');

    btnTabMenu.next('ul').children('li').off('click');
    tabMenu.children('li').off().on('click',function(e){
        var cnt = $(this).index();
        $(this).addClass('on');
        $(this).siblings().removeClass('on');
        tabCon.hide().eq(cnt).stop().fadeIn();
        $('.js-img-rolling').slick('setPosition');
        //return false;
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
        $(this).next('ul').find('li').off().on('click',function(e){
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

function quickMenu(){
	var currentPosition = parseInt($('.js-quick-menu').css('top')); 
	$(window).scroll(function() { 		
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
			dayNamesMin : ["월", "화", "수", "목", "금", "토", "일"],
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
        // $(popCnt).css('display','block');
        $(popCnt).fadeIn();
        $('.popup-wrap .scroll-y').scrollTop(0);
        return false;
    });
    $('.js-pop-close').on('click',function(e){
        $('html, body').removeClass('ovh');
        // $(this).parents('.popup-wrap').css('display','none');
        $(this).parents('.popup-wrap').fadeOut();
        return false;
    });
    // $('.popup-wrap').off().on('click', function (e){
    // 	if ($('.popup-contents').has(e.target).length == 0){
    // 		$('html, body').removeClass('ovh');
    // 		$('.popup-wrap').css('display','none');
    // 	}
    // });
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
            alert('내역이 없습니다.');
            $('.js-btn-more').hide();
        }
    });
}

function allMenu(){
    $(document).on('click','.js-allmenu-open',function(e){
        console.log('open');
        $('.js-allmenu').stop().fadeIn();
        $('html, body').addClass('ovh');
    });
    $(document).on('click','.js-allmenu-close',function(e){
        console.log('close');
        $('.js-allmenu').stop().fadeOut();
        $('html, body').removeClass('ovh');
    });
}

function popupRolling(){
    $('.js-pop-close').each(function(e){
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
            },
            {
                breakpoint: 1024,
                settings: {
                    slidesToShow: 2,
                    slidesToScroll: 1
                }
            },{
                breakpoint: 768,
                settings: {
                    slidesToShow: 1,
                    slidesToScroll: 1,
                }
            }]
        });
    }
}

function menuRolling(){
    if($('.js-menu-rolling').length){
        const $slider = $('.js-menu-rolling');
        const currentIndex = $slider.find('.current').index();
        $slider.slick({
            arrows: false,
            slidesToShow: 5,
            slidesToScroll: 1,
            infinite: false,
            centerMode: true,
            centerPadding: 0,
            initialSlide: currentIndex,
            responsive: [
                {
                    breakpoint: 1024,
                    settings: {
                        slidesToShow: 3,
                        slidesToScroll: 1
                    }
                },
                {
                    breakpoint: 768,
                    settings: {
                        slidesToShow: 1,
                        slidesToScroll: 1
                    }
                }
            ]
        });

        $slider.on('afterChange', function (event, slick, currentSlide) {
            updateCurrentClass(currentSlide, slick.$slides);
        });

        function updateCurrentClass(currentSlide, slides) {
            slides.removeClass('current');
            slides.eq(currentSlide).addClass('current');
        }

        function moveSlides(step) {
            const slick = $slider.slick('getSlick');
            const targetSlide = slick.currentSlide + step;

            if (targetSlide < 0) {
                alert("이전 메뉴가 없습니다.");
            } else if (targetSlide >= slick.slideCount) {
                alert("다음 메뉴가 없습니다.");
            } else {
                $slider.slick('slickGoTo', targetSlide);
                selectedIndex = targetSlide;
            }
        }

        $('.js-menu-rolling a').off().on('click', function (e){
            const parentIndex = $(this).index();

            $(this).addClass('current slick-current slick-active');
            $(this).siblings().removeClass('slick-active slick-current current');

            $slider.slick('slickGoTo', parentIndex);
        });

        $('.js-prev').on('click', function () {
            moveSlides(-1);
        });

        $('.js-next').on('click', function () {
            moveSlides(1);
        });
    }
}