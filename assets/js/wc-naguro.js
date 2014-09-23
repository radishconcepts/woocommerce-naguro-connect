(function ($) {
    $(window).load(function () {
        $('ul.wc-tabs a').click(function(){
           if (this.href.indexOf("woocommerce_naguro_settings") !== -1) {
                //THANKS WC!
                setTimeout(init_imgselectarea, 50);
           }
        });
    });

    function init_imgselectarea() {
        $('.naguro-printable-product').each(function () {
            var obj = $(this);
            var img = obj.find("img");
            var imgWidth = img.width();
            var imgHeight = img.height();


            img.imgAreaSelect({
                handles: true
            });
        });
    }
})(jQuery);