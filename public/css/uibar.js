$(function(){
    $("[data-trigger]").on("click",function() {
        var targeet_id = $(this).attr('data-trigger');
        $(targeet_id).toggleClass("show");
        $('body').toggleClass("offcanvas-active");
    });

    $(".btn-close").click(function(e){
        $(".navbar-collapse").removeClass("show");
        $("body").removeClass("offcanvas-active");
    });
})