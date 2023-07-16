<div>
    <h1 class="help-title">{{ __('titles.reset_password') }}</h1>
    <div class="log-page">
        @if(session()->has('success'))
            <div class="contact-susses" style="display: block;">
                {{ session('success') }}
            </div>
        @endif
        @if(session()->has('error'))
            <div class="contact-warn" style="display: block;">
                {{ session('error') }}
            </div>
        @endif
        <form class="box-form forgot" method="post" wire:submit.prevent="resetPassword">
            <div class="box-form__group">
                <p class="help-block">Пожалуйста, введите ваш email, который был указан при регистрации и мы вышлем вам логин и пароль.</p>
                <div class="form-group">
                    <div class="form-group">
                        <label class="control-label">Новый пароль<span class="text-danger">*</span></label>
                        <input class="form-control input-lg" type="password" wire:model="password" value="">
                        @error('password') <div class="pristine-error text-help">{{ $message }}</div> @enderror
                    </div>
                    <div class="form-group">
                        <label class="control-label">Повторить пароль<span class="text-danger">*</span></label>
                        <input class="form-control input-lg" type="password" wire:model="password_confirmation" value="">
                        @error('password_confirmation') <div class="pristine-error text-help">{{ $message }}</div> @enderror
                    </div>
                </div>
            </div>
            <div class="box-form__group">
                <button type="submit" class="btn btn-primary btn-lg btn-block">Отправить</button>

                <div class="row m-t-15">
                    <div class="col-sm-6">
                        <a href="{{ route('user.loginPage') }}">Вход</a>
                    </div>
                    <div class="col-sm-6 text-right">
                        <p><a href="{{ route('user.registrationPage') }}">Регистрация</a></p>
                    </div>
                </div>
            </div>
        </form>
    </div>
</div>
