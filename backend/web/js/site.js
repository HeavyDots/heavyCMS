!(function ($) {
    "use strict";

    $(document).ready(function () {
        $('.translate-message-form').on('submit', function(event){
        event.preventDefault();
        var form = $(this);

        $.ajax({
               type: "POST",
               url: form.attr('action'),
               data: form.serialize(), // serializes the form's elements.
               form: form,
               success: function(data)
               {
                   debugger;
                   this.form.find('.btn-success').html(data);
                   this.form.find('.btn-success').removeClass('btn-success').addClass('btn-primary')
               },
               error: function(data)
               {
                   debugger;
               }
             });
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