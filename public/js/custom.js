$(document).ready(function(){
    $('[data-toggle="tooltip"]').tooltip();
    if ($('.row').hasClass('home')) {
        $('.menu').removeClass('active')
        $('#home').addClass('active')
    }
    if ($('.row').hasClass('user')) {
        $('.menu').removeClass('active')
        $('#user').addClass('active')
    }
    if ($('.row').hasClass('task')) {
        $('.menu').removeClass('active')
        $('#task').addClass('active')
    }

    $('input[name="start_time"]').on('change', function() {
        let minEndDate = $(this).val();
        let EndDate =  $('input[name="end_time"]').val()

        if ( minEndDate > EndDate || !EndDate)
            $('input[name="end_time"]').val(minEndDate)

        $('input[name="end_time"]').attr('min', minEndDate)
    })

    if ($('.notify').children().hasClass('message'))
        {
            let message = $('.message').val()
            $.alert({
                title: 'Alert!',
                content: message,
            });
        }
    $('.btn-delete').on('click', function() {
        $.confirm({
            title: 'Confirm!',
            content: 'Are you sure want to delete?',
            buttons: {
                
                confirm: function () {
                    $('#deleteForm').submit();
                },
                cancel: function () {
                },
            }
        });
    })
});
