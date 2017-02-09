@extends('layouts.welcome')

@section('content')
    <div class="col-lg-12 content">
        <div class="col-lg-10 col-lg-offset-1 text-left">
            <h1>{{ $ad->title }}</h1>
        </div>
        <div class="col-lg-10 col-lg-offset-1 text-left">
            {!! $ad->description !!}
        </div>
        <div class="col-lg-10 col-lg-offset-1 text-left ad_detail">
            <div class="col-lg-6">
                <p>Author: {{ $ad->author_name }}</p>
                <p>Date: {{ $ad->created_at }}</p>
            </div>
            <div class="col-lg-6 text-right">
                @if(Auth::check() && Auth::user()->can('adPolicy', $ad))
                    <a href="{{ route('edit_ad', ['id' => $ad->id]) }}" class="btn btn-success">Update</a>
                    {{ Form::button(
                        'Delete',
                        [
                            'id' => 'remove_ad',
                            'class' => 'btn btn-warning',
                            'data-ad' => $ad->id
                        ])
                    }}
                @endif
            </div>
        </div>
    </div>
    <script>
        $(document).ready(function () {
            $('#remove_ad').on('click', function () {
                remove_ad.setUrl('{{ url('delete') }}/' + $(this).data('ad'));
                remove_ad.remove();
            });
        });
    </script>
@endsection