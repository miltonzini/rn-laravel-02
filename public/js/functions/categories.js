console.log('Categories.js called');

function createCategory(action, method, data) {
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
    console.log("updateCategory called");
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
                    window.location.href = url + '/admin/categories/index';
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

$(document).on('submit', '#edit-category-form', function(event) {
    console.log("event");
    event.preventDefault();
    let action = $(this).attr('action'),
    method = $(this).attr('method'),
    data = new FormData(this);

    updateCategory(action, method, data);
})
