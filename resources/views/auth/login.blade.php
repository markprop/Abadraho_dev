@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">{{ __('Login') }}
                    <div class="tab-bar mt-2" style="text-align: center; background: #000; padding: 5px;">
                        <button class="tab btn btn-sm @if(!session('user_type') || session('user_type') == 'buyer') btn-primary @else btn-secondary @endif" data-type="buyer">Buyer</button>
                        <button class="tab btn btn-sm @if(session('user_type') == 'agent') btn-primary @else btn-secondary @endif" data-type="agent">Agent</button>
                    </div>
                    @if(session('user_type') == 'agent')
                        <div class="mt-2 text-center">
                            <small class="text-muted">Agents: Use your email and password provided by admin to login as a regular user</small>
                        </div>
                    @endif
                </div>

                <div class="card-body">
                    <form method="POST" action="{{ route('login') }}">
                        @csrf

                        <div class="form-group row">
                            <label for="email" class="col-md-4 col-form-label text-md-right">{{ __('E-Mail Address') }}</label>

                            <div class="col-md-6">
                                <input id="email" type="email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" required autocomplete="email" autofocus>

                                @error('email')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="password" class="col-md-4 col-form-label text-md-right">{{ __('Password') }}</label>

                            <div class="col-md-6">
                                <input id="password" type="password" class="form-control @error('password') is-invalid @enderror" name="password" required autocomplete="current-password">

                                @error('password')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="form-group row">
                            <div class="col-md-6 offset-md-4">
                                <div class="form-check">
                                    <input class="form-check-input" type="checkbox" name="remember" id="remember" {{ old('remember') ? 'checked' : '' }}>

                                    <label class="form-check-label" for="remember">
                                        {{ __('Remember Me') }}
                                    </label>
                                </div>
                            </div>
                        </div>

                        <div class="form-group row mb-0">
                            <div class="col-md-8 offset-md-4">
                                <button type="submit" class="btn btn-primary">
                                    {{ __('Login') }}
                                </button>

                                @if (Route::has('password.request'))
                                    <a class="btn btn-link" href="{{ route('password.request') }}">
                                        {{ __('Forgot Your Password?') }}
                                    </a>
                                @endif
                            </div>
                        </div>
                    </form>
                    <div class="mt-4">
                        <p class="text-center">Don't have an account? <a href="{{ route('admin.register') }}">Register</a></p>
                        <p class="text-center"><a href="/">← Back to Home</a></p>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<script>
    document.addEventListener('DOMContentLoaded', function() {
        const tabs = document.querySelectorAll('.tab');
        tabs.forEach(tab => {
            tab.addEventListener('click', function() {
                tabs.forEach(t => t.classList.remove('btn-primary', 'btn-secondary'));
                this.classList.add('btn-primary');
                const type = this.getAttribute('data-type');
                sessionStorage.setItem('user_type', type);
                window.location.href = "{{ route('admin.login') }}?type=" + type;
            });
        });

        // Set initial tab based on URL parameter or session
        const urlParams = new URLSearchParams(window.location.search);
        const type = urlParams.get('type') || sessionStorage.getItem('user_type') || 'buyer';
        const activeTab = document.querySelector(`.tab[data-type="${type}"]`);
        if (activeTab) {
            tabs.forEach(t => t.classList.remove('btn-primary', 'btn-secondary'));
            activeTab.classList.add('btn-primary');
            sessionStorage.setItem('user_type', type);
        }
    });
</script>
@endsection