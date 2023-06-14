$('#registr').on('click', function () {
    $('#registration').submit(function (e) {
        e.preventDefault();
        var data = new FormData(this);

        $.ajax({
            type: 'POST',
            url: 'Form',
            data: data,
            cache: false,
            contentType: false,
            processData: false,
            success: function (response) {

                swal(
                    {title: "Отлично!", text: "Пользователь успешно зарегистрирован!", icon: "success"}
                ).then(() => {
                    location.assign('/galleryadd');
                });

            },

            error: function (response, status, error) {

                var errors = JSON.parse(response['responseText']);

                if (errors.errors) {
                    errors
                        .errors
                        .forEach(function (data, index) {
                            var field = Object.getOwnPropertyNames(data);
                            var value = data[field];
                            var div = $("#" + field[0]).closest('div');
                            div.addClass('has-danger');
                            div
                                .children('.form-control-feedback')
                                .text(value)
                        });
                }
            }
        });

    });
});

$('#authorization').on('click', function () {
    $('#registration').submit(function (e) {
        e.preventDefault();
        var data = new FormData(this);

        $.ajax({
            type: 'POST',
            url: 'Authorization',
            data: data,
            cache: false,
            contentType: false,
            processData: false,
            success: function (response) {
            
                swal({title: "Отлично!", text: "Пользователь авторизован!", icon: "success"}).then(
                    () => {
                        location.assign('/galleryadd');
                    }
                );

            },

            error: function (response, status, error) {

                var errors = JSON.parse(response['responseText']);

                if (errors.errors) {
                    errors
                        .errors
                        .forEach(function (data, index) {
                            var field = Object.getOwnPropertyNames(data);
                            var value = data[field];
                            var div = $("#" + field[0]).closest('div');
                            div.addClass('has-danger');
                            div
                                .children('.form-control-feedback')
                                .text(value)
                        });
                }
            }
        });

    });
});

$('#load').submit(function (e) {
    e.preventDefault();
    var data = new FormData(this);

    $.ajax({
        type: 'POST',
        url: 'Galleryadd/load',
        data: data,
        cache: false,
        contentType: false,
        processData: false,
        success: function (response) {
            swal({title: "Отлично!", text: "Файлы загружены!", icon: "success"}).then(
                () => {
                    location.reload();
                }
            );

        },

        error: function (response, status, error) {
            var errors = JSON.parse(response['responseText']);
            console.log(errors)
            var value = '';
            if (errors.errors) {
                errors
                    .errors
                    .forEach(function (data, index) {
                        var field = Object.getOwnPropertyNames(data);
                        value = value + data[field] + '<br>';
                        var div = $(".container");
                        div.addClass('has-danger');
                        div
                            .children('.form-control-feedback')
                            .html(value)

                    });
            }
        }
    });

});

$('#comments').submit(function (e) {
    e.preventDefault();
    var data = new FormData(this);

    $.ajax({
        type: 'POST',
        url: 'Galleryadd/setCommentsImage',
        data: data,
        cache: false,
        contentType: false,
        processData: false,
        success: function (response) {
            swal({title: "Спасибо!", text: "Ваш комментарий оставлен!", icon: "success"}).then(
                () => {
                    location.reload();
                }
            );

        },

        error: function (response, status, error) {
            var errors = JSON.parse(response['responseText']);
            var value = '';
            if (errors.errors) {
                errors
                    .errors
                    .forEach(function (data, index) {
                        var field = Object.getOwnPropertyNames(data);
                        value = value + data[field] + '<br>';
                        var div = $(".comments");
                        div.addClass('has-danger');
                        div
                            .children('.form-control-feedback')
                            .html(value)

                    });
            }
        }
    });

});

$('#commentDelete').submit(function (e) {
    e.preventDefault();
    var data = new FormData(this);

    $.ajax({
        type: 'POST',
        url: 'Galleryadd/deleteCommentsImage',
        data: data,
        cache: false,
        contentType: false,
        processData: false,
        success: function (response) {
            swal(
                {title: "Удалено!", text: "Ваш комментарий успешно удален!", icon: "success"}
            ).then(() => {
                location.reload();
            });

        },

        error: function (response, status, error) {

            var errors = JSON.parse(response['responseText']);

            if (errors.errors) {
                errors
                    .errors
                    .forEach(function (data, index) {
                        var field = Object.getOwnPropertyNames(data);
                        value = data[field] + '<br>';
                        var div = $(".commentsDelete");
                        div.addClass('has-danger');
                        div
                            .children('.form-control-feedback')
                            .html(value)

                    });
            }
        }
    });

});

document.querySelector(`#main`).onclick = function() {   
$.ajax({  
    url: 'Home/out', 
    success: function (response) {
    location.assign('/home');
    }  
})
}