@extends("_layouts.guest")

@section("main")
    <div class="h-100 w-100">
        <div class="d-flex w-100 h-100 justify-content-center align-items-center">
            <div>

                <!-- Title -->
                <div class="mb-4 text-center">
                    <h1 class="h3">{{ config('app.name') }}</h1>
                </div>

                <div class="bg-white p-4">

                    <x-auth-session-status class="mb-4" :status="session('status')" />

                    <form method="POST" action="{{ route('login') }}" novalidate>
                        @csrf

                        <div class="mb-3">
                            <label id="login" for="login" class="form-label">{{ trans("auth.personal_number") }}</label>
                            <input @class(['form-control', 'is-invalid' => $errors->get('login')]) type="text" name="login" :value="old('login')" required autofocus autocomplete="username" />
                            @error('login')
                                <span class="invalid-feedback" role="alert">
                                {{ $message }}
                                </span>
                            @enderror
                        </div>

                        <div class="mb-3">
                            <label for="password" class="form-label">{{ trans("auth.password") }}</label>
                            <input id="password" @class(['form-control', 'is-invalid' => $errors->get('password')]) type="password" name="password" required autocomplete="current-password" />
                            @error('password')
                                <span class="invalid-feedback" role="alert">
                                    {{ $message }}
                                </span>
                            @enderror
                        </div>

                        <!-- Remember Me -->
                        <div class="mb-3 form-check">
                            <input class="form-check-input" type="checkbox" id="remember_me" name="remember">
                            <label class="form-check-label" for="remember_me">
                                {{ trans('auth.remember_me') }}
                            </label>
                        </div>

                        <button type="submit" class="btn btn-block w-100 btn-primary">{{ trans('auth.login') }}</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection
