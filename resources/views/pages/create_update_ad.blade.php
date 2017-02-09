@extends('layouts.welcome')

@section('content')
<div class="col-lg-12 content">
    <div class="col-lg-10 col-lg-offset-1 text-left">
        <h1>Create new ad</h1>
    </div>
    <div class="col-lg-10 col-lg-offset-1">
        @include('elements.form.creat_update_ad')
    </div>
</div>
<script>
    $(document).ready(function () {
        var url;
        var _method;
        @if(isset($ad))
            url = '{{ route('update_ad', ['id' => $ad->id]) }}';
        _method = 'put';
        @else
            url = '{{ route('store') }}';
        @endif

        CKEDITOR.replace('description');

        $('#save').on('click', function () {
            var data = {};
            data.title = $('#title').val();
            data.description = CKEDITOR.instances.description.getData();
            ajaxRequest.sendRequest(url, data, _method);
        });
    });
</script>
@endsection