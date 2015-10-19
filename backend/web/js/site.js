!(function ($) {
    "use strict";

    $(document).ready(function () {
        $('.btn-translation-save').on('click', function(event){
            event.preventDefault();
            var key = $(this).parent().parent().data('key');
            $('[data-key="' + key + '"] form').submit();
        });
    });
})(window.jQuery);