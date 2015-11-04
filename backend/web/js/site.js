!(function ($) {
    "use strict";

    $(document).ready(function () {
        $('.btn-translation-save').on('click', function(event){
            event.preventDefault();
            var key = $(this).parent().parent().data('key');
            $('[data-key="' + key + '"] form').submit();
        });

        /*TODO: extract to LanguageTabs Widget*/
        $('.language-tabs li a').on('click', function(event){
            //if the event was trigger by mouse click
            if (event.hasOwnProperty('originalEvent')){
                // Select only the first class of the element
                var languageClass = $(this).attr('class').split(' ')[0];
                $('a.' + languageClass).click();
            }
        });
    });
})(window.jQuery);