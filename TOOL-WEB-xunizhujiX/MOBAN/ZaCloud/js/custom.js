function GetQueryString(name)
{
     var reg = new RegExp("(^|&)"+ name +"=([^&]*)(&|$)");
     var r = window.location.search.substr(1).match(reg);
     if(r!=null)return  unescape(r[2]); return null;
}
(function($) {
    "use strict";

    // ______________ RESPONSIVE MENU
    $(document).ready(function() {

        $('#navigation').superfish({
            delay: 300,
            animation: {
                opacity: 'show',
                height: 'show'
            },
            speed: 'fast',
            dropShadows: false
        });

        $(function() {
            $('#navigation').slicknav({
                closedSymbol: "&#8594;",
                openedSymbol: "&#8595;"
            });
        });
        var aff = GetQueryString('aff');
        if (aff){
           $('.btn-pricetable').each(function(){
                var href = $(this).attr('href');
                href = href.replace("cart.php?a=add", "aff.php?aff="+aff);
                //console.log(href);
                $(this).attr('href',href);
                
           });
        }


    });



    // ______________ ANIMATE EFFECTS
    var wow = new WOW({
        boxClass: 'wow',
        animateClass: 'animated',
        offset: 0,
        mobile: false
    });
    wow.init();

    


    // ______________ BACK TO TOP BUTTON

    $(window).scroll(function() {
        if ($(this).scrollTop() > 300) {
            $('#back-to-top').fadeIn('slow');
        } else {
            $('#back-to-top').fadeOut('slow');
        }
    });
    $('#back-to-top').click(function() {
        $("html, body").animate({
            scrollTop: 0
        }, 600);
        return false;
    });

	
})(jQuery);

