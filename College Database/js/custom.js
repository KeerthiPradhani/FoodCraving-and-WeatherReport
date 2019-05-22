$(document).ready(function () {
	
	/*Button Click Action */
	$(".add").click(function (e) {
        showPopup1();
    });

    $(".update").click(function (e) {
        showPopup2();
    });
	
	/* PopUp Window Close Button */

	$(".close1").click(function (e) {
        closePopup1();
   });

   $(".close2").click(function (e) {
    closePopup2();
});

    /* Close PopUp */

    function closePopup1() {
        $(".bg_overlay1").fadeOut();
        $(".lightBox1").fadeOut();
    };
        
    function closePopup2() {
        $(".bg_overlay2").fadeOut();
        $(".lightBox2").fadeOut();
    };

    /* Open PopUp */
    
    function showPopup1() {
        $(".lightBox1").fadeIn();
        $(".bg_overlay1").fadeIn();
        var modelHeight = $(".lightBox1").height();
        var modelMarginTop = -modelHeight / 2;
        $(".lightBox1").css("marginTop",modelMarginTop);
    };

    function showPopup2() {
            $(".lightBox2").fadeIn();
            $(".bg_overlay2").fadeIn();
            var modelHeight = $(".lightBox2").height();
            var modelMarginTop = -modelHeight / 2;
            $(".lightBox2").css("marginTop",modelMarginTop);
        };

});
