$('ul li').on('click', function() {  
    $('ul li.active').removeClass('active');
    $(this).addClass('active');    
});

$('#formregistro').bootstrapValidator({
    feedbackIcons: {
        validating: 'glyphicon glyphicon-refresh'
    },
    fields: {
        password: {
            validators: {
                identical: {
                    field: 'confirmPassword',
                    message: 'La contraseña y la confirmación no son iguales'
                }
            }
        },
        confirmPassword: {
            validators: {
                identical: {
                    field: 'password',
                    message: 'La contraseña y la confirmación no son iguales'
                }
            }
        }
    }
});
		    
