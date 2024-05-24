// console.log('Products.js called');

function createProduct(action, method, data) {
    $.ajax({
        url: action, 
        type: method,
        data: data,
        dataType: 'json',
        cache: false,
    	contentType: false,
    	processData: false,
        beforeSend: function() {
            $('#create-product-button').prop('disabled', true);
            $('#create-product-button').text('Registrando...');
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
                    $('#create-product-button').prop('disabled', false);
                    $('#create-product-button').text('Registrar producto');
                });
            });
        }
    })
}

$(document).on('submit', '#create-product-form', function(event) {
    event.preventDefault();
    let action = $(this).attr('action'),
    method = $(this).attr('method'),
    data = new FormData(this);

    createProduct(action, method, data);
})


function updateProduct(action, method, data) {
    $.ajax({
        url: action, 
        type: method,
        data: data,
        dataType: 'json',
        cache: false,
    	contentType: false,
    	processData: false,
        beforeSend: function() {
            $('#update-product-button').prop('disabled', true);
            $('#update-product-button').text('Actualizando...');
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
                    $('#update-product-button').prop('disabled', false);
                    $('#update-product-button').text('Actualizar producto');
                });
            });
        }
    })
}

$(document).on('submit', '#edit-product-form', function(event) {
    event.preventDefault();
    let action = $(this).attr('action'),
    method = $(this).attr('method'),
    data = new FormData(this);

    updateProduct(action, method, data);
})


function deleteProduct(productId) {
    $.ajax({
        url: url + '/admin/products/delete/' + productId,
        type: 'delete',
        data: null,
        dataType: 'json',
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        },
        beforeSend: function() {
            $('.delete-product-button').prop('disabled', true);
            $('.delete-product-button').text('Eliminando...');
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
                    $('.delete-product-button').prop('disabled', false);
                    $('.delete-product-button').text('Eliminar');
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
                    $('.delete-product-button').prop('disabled', false);
                    $('.delete-product-button').text('Eliminar');
                });
            });
        }
    })
}

$(document).on('click', '.delete-product-button', function() {
    let productId = $(this).attr('data-product-id');
    deleteProduct(productId);
})

function deleteProductImage(imageId) {
    $.ajax({
        url: url + '/admin/products/delete-image/' + imageId,
        type: 'delete',
        data: null,
        dataType: 'json',
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
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

$(document).on('click', '.delete-product-image-anchor', function() {
    let imageId = $(this).attr('data-product-image-id');
    deleteProductImage(imageId);
})