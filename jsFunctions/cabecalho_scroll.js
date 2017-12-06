var menuScrollAnt = 0;

$(window).scroll(function(){
    var scroll = $(this).scrollTop(),
        scrollDown = scroll - menuScrollAnt,
        scrollUp = menuScrollAnt - scroll,
        marginHeader = parseInt($("header").css("margin-top")),
        marginLimitUp = -100,
        marginLimitDown = 0;

    if (scrollDown > 0){
        if ($("header").is(":animated")){

        }else{
            $("header").animate({marginTop:-$('header').height()-40},100);
        }
    }else if (scrollUp > 0){
        if ($("header").is(":animated")){

        }else{
            $("header").animate({marginTop:0},100);
        }
    }

    menuScrollAnt = scroll;
});
