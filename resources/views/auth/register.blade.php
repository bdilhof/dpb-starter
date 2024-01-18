@extends("_layouts.app")

@section("main")

<form method="POST" action="{{ route('register') }}" novalidate>
    @csrf

    <div class="vstack gap-4">

        <!-- Name -->
        <div>
            <label class="form-label" for="name">{{ trans('auth.name') }}</label>
            <input class="form-control" id="name" type="text" name="name" :value="old('name')" required autofocus autocomplete="name" />

            @if ($errors->get('name'))
            <div id="validationServer03Feedback" class="invalid-feedback">
                @foreach ($errors->get('name') as $message)
                    <p>{{ $message }}</p>
                @endforeach
            </div>
            @endif
        </div>

        <!-- Email Address -->
        <div>
            <label class="form-label" for="email">{{ trans('auth.email') }}</label>
            <input class="form-control" id="email" type="email" name="email" :value="old('email')" required autofocus autocomplete="name" />

            @if ($errors->get('email'))
            <div id="validationServer03Feedback" class="invalid-feedback">
                @foreach ($errors->get('email') as $message)
                    <p>{{ $message }}</p>
                @endforeach
            </div>
            @endif
        </div>

        <!-- Password -->
        <div>
            <label class="form-label" for="password">{{ trans('auth.password') }}</label>
            <input class="form-control" id="password" type="password" name="password" :value="old('password')" required autofocus autocomplete="name" />

            @if ($errors->get('password'))
            <div id="validationServer03Feedback" class="invalid-feedback">
                @foreach ($errors->get('password') as $message)
                    <p>{{ $message }}</p>
                @endforeach
            </div>
            @endif
        </div>

        <!-- Confirm Password -->
        <div>
            <label class="form-label" for="password_confirmation">{{ trans('auth.password_confirmation') }}</label>
            <input class="form-control" id="password_confirmation" type="password" name="password_confirmation" :value="old('password_confirmatio ')" required autofocus autocomplete="name" />

            @if ($errors->get('password_confirmation'))
            <div id="validationServer03Feedback" class="invalid-feedback">
                @foreach ($errors->get('password_confirmation') as $message)
                    <p>{{ $message }}</p>
                @endforeach
            </div>
            @endif
        </div>

        <!-- Submit -->
        <div>
            <button type="submit" class="btn btn-success">
                {{ trans('auth.register') }}
            </button>
        </div>

    </div>
</form>

@endsection
