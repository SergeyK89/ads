var ajaxRequest = {
    successCallback: function(response) {
        if (response.error == false) {
            location.href = response.response.redirect;
        }
    },
    errorCallback: function(xhr) {
        if (xhr.status == 422) {
            $.each(xhr.responseJSON, function(e) {
                $('#'+e).parent().addClass('has-error');
                $('.'+e+'_error').text(xhr.responseJSON[e][0]);
                $('#'+e).on('change', function(){
                    $('#'+e).parent().removeClass('has-error');
                    $('.'+e+'_error').text('');
                });
            });
        }
    },
    sendRequest: function(url, data, method) {
        var that = this;
        if (data == undefined || data == null || data == '') {
            data = {};
        }
        if (method != undefined && data != null && data != '') {
            data._method = method;
        }
        $.ajax({
            url: url,
            method: 'post',
            data: data,
            dataType: 'json',
            success: function(response) {
                that.successCallback(response);
            },
            error: function (xhr) {
                that.errorCallback(xhr);
            }
        });
    }
};

var remove_ad = {
    url: null,
    setUrl: function (url) {
        this.url = url;
    },
    remove: function () {
        ajaxRequest.sendRequest(this.url, null, 'delete');
    }
};