<div>
    <h1 class="help-title">{{ __('titles.login') }}</h1>
    <div class="log-page">
        @if(session('success'))
            <div class="contact-susses" style="display: block;">
                {{ session()->get('success') }}
            </div>
        @endif
        @if($error)
            <div class="contact-warn" style="display: block;">
                {{ $error }}
            </div>
        @endif
        <form class="box-form" name="user_login" method="post" wire:submit.prevent="authUser">
            @csrf
            <input type="hidden" name="prevscript" value="index.fwx">
            <div class="box-form__group">
                <div class="form-group">
                    <label class="control-label">Логин или Email <span class="text-danger">*</span></label>
                    <input class="form-control input-lg" type="text" wire:model="username" name="username" value="">
                    @error('username') <div class="pristine-error text-help">{{ $message }}</div> @enderror
                </div>
                <div class="form-group">
                    <label class="control-label">Пароль <span class="text-danger">*</span></label>
                    <input class="form-control input-lg" type="password" wire:model="password" name="password" value="">
                    @error('password') <div class="pristine-error text-help">{{ $message }}</div> @enderror
                </div>
                <div class="form-group">
                    <div class="checkbox checkbox-slider--b checkbox-slider--b-weight pull-left">
                        <input id="check" type="checkbox" wire:model="remember" value="1" name="autoenter">
                        <label for="check"><span>Запомнить меня</span>
                        </label>
                    </div>
                </div>
            </div>
            <div class="box-form__group">

                <button type="submit" name="loginbtn" class="blue-btn btn btn-primary">Вход</button>

                <div class="row m-t-15">
                    <div class="col-sm-6">
                        <a href="{{ route('user.forgotPassword') }}">Забыли пароль?</a>
                    </div>
                    <div class="col-sm-6 log-bot-text">
                        <p>У Вас еще нет аккаунта? <a href="{{ route('user.registrationPage') }}">Регистрация</a></p>
                    </div>
                </div>
            </div>
        </form>
    </div>
</div>
