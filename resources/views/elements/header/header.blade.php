<div class="col-lg-12 header">
    <div class="col-lg-6">
        <h1 class="logo"><a href="{{ route('home') }}">Logo</a></h1>
    </div>
    <div class="col-lg-6 text-right">
        @if (Auth::check())
            <p>
                Hello, {{ Auth::user()->username }}
            </p>
        @endif
        @if (Auth::check())
            {{ Form::button(
                'logout',
                [
                    'id' => 'logout',
                    'class' => 'btn btn-default',
                ])
            }}
        @else
            {{ Form::button(
                'sing in/sign up',
                [
                    'id' => 'sign_in_modal_btn',
                    'class' => 'btn btn-default',
                    'data-toggle' => 'modal',
                    'data-target' => '#sign_in_modal'
                ])
            }}
        @endif
    </div>
</div>
