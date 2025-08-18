@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">{{ __('Register') }}
                    <div class="tab-bar mt-2" style="text-align: center; background: #000; padding: 5px;">
                        <button class="tab btn btn-sm @if(session('user_type') == 'buyer' || !session('user_type')) btn-primary @else btn-secondary @endif" data-type="buyer">Buyer</button>
                        <button class="tab btn btn-sm @if(session('user_type') == 'agent') btn-primary @else btn-secondary @endif" data-type="agent">Agent</button>
                    </div>
                </div>

                <div class="card-body">
                    <form method="POST" action="{{ route('admin.register') }}">
                        @csrf
                        <input type="hidden" name="user_type" value="{{ session('user_type') ?: 'buyer' }}">

                        <div class="form-group row">
                            <label for="name" class="col-md-4 col-form-label text-md-right">{{ __('Name') }}</label>

                            <div class="col-md-6">
                                <input id="name" type="text" class="form-control @error('name') is-invalid @enderror" name="name" value="{{ old('name') }}" required autocomplete="name" autofocus>

                                @error('name')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="email" class="col-md-4 col-form-label text-md-right">{{ __('E-Mail Address') }}</label>

                            <div class="col-md-6">
                                <input id="email" type="email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" required autocomplete="email">

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
                                <input id="password" type="password" class="form-control @error('password') is-invalid @enderror" name="password" required autocomplete="new-password">

                                @error('password')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="password-confirm" class="col-md-4 col-form-label text-md-right">{{ __('Confirm Password') }}</label>

                            <div class="col-md-6">
                                <input id="password-confirm" type="password" class="form-control" name="password_confirmation" required autocomplete="new-password">
                            </div>
                        </div>

                        <div class="form-group row mb-0">
                            <div class="col-md-6 offset-md-4">
                                <button type="submit" class="btn btn-primary">
                                    {{ __('Register') }}
                                </button>
                            </div>
                        </div>
                    </form>
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
                window.location.href = "{{ route('admin.register') }}?type=" + type;
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