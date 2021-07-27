<script>
$(function() {
    'use strict'
    $(document).ready(function(){
        $('form#form-contact').validate({
            validClass      : 'is-valid',
            errorClass      : 'is-invalid',
            errorElement    : 'span',
            errorPlacement: function (error, element) {
                error.addClass('invalid-feedback');
                element.closest('.form-group').find('.col-sm-9').append(error);
            },
            highlight       : function(element, errorClass, validClass) {
                $(element).removeClass(validClass).addClass(errorClass)
                .closest('.form-group').children('label').removeClass('text-success').addClass('text-danger');
            },
            unhighlight     : function(element, errorClass, validClass) {
                $(element).removeClass(errorClass).addClass(validClass)
                .closest('.form-group').children('label').removeClass('text-danger').addClass('text-success');
            },
            submitHandler   : function(form,eve) {
                eve.preventDefault();
                var btnSubmit       = $(form).find("[type='submit']"),
                    btnSubmitHtml   = btnSubmit.html();

                $.ajax({
                    cache       : false,
                    processData : false,
                    contentType : false,
                    type        : 'POST',
                    url         : $(form).attr('action'),
                    data        : new FormData(form),
                    dataType    : 'JSON',
                    beforeSend:function() { 
                        btnSubmit.addClass("disabled").html("<i class='fas fa-spinner fa-pulse fa-fw'></i> Loading ... ");
                    },
                    error       : function(response){
                        btnSubmit.removeClass("disabled").html(btnSubmitHtml);
                        let alertHtml = '<div class="alert alert-danger alert-dismissible fade show" role="alert">'+ response.responseJSON.message +'<button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button></div>';
                        $('#response').html(alertHtml);
                    },
                    success     : function(response) {
                        btnSubmit.removeClass("disabled").html(btnSubmitHtml);
                        let alertHtml = '<div class="alert alert-success alert-dismissible fade show" role="alert">'+ response.message +'<button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button></div>';
                        $('#response').html(alertHtml);
                        setTimeout(function(){
                            location.reload();
                        },1000);
                    }
                });
            }
        });
    });
});
</script>