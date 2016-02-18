$(document).ready(function(){

    $(".tweets-left").click(function(){
        if ($(this).hasClass("grey-color")){
            $(this).toggleClass("grey-color");
            $(".timeline-right").toggleClass("grey-color");
            $(".your-tweet-box").toggleClass("invisible");
            $(".your-timeline-box").toggleClass("invisible");
        }
    });

    $(".timeline-right").click(function(){
        if ($(this).hasClass("grey-color")){
            $(this).toggleClass("grey-color");
            $(".tweets-left").toggleClass("grey-color");
            $(".your-timeline-box").toggleClass("invisible");
            $(".your-tweet-box").toggleClass("invisible");
        }
    });
    
});