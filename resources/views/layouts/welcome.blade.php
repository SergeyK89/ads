<!DOCTYPE html>
<html lang="en">
<head>
    @include('elements.head.meta')
    @include('elements.head.link')
    @include('elements.head.script')
</head>
<body>
    <div class="container">
        @include('elements.header.header')
        @yield('content')
        @include('elements.footer.footer')
        @include('elements.modal.sign_in')
        @include('elements.modal.remove_ad')
    </div>
    <script>
        $(document).ready(function(){

            $('#remove_ad_modal_btn').on('click', function (e) {
                var target_button = $(e.target);
                remove_ad.setUrl('{{ url('delete') }}/'+target_button.data('ad'));
            });
            $('#remove_ad_btn').on('click', function () {
                remove_ad.remove();
            });

            $('#sign_in').on('click', function () {
                var url = '{{ route('login') }}';
                var data = {};
                data.username = $('#sign_in_modal #username').val();
                data.password = $('#sign_in_modal #password').val();
                ajaxRequest.successCallback = function (response) {
                    if (response.error == false) {
                        location.href = response.response.redirect;
                    } else {
                        if (response.error_code == 1) {
                            $('#username').parent().addClass('has-error');
                            $('.username_error').text(response.error_desc);
                            $('#username').on('change', function(){
                                $('#username').parent().removeClass('has-error');
                                $('.username_error').text('');
                            });
                        }
                    }
                };
                ajaxRequest.sendRequest(url, data);
            });
            $('#logout').on('click', function () {
                var url  = '{{ route('logout') }}';
                ajaxRequest.sendRequest(url);
            });
        });
    </script>
</body>
</html>
