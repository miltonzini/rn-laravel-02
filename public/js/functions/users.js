// console.log('Users.js called');

function loginUser(action, method, data) {
    $.ajax({
        url: action,
        type: method,
        data: data,
        dataType: 'json',
        cache: false,
        contentType: false,
        processData: false,
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }, 
        beforeSend: function() {
            $('#login-button').prop('disabled', true);
            $('#login-button').text('Iniciando sesión...');
        },
        success: function (response) {
            if (response.success) {
                window.location.href = url + '/admin'
            } else {
                Swal.fire({
                    title: 'Error',
                    text: response.message,
                    icon: 'warning'
                }).then(function() {
                    $('#login-button').prop('disabled', false);
                    $('#login-button').text('Registrar');
                });
            }
        }
    })
}
$(document).on('submit', '#user-login-form', function (event) {
    event.preventDefault();

    let action = $(this).attr('action'),
    method = $(this).attr('method'),
    data = new FormData(this);

    loginUser(action, method, data);
})



function createUser(action, method, data) {
    $.ajax({
        url: action, 
        type: method,
        data: data,
        dataType: 'json',
        cache: false,
    	contentType: false,
    	processData: false,
        beforeSend: function() {
            $('#register-button').prop('disabled', true);
            $('#register-button').text('Registrando...');
        },
        success: function(response) {
            if (response.success) {
                Swal.fire({
                    title: "Mensaje",
                    text: response.message,
                    icon: "success"
                }).then(function(){
                    window.location.href = url + '/login';
                });
            }
        },
        error: function(xhr) {
            $.each(xhr.responseJSON.errors, function(index, value) {
                Swal.fire({
                    title: "Error",
                    text: value,
                    icon: "warning"
                }).then(function() {
                    $('#register-button').prop('disabled', false);
                    $('#register-button').text('Registrarme');
                });
            });
        }
    })
}

$(document).on('submit', '#register-form', function(event) {
    event.preventDefault();
    let action = $(this).attr('action'),
    method = $(this).attr('method'),
    data = new FormData(this);

    createUser(action, method, data);
})
