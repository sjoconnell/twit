$(document).ready(function(){
    $(".tweets-left").click(function(){
        $(".your-tweet-box").toggleClass("invisible");
        $(".your-timeline-box").toggleClass("invisible");
    });

    $(".timeline-right").click(function(){
        $(".your-timeline-box").toggleClass("invisible");
        $(".your-tweet-box").toggleClass("invisible");
    });
});