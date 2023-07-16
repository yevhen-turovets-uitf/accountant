<div>
    <h1 class="help-title">{{ __('titles.forgot_password') }}</h1>
    <div class="log-page">
        @if(session()->has('success'))
            <div class="contact-susses" style="display: block;">
                {{ session('success') }}
            </div>
        @endif
        <form class="box-form forgot" id="forgot" method="post" wire:submit.prevent="sendForgotPasswordLink">
            <div class="box-form__group">
                <p class="help-block">Пожалуйста, введите ваш email, который был указан при регистрации и мы вышлем вам логин и пароль.</p>
                <div class="form-group">
                    <input type="hidden" name="step" value="2">
                    <label class="control-label">E-mail<span class="text-danger">*</span></label>
                    <input class="form-control input-lg" type="text" wire:model="userName" value="">
                    @error('userName') <div class="pristine-error text-help">{{ $message }}</div> @enderror
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
