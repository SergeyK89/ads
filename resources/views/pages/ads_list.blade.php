@extends('layouts.welcome')

@section('content')
    <div class="col-lg-12 content">
        <div class="col-lg-10 col-lg-offset-1 create_btn_block">
            @if (Auth::check())
                <a class="btn btn-success" href="{{ route('create_ad') }}">Create ad</a>
            @endif
        </div>
        <div class="col-lg-10 col-lg-offset-1">
            @if(isset($ads) && !empty($ads) && $ads->count() > 0)
                @foreach($ads as $ad)
                    <div class="col-lg-12 ad_block">
                        <div class="col-lg-12 ad_head">
                            <div class="col-lg-6">
                                <h3>
                                    <a href="{{ route('show_ad', ['id' => $ad->id]) }}">
                                        {{ $ad->title }}
                                    </a>
                                </h3>
                                <p>Author: {{ $ad->author_name }}</p>
                                <p>Time: {{ $ad->created_at }}</p>
                            </div>
                            <div class="col-lg-6 text-right button_block">
                                @if(Auth::check() && Auth::user()->can('adPolicy', $ad))
                                    <a href="{{ route('edit_ad', ['id' => $ad->id]) }}" class="btn btn-success">Update</a>
                                    {{ Form::button(
                                        'Delete',
                                        [
                                            'id' => 'remove_ad_modal_btn',
                                            'class' => 'btn btn-warning',
                                            'data-toggle' => 'modal',
                                            'data-target' => '#remove_ad_modal',
                                            'data-ad' => $ad->id
                                        ])
                                    }}
                                @endif
                            </div>
                        </div>
                        <div class="col-lg-12 ad_body">
                            {!! $ad->description !!}
                        </div>
                    </div>
                @endforeach
                {{ $ads->links() }}
            @else
                <hr/>
                <p>There is no ads</p>
            @endif
        </div>
    </div>
@endsection
