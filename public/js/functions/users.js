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
                    window.location.href = url + '/';
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

function updateUser(action, method, data) {
    $.ajax({
        url: action, 
        type: method,
        data: data,
        dataType: 'json',
        cache: false,
    	contentType: false,
    	processData: false,
        beforeSend: function() {
            $('#update-user-button').prop('disabled', true);
            $('#update-user-button').text('Actualizado usuario...');
        },
        success: function(response) {
            if (response.success) {
                Swal.fire({
                    title: "Mensaje",
                    text: response.message,
                    icon: "success"
                }).then(function(){
                    window.location.href = url + '/admin/listado-usuarios';
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
                    $('#update-user-button').prop('disabled', false);
                    $('#update-user-button').text('Actualizar usuario');
                });
            });
        }
    })
}

$(document).on('submit', '#edit-user-form', function(event) {
    event.preventDefault();
    let action = $(this).attr('action'),
    method = $(this).attr('method'),
    data = new FormData(this);

    updateUser(action, method, data);
})

function deleteUser(userId) {
    $.ajax({
        url: url + '/admin/usuarios/delete/' + userId,
        type: 'delete',
        data: null,
        dataType: 'json',
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        },
        beforeSend: function() {
            $('.delete-user-button').prop('disabled', true);
            $('.delete-user-button').text('Eliminando...');
        },
        success: function(response) {
            if (response.success) {
                Swal.fire({
                    title: "Mensaje",
                    text: response.message,
                    icon: "success"
                }).then(function(){
                    location.reload();
                });
            } else {
                Swal.fire({
                    title: "Error",
                    text: response.message,
                    icon: "error"
                }).then(function() {
                    $('.delete-user-button').prop('disabled', false);
                    $('.delete-user-button').text('Eliminar');
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
                    $('.delete-user-button').prop('disabled', false);
                    $('.delete-user-button').text('Eliminar');
                });
            });
        }
    })
}

$(document).on('click', '.delete-user-button', function() {
    let userId = $(this).attr('data-user-id');
    deleteUser(userId);
})