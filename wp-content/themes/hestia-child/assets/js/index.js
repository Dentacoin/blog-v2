jQuery(window).on('load', function()   {
    
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

//rewrite pagination urls to lead to first page of posts list
if(jQuery('.homepage-container .navigation.pagination')) {
    for(var i = 0, len = jQuery('.homepage-container .navigation.pagination a').length; i < len; i+=1) {
        jQuery('.homepage-container .navigation.pagination a').eq(i).attr('href', jQuery('.homepage-container .navigation.pagination a').eq(i).attr('href') + '#listing-posts');
    }
}