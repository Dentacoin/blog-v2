jQuery(window).on('load', function()   {
    if(jQuery('.single-post-container').length > 0) {
        var fixed_socials_offset_top = jQuery('.semi-fixed-socials aside').offset().top;
        var fixed_socials_height = jQuery('.semi-fixed-socials aside').height();
        var scroll_top = 0;
        var max_scroll = jQuery('.semi-fixed-socials').offset().top + jQuery('.semi-fixed-socials').height();
        jQuery(window).on('scroll', function () {
            if (jQuery(window).scrollTop() + jQuery(window).height() / 2 > fixed_socials_offset_top + fixed_socials_height / 2 && jQuery(window).scrollTop() + jQuery(window).height() / 2 < jQuery('.semi-fixed-socials').offset().top + jQuery('.semi-fixed-socials').height() - fixed_socials_height / 2) {
                jQuery('.semi-fixed-socials aside').css({'top': (jQuery(window).scrollTop() + jQuery(window).height() / 2) - (fixed_socials_offset_top + fixed_socials_height / 2) + 'px'});
            }
        });
    }
});

//PAGES
if(jQuery('.homepage-container').length > 0)    {
    initFeaturedPostsSlider();
    initMostPopularPostsSlider();
}else if(jQuery('.single-post-container').length > 0)    {
    initMostPopularPostsSlider();
}

function initMostPopularPostsSlider()   {
    //init slider for most popular posts
    jQuery('.most-popular-slider').slick({
        slidesToShow: 3,
        infinite: false,
        responsive: [
            {
                breakpoint: 1200,
                settings: {
                    slidesToShow: 2
                }
            },
            {
                breakpoint: 768,
                settings: {
                    slidesToShow: 1
                }
            }
        ]
    });
}

function initFeaturedPostsSlider()   {
    //init slider for featured posts
    jQuery('.homepage-container .featured-slider').slick({
        slidesToShow: 1,
        autoplay: true,
        infinite: false,
        autoplaySpeed: 8000,
    });
}

jQuery('aside.main-sidebar .close a').click(function()  {
    var this_btn = jQuery(this);
    if(this_btn.attr('data-open') == 'true')    {
        this_btn.find('img').attr('src', this_btn.find('img').attr('data-open-arrow'));
        jQuery('aside.main-sidebar').addClass('closed');
        jQuery('.container-fluid.main-wrapper').removeClass('moved');
        this_btn.attr('data-open', 'false');
    }else if(this_btn.attr('data-open') == 'false')    {
        this_btn.find('img').attr('src', this_btn.find('img').attr('data-close-arrow'));
        jQuery('aside.main-sidebar').removeClass('closed');
        jQuery('.container-fluid.main-wrapper').addClass('moved');
        this_btn.attr('data-open', 'true');
    }

    setTimeout(function()   {
        //PAGES
        if(jQuery('.homepage-container').length > 0)    {
            jQuery('.homepage-container .featured-slider').slick('setPosition');
            jQuery('.most-popular-slider').slick('setPosition');
        }else if(jQuery('.single-post-container').length > 0)    {
            jQuery('.most-popular-slider').slick('setPosition');
        }
    }, 300);
});

jQuery('header .search form').on('submit', function(event)   {
    var this_form = jQuery(this);
    if(this_form.find('.search-field').hasClass('fade-in-animation')) {
        //submit the form
    }else {
        //show the input field
        this_form.find('.label-floating').show();
        this_form.find('.search-field').addClass('fade-in-animation').focus();
        event.preventDefault();
    }
});

function initMobileMenuActions()    {
    if(basic.isMobile)    {
        jQuery('header .mobile-nav-container > a').click(function()   {
            jQuery('.mobile-nav').addClass('active');
        });

        jQuery('.mobile-nav .close-btn').click(function()   {
            jQuery('.mobile-nav').removeClass('active');
        });
    }
}
initMobileMenuActions();