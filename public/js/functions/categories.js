// console.log('Categories.js called');

function createCategory(action, method, data) {
    $.ajax({
        url: action, 
        type: method,
        data: data,
        dataType: 'json',
        cache: false,
    	contentType: false,
    	processData: false,
        beforeSend: function() {
            $('#create-category-button').prop('disabled', true);
            $('#create-category-button').text('Registrando...');
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
            }
        },
        error: function(xhr) {
            $.each(xhr.responseJSON.errors, function(index, value) {
                Swal.fire({
                    title: "Error",
                    text: value,
                    icon: "warning"
                }).then(function() {
                    $('#create-category-button').prop('disabled', false);
                    $('#create-category-button').text('Registrar');
                });
            });
        }
    })
}

$(document).on('submit', '#create-category-form', function(event) {
    event.preventDefault();
    let action = $(this).attr('action'),
    method = $(this).attr('method'),
    data = new FormData(this);

    createCategory(action, method, data);
})



function updateCategory(action, method, data) {
    $.ajax({
        url: action, 
        type: method,
        data: data,
        dataType: 'json',
        cache: false,
    	contentType: false,
    	processData: false,
        beforeSend: function() {
            $('#update-category-button').prop('disabled', true);
            $('#update-category-button').text('Actualizando...');
        },
        success: function(response) {
            if (response.success) {
                Swal.fire({
                    title: "Mensaje",
                    text: response.message,
                    icon: "success"
                }).then(function(){
                    window.location.href = url + '/admin/listado-categorias';
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
                    $('#update-category-button').prop('disabled', false);
                    $('#update-category-button').text('Actualizar categoría');
                });
            });
        }
    })
}

$(document).on('submit', '#edit-category-form', function(event) {
    event.preventDefault();
    let action = $(this).attr('action'),
    method = $(this).attr('method'),
    data = new FormData(this);

    updateCategory(action, method, data);
})


function deleteCategory(categoryId) {
    $.ajax({
        url: url + '/admin/categorias/delete/' + categoryId,
        type: 'delete',
        data: null,
        dataType: 'json',
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        },
        beforeSend: function() {
            $('.delete-category-button').prop('disabled', true);
            $('.delete-category-button').text('Eliminando...');
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
                    $('.delete-category-button').prop('disabled', false);
                    $('.delete-category-button').text('Eliminar');
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
            }).then(function() {
                $('.delete-category-button').prop('disabled', false);
                $('.delete-category-button').text('Eliminar');
            });
        }
    })
}

$(document).on('click', '.delete-category-button', function() {
    let categoryId = $(this).attr('data-category-id');
    deleteCategory(categoryId);
})