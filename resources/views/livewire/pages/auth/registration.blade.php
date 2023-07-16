<div>
    <h1 class="help-title">{{ __('titles.registration') }}</h1>
    <p class="cabinet-text">Пожалуйста, заполните необходимые поля. Если у вас уже есть аккаунт, <a href="{{ route('user.loginPage') }}">войдите</a>.</p>
    <div class="log-page">
        <form class="box-form js-validate reg" method="post" id="user_reg" wire:submit.prevent="registrationUser">
            <div class="box-form__group">
                <div class="row">
                    <div class="col-sm-6">
                        <div class="form-group">
                            <label class="control-label">Имя <span class="text-danger">*</span></label>
                            <input class="form-control" type="text" wire:model="name" value="">
                            @error('name') <div class="pristine-error text-help">{{ $message }}</div> @enderror
                        </div>
                    </div>
                    <div class="col-sm-6">
                        <div class="form-group">
                            <label class="control-label">Фамилия <span class="text-danger">*</span></label>
                            <input class="form-control" type="text" wire:model="surname" value="">
                            @error('surname') <div class="pristine-error text-help">{{ $message }}</div> @enderror
                        </div>
                    </div>
                </div>
                <div class="form-group">
                    <label class="control-label">E-mail (будет использован как Логин) <span class="text-danger">*</span></label>
                    <input class="form-control" type="text" wire:model="email" value="">
                    @error('email') <div class="pristine-error text-help">{{ $message }}</div> @enderror
                    <p class="help-block">При необходимости вместо e-mail Вы можете использовать Логин, указанный в личном кабинете</p>
                </div>
                <div class="form-group pwd-container">
                    <label class="control-label">Пароль <span class="text-danger">*</span></label>
                    <input class="form-control" type="password" wire:model="password" value="">
                    @error('password') <div class="pristine-error text-help">{{ $message }}</div> @enderror
                    <div class="pwd-container__progress"></div>
                    <div class="pwd-container__info">
                        <p class="help-block pwd-container__text">Длина пароля должна быть минимум 8 символов.</p>
                        <span class="pwd-container__verdict"></span>
                    </div>
                </div>
                <div class="checkbox">
                    <input class="slideCheckbox" type="checkbox" id="checkbox2" wire:model="is_entity" value="1">
                    <label for="checkbox2"><span>Я регистрируюсь как юридическое лицо</span></label>
                </div>
                <div class="js-usertype" style="display: @if (!$is_entity) none @endif">
                    <div class="row">
                        <div class="col-sm-6">
                            <div class="form-group">
                                <label class="control-label">Название компании</label>
                                <input class="form-control" type="text" wire:model="company_name" value="">
                                @error('company_name') <div class="pristine-error text-help">{{ $message }}</div> @enderror
                            </div>
                        </div>
                        <div class="col-sm-6">
                            <div class="form-group">
                                <label class="control-label">Телефон компании</label>
                                <input class="form-control" type="text" wire:model="company_phone" value="">
                                @error('company_phone') <div class="pristine-error text-help">{{ $message }}</div> @enderror
                            </div>
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="control-label">Адрес компании</label>
                        <input class="form-control" type="text" wire:model="company_address" value="">
                        @error('company_address') <div class="pristine-error text-help">{{ $message }}</div> @enderror
                    </div>
                    <div class="row">
                        <div class="col-sm-6">
                            <div class="form-group">
                                <label class="control-label">ИНН компании</label>
                                <input class="form-control" type="text" wire:model="company_inn" value="">
                                @error('company_inn') <div class="pristine-error text-help">{{ $message }}</div> @enderror
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="box-form__group">
                <div class="form-group">
                    <div class="checkbox">
                        <input type="checkbox" wire:model="license" id="checkbox1" value="1">
                        <label for="checkbox1"><span>Я прочёл(а) <a href="/license-agreement.fwx" target="_blank">Лицензионное соглашение</a> и согласен(а) с ним.</span></label>
                        @error('license') <div class="pristine-error text-help">{{ $message }}</div> @enderror
                    </div>
                </div>
            </div>
            <div class="box-form__group">
                <div class="row">
                    <div class="col-sm-4">
                        <button class="btn btn-primary btn-lg" type="submit">Регистрация</button>
                    </div>
                    <div class="col-sm-8 log-bot-text">
                        <p>Уже есть аккаунт?<br><a href="{{ route('user.loginPage') }}">Войдите</a></p>
                    </div>
                </div>
            </div>
        </form>
    </div>
</div>
