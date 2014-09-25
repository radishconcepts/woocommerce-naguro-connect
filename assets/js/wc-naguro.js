(function ($) {
    $(window).load(function () {
        $('ul.wc-tabs a').click(function(){
           if (this.href.indexOf("woocommerce_naguro_settings") !== -1) {
                //THANKS WC!
                setTimeout(init_imgselectarea, 50);
           } else {
               $('.naguro-printable-product img').imgAreaSelect({
                   remove: true
               });
           }
        });

        $("#naguro-add-new-design-area").click(function () {
            var copy = $(".naguro-design-areas-container-ghost .naguro-design-area").clone();
            copy.appendTo($(".naguro-design-areas-container"));

            bind_image_chosen($("input[type=file]", copy));
            bind_remove_row($(".remove_row", copy));
        });

        bind_image_chosen($(".naguro-design-area input[type=file]"));
        bind_remove_row($(".naguro-design-area .remove_row"));
    });

    function bind_image_chosen(element) {
        element.on("change", readSingleFile);
    }

    function bind_remove_row(element) {
        element.click(function () {
            var root = $(this).parent();
            $('.naguro-printable-product img', root).imgAreaSelect({
                remove: true
            });
            root.remove();
        });
    }

    function init_imgselectarea() {
        $('.naguro-printable-product').each(function () {
            var obj = $(this);
            var img = obj.find("img");
            var imgWidth = img.width();
            var imgHeight = img.height();
            var printWidth = parseFloat(obj.find(".naguro_designarea_print_width").val());
            var printHeight = parseFloat(obj.find(".naguro_designarea_print_height").val());
            var left = parseFloat(obj.find(".naguro_designarea_left").val());
            var top = parseFloat(obj.find(".naguro_designarea_top").val());

            var pos = {
                x1: imgWidth * (left / 100), y1: imgHeight * (top / 100)
            };
            pos.x2 = pos.x1 + (imgWidth * (printWidth / 100));
            pos.y2 = pos.y1 + (imgHeight * (printHeight / 100));

            img.imgAreaSelect({
                handles: true,
                x1: pos.x1,
                y1: pos.y1,
                x2: pos.x2,
                y2: pos.y2,
                onSelectEnd: handleSelection
            });
        });
    }

    function handleSelection(img, selection) {
        var obj = $(img).parent();
        var printWidth = (selection.width / $(img).width()) * 100;
        var printHeight = (selection.height / $(img).height()) * 100;
        var left = (selection.x1 / $(img).width()) * 100;
        var top = (selection.y1 / $(img).height()) * 100;

        obj.find(".naguro_designarea_print_width").val(printWidth);
        obj.find(".naguro_designarea_print_height").val(printHeight);
        obj.find(".naguro_designarea_left").val(left);
        obj.find(".naguro_designarea_top").val(top);
    }

    function readSingleFile(evt) {
        //Retrieve the first (and only!) File from the FileList object
        var f = evt.target.files[0];

        if (f) {
            var r = new FileReader();
            r.onload = function(e) {
                var contents = e.target.result;

                if (f.type.substr(0, 5) === "image") {
                    placeImage(contents, evt.target.parentNode.parentNode);
                } else {
                    alert("File type is not supported, choose an image.");
                }
            };

            r.readAsDataURL(f);
        } else {
            console.log("Failed to load file");
        }
    }

    function placeImage(contents, designArea) {
        $(".naguro-printable-product img", designArea).attr("src", contents);
        init_imgselectarea();
    }
})(jQuery);