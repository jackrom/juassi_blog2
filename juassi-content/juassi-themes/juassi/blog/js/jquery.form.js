jQuery(function($) {

    $('#contact-form input#submit').click(function() {
        $('#contact-form .button-wrapper').append('<img src="images/preloader-small.gif" class="loaderIcon" alt="Loading..." />');

        var name = $('input#name').val();
        var email = $('input#email').val();
        var subject = $('input#subject').val();
        var comments = $('textarea#comments').val();

        $.ajax({
            type: 'post',
            url: 'sendEmail.php',
            data: 'name=' + name + '&email=' + email + '&subject=' + subject + '&comments=' + comments,

            success: function(results) {
                $('#contact-form img.loaderIcon').fadeOut(1000);
                $('#response').html(results);
            }
        }); // end ajax
    });
});
		