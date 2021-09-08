<script>
$(document).ready(function(){
	$("#in_title").keyup(function(e){
		e.preventDefault();
		var field = $(this).parent();
		var value = $(this).val();
		$.ajax({
			cache	: false,
			type 	: "POST",
			url 	: "<?php echo $autocomplete_url;?>",
			data 	: {	q : value },
			success:function(response) {
				if(response != ""){
					$("#result").html(response).fadeIn();
					$(".link-item").click(function(e){
						e.preventDefault();
						var item_title = $(this).find("strong").html();
						var item_url = $(this).attr("data-href");
						$("#in_title").val(item_title);
						$("#in_url").val(item_url);
						$("#result").html("").fadeOut("fast");
					});	
					$(field).blur(function(){
						$("#result").html("").fadeOut("fast");
					});
				} else {
					$("#result").html("").fadeOut("fast");
				}
			}
		});
    });
	$('#menuList').nestable({maxDepth:<?php echo $number_hierarchy ?>}).on('change', function(){
		var json_values = window.JSON.stringify($(this).nestable('serialize'));
		$("#output").val(json_values);
		$("#changeHierarchy [type='submit']").fadeIn();
	});
	$("#changeHierarchy").submit(function(e){
		e.preventDefault();
		var myform = $(this);
		var btnSubmit = myform.find("[type='submit']");
		var btnSubmitHtml = btnSubmit.html();
		var url = myform.attr("action");
		var data = new FormData(this);
		$.ajax({
			beforeSend:function() { 
				btnSubmit.addClass("disabled").html("<i class='fa fa-spinner fa-pulse fa-fw'></i> Loading ... ").prop("disabled","disabled");
			},
			cache: false,
			processData: false,
			contentType: false,
			type: "POST",
			url : url,
			data : data,
			dataType:'JSON',
			success:function(response) {
                btnSubmit.removeClass("disabled").html(btnSubmitHtml);
                    let timeout = 1000;
                    if ( response.status == "success" ){
                        $.notify({icon: 'fa fa-check mr-1', message: response.message},{type: 'success'});
                        setTimeout(function(){
                            if(response.redirect == "" || response.redirect == "reload"){
                                location.reload();
                            } else if (response.redirect == "history.back()") {
                                window.history.back();
                            } else {
                                location.href = response.redirect;
                            }
                        },timeout);
                    } else {
                        $.notify({icon: 'fa fa-exclamation mr-1', message: response.message},{type: 'danger'});
                    }
			}
		});
    });
    
    $('#form-add').validate({
        validClass 		: 'is-valid',
        errorClass		: 'is-invalid',
        errorElement	: 'span',
        errorPlacement: function (error, element) {
            error.addClass('invalid-feedback');
            element.closest('.col-md-8').append(error);
        },
        highlight		: function(element, errorClass, validClass) {
            $(element).removeClass(validClass).addClass(errorClass)
            .closest('.form-group').children('label').removeClass('text-success').addClass('text-danger');
        },
        unhighlight		: function(element, errorClass, validClass) {
            $(element).removeClass(errorClass).addClass(validClass)
            .closest('.form-group').children('label').removeClass('text-danger').addClass('text-success');
        },
        submitHandler	: function(form,eve) {
            eve.preventDefault();
            var btnSubmit 		= $(form).find("[type='submit']"),
                btnSubmitHtml 	= btnSubmit.html();

            $.ajax({
                cache 		: false,
                processData : false,
                contentType : false,
                type 		: 'POST',
                url 		: '<?php echo $action_url;?>',
                data 		: new FormData(form),
                dataType	: 'JSON',
                beforeSend:function() { 
                    btnSubmit.addClass("disabled").html("<i class='fas fa-spinner fa-pulse fa-fw'></i> Loading ... ");
                },
                error 		: function(){
                    btnSubmit.removeClass("disabled").html(btnSubmitHtml);
                    $.notify({icon: 'fa fa-exclamation mr-1', message: 'Server\'s response not found'},{type: 'danger'});
                },
                success 	: function(response) {
                    btnSubmit.removeClass("disabled").html(btnSubmitHtml);
                    let timeout = 1000;
                    if ( response.status == "success" ){
                        $.notify({icon: 'fa fa-check mr-1', message: response.message},{type: 'success'});
                        setTimeout(function(){
                            if(response.redirect == "" || response.redirect == "reload"){
                                location.reload();
                            } else if (response.redirect == "history.back()") {
                                window.history.back();
                            } else {
                                location.href = response.redirect;
                            }
                        },timeout);
                    } else {
                        $.notify({icon: 'fa fa-exclamation mr-1', message: response.message},{type: 'danger'});
                    }
                }
            });
        }
    });

	$(".btn-ajax").click(function(){
		var btnSubmit 		= $(this);
		var btnSubmitHtml 	= $(this).html();
		var id 				= $(this).attr("data-id");
		var url 			= $(this).attr("data-action");
		$.ajax({
			beforeSend:function() { 
				btnSubmit.addClass("disabled").html("<i class='fa fa-spinner fa-pulse fa-fw'></i> Loading ... ").prop("disabled","disabled");
			},
			cache: false,
			type: "POST",
			url : url,
			data : {id:id},
			dataType:'JSON',
			success:function(response) {
            btnSubmit.removeClass("disabled").html(btnSubmitHtml);
                let timeout = 1000;
                if ( response.status == "success" ){
                    One.helpers('notify', {type: 'success', icon: 'fa fa-check mr-1', message: response.message});
                    setTimeout(function(){
                        if(response.redirect == "" || response.redirect == "reload"){
                            location.reload();
                        } else if (response.redirect == "history.back()") {
                            window.history.back();
                        } else {
                            location.href = response.redirect;
                        }
                    },timeout);
                } else {
                    $.notify({icon: 'fa fa-exclamation mr-1', message: response.message},{type: 'danger'});
                }
			}
		});
	});
});
</script>
<style>
#result {
	display:none;
	width:100%;
	max-height:300px;
	position:absolute;
	top:100%;
	background:#fff;
	border:1px solid #ddd;
	overflow-x:hidden;
	overflow-y: auto;
	z-index:2;
}
#result .link-item {
	padding:5px;
	cursor:pointer;
}
#result .link-item+.link-item{
	border-top:1px solid #efefef;
}
#result .link-item:hover {
	padding:5px;
	background-color:#eee;
}
#result .link-item strong {
	display:block;
}
</style>