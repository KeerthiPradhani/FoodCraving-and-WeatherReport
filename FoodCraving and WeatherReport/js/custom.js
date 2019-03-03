$(document).ready(function () {
	
	/*Button Click ACtion */
	$(".searchbutton").click(function (e) {
        showPopup();
    });
	
	/* PopUp Window Close Button */
	$(".closebutton").click(function (e) {
         closePopup();
    });

/* Close PopUp */
function closePopup() {
        $(".bg_overlay").fadeOut();
        $(".lightBox").fadeOut();
    };
	
/* Open PopUp */
function showPopup() {
        $(".lightBox").fadeIn();
        $(".bg_overlay").fadeIn();
        var modelHeight = $(".lightBox").height();
        var modelMarginTop = -modelHeight / 2;
        $(".lightBox").css("marginTop",modelMarginTop);
    };



    $(".weathersearchbutton").click(function (e) {
        showPopup1();
    });
	
	/* PopUp Window Close Button */
	$(".closebutton1").click(function (e) {
         closePopup1();
    });

/* Close PopUp */
function closePopup1() {
        $(".bg_overlay1").fadeOut();
        $(".lightBox1").fadeOut();
    };
	
/* Open PopUp */
function showPopup1() {
        $(".lightBox1").fadeIn();
        $(".bg_overlay1").fadeIn();
        var modelHeight = $(".lightBox1").height();
        var modelMarginTop = -modelHeight / 2;
        $(".lightBox1").css("marginTop",modelMarginTop);
    };

});
