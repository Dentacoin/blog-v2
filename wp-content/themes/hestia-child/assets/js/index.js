jQuery(window).on('load', function()   {
    
});

jQuery(document).ready(function()   {
    checkIfCookie();
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

function checkIfCookie()    {
    if (jQuery('.privacy-policy-cookie').length > 0)  {
        jQuery('.privacy-policy-cookie .accept-all').click(function()    {
            basic.cookies.set('performance_cookies', 1);
            basic.cookies.set('functionality_cookies', 1);
            basic.cookies.set('marketing_cookies', 1);
            basic.cookies.set('strictly_necessary_policy', 1);

            window.location.reload();
        });

        console.log(jQuery('.adjust-cookies').length, 'jQuery(\'.adjust-cookies\')');

        jQuery('.adjust-cookies').click(function() {
            jQuery('.customize-cookies').remove();

            jQuery('.privacy-policy-cookie').append('<div class="customize-cookies"><button class="close-customize-cookies close-customize-cookies-popup">×</button><div class="text-center"><img src="/wp-content/themes/hestia-child/assets/images/cookie-icon.svg" alt="Cookie icon" class="cookie-icon"/></div><div class="text-center padding-bottom-20 fs-20">Select cookies to accept:</div><div class="cookies-options-list"><ul><li class="custom-checkbox-style"><input type="checkbox" class="custom-checkbox-input" id="performance-cookies"/><label class="dentacoin-login-gateway-fs-15 custom-checkbox-label" for="performance-cookies">Performance cookies <i class="fa fa-info-circle" aria-hidden="true" data-toggle="tooltip" title="These cookies collect data for statistical purposes on how visitors use a website, they don’t contain personal data and are used to improve user experience."></i></label></li><li class="custom-checkbox-style"><input type="checkbox" class="custom-checkbox-input" id="marketing-cookies"/><label class="dentacoin-login-gateway-fs-15 custom-checkbox-label" for="marketing-cookies">Marketing cookies <i class="fa fa-info-circle" aria-hidden="true" data-toggle="tooltip" title="Marketing cookies are used e.g. to deliver advertisements more relevant to you or limit the number of times you see an advertisement."></i></label></li></ul></div><div class="text-center actions"><a href="javascript:void(0);" class="cancel-btn margin-right-10 close-customize-cookies-popup">CANCEL</a><a href="javascript:void(0);" class="save-btn custom-cookie-save">SAVE</a></div><div class="custom-triangle"></div></div>');

            initCustomCheckboxes();
            initTooltips();

            jQuery('.close-customize-cookies-popup').click(function() {
                jQuery('.customize-cookies').remove();
            });

            jQuery('.custom-cookie-save').click(function() {
                basic.cookies.set('strictly_necessary_policy', 1);

                if(jQuery('#marketing-cookies').is(':checked')) {
                    console.log('set marketing');
                    basic.cookies.set('marketing_cookies', 1);
                }

                if(jQuery('#performance-cookies').is(':checked')) {
                    console.log('set performance');
                    basic.cookies.set('performance_cookies', 1);
                }

                window.location.reload();
            });
        });
    }
}

// init bootstrap tooltips
function initTooltips() {
    if(jQuery('[data-toggle="tooltip"]')) {
        jQuery('[data-toggle="tooltip"]').tooltip();
    }
}

function initCustomCheckboxes() {
    for (var i = 0, len = jQuery('.custom-checkbox-style').length; i < len; i+=1) {
        if (!jQuery('.custom-checkbox-style').eq(i).hasClass('already-custom-style')) {
            jQuery('.custom-checkbox-style').eq(i).prepend('<label for="'+jQuery('.custom-checkbox-style').eq(i).find('input[type="checkbox"]').attr('id')+'" class="custom-checkbox"></label>');
            jQuery('.custom-checkbox-style').eq(i).addClass('already-custom-style');
        }
    }

    jQuery('.custom-checkbox-style .custom-checkbox-input').unbind('change').on('change', function() {
        if (jQuery(this).is(':checked')) {
            jQuery(this).closest('.custom-checkbox-style').find('.custom-checkbox').html('✓');
        } else {
            jQuery(this).closest('.custom-checkbox-style').find('.custom-checkbox').html('');
        }

        if (jQuery(this).attr('data-radio-group') != undefined) {
            for (var i = 0, len = jQuery('[data-radio-group="'+jQuery(this).attr('data-radio-group')+'"]').length; i < len; i+=1) {
                if (!jQuery(this).is(jQuery('[data-radio-group="'+jQuery(this).attr('data-radio-group')+'"]').eq(i))) {
                    jQuery('[data-radio-group="'+jQuery(this).attr('data-radio-group')+'"]').eq(i).prop('checked', false);
                    jQuery('[data-radio-group="'+jQuery(this).attr('data-radio-group')+'"]').eq(i).closest('.custom-checkbox-style').find('.custom-checkbox').html('');
                }
            }
        }
    });
}

//load images after website load
if(jQuery('img[data-defer-src]').length) {
    jQuery(window).on('scroll', function(){
        loadDeferImages();
    });
}

function loadDeferImages() {
    jQuery('body').addClass('overflow-hidden');
    var window_width = jQuery(window).width();
    jQuery('body').removeClass('overflow-hidden');

    for(var i = 0, len = jQuery('img[data-defer-src]').length; i < len; i+=1) {
        if(basic.isInViewport(jQuery('img[data-defer-src]').eq(i)) && jQuery('img[data-defer-src]').eq(i).attr('src') == undefined) {
            if(window_width < 500 && jQuery('img[data-defer-src]').eq(i).attr('data-xss-image') != undefined) {
                jQuery('img[data-defer-src]').eq(i).attr('src', jQuery('img[data-defer-src]').eq(i).attr('data-xss-image'));
            } else if(window_width < 768 && jQuery('img[data-defer-src]').eq(i).attr('data-xs-image') != undefined) {
                jQuery('img[data-defer-src]').eq(i).attr('src', jQuery('img[data-defer-src]').eq(i).attr('data-xs-image'));
            } else if(window_width < 992 && jQuery('img[data-defer-src]').eq(i).attr('data-sm-image') != undefined) {
                jQuery('img[data-defer-src]').eq(i).attr('src', jQuery('img[data-defer-src]').eq(i).attr('data-sm-image'));
            } else {
                console.log(jQuery('img[data-defer-src]').eq(i).attr('data-defer-src'));
                jQuery('img[data-defer-src]').eq(i).attr('src', jQuery('img[data-defer-src]').eq(i).attr('data-defer-src'));
            }
        }
    }
}
loadDeferImages();

if (typeof(dcnCookie) != undefined) {
    dcnCookie.init({
        'google_app_id' : 'UA-97167262-2'
    });
}