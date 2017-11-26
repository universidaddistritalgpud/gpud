$('ul li').on('click', function() {  
    $('ul li.active').removeClass('active');
    $(this).addClass('active');    
});

$('#encrypt(formregistro)').bootstrapValidator({
    feedbackIcons: {
        validating: 'glyphicon glyphicon-refresh'
    },
    fields: {
    	encrypt(password): {
            validators: {
                identical: {
                    field: 'encrypt(confirmPassword)',
                    message: 'La contraseña y la confirmación no son iguales'
                }
            }
        },
        encrypt(confirmPassword): {
            validators: {
                identical: {
                    field: 'encrypt(password)',
                    message: 'La contraseña y la confirmación no son iguales'
                }
            }
        }
    }
});

$('#encrypt(formrestartpass)').bootstrapValidator({
    feedbackIcons: {
        validating: 'glyphicon glyphicon-refresh'
    },
    fields: {
    	encrypt(password): {
            validators: {
                identical: {
                    field: 'encrypt(confirmPassword_restart)',
                    message: 'La contraseña y la confirmación no son iguales'
                }
            }
        },
        encrypt(confirmPassword): {
            validators: {
                identical: {
                    field: 'encrypt(password_restart)',
                    message: 'La contraseña y la confirmación no son iguales'
                }
            }
        }
    }
});
		    

$( "#encrypt(boton1)" ).click(function() {
	$("#encrypt(contrasena)").val(CryptoJS.SHA1( CryptoJS.SHA1( $("#encrypt(contrasena)").val())));
});

$( "#encrypt(botonregistrar)" ).click(function() {
	$("#encrypt(password)").val(CryptoJS.SHA1( CryptoJS.SHA1( $("#encrypt(password)").val())));
	$("#encrypt(confirmPassword)").val(CryptoJS.SHA1( CryptoJS.SHA1( $("#encrypt(confirmPassword)").val())));

});

$( "#encrypt(botonrestaurarpass)" ).click(function() {
	$("#encrypt(password_restart)").val(CryptoJS.SHA1( CryptoJS.SHA1( $("#encrypt(password_restart)").val())));
	$("#encrypt(confirmPassword_restart)").val(CryptoJS.SHA1( CryptoJS.SHA1( $("#encrypt(confirmPassword_restart)").val())));
});


