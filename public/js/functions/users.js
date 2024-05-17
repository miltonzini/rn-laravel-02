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
        success: function (response) {
            if (response.success) {
                window.location.href = url + '/admin'
            } else {
                Swal.fire({
                    title: 'Error',
                    text: response.message,
                    icon: 'warning'
                })
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
