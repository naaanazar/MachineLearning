$(document).ready(function() {
    $("a").click(function(e) {
        var elementClick = $(this).attr("href");
        var destination = $(elementClick).offset().top;
        $('html,body').animate({
            scrollTop: destination
        }, 1200, 'swing');
        return false;
    });

    $("#button-benefits").click(function() { 
        $('html,body').animate({
                scrollTop: $(".benefits-title").offset().top
            },
            'slow');
    });
});