<div>
    <h1 class="title">{{ __('titles.personal') }}</h1>

    <div class="profile__top container-fluid">
        <div class="row">
            <div class="col-xl-3 col-md-4 col-12">
                <div class="profile__top1">Информация об открытом доступе</div>
                <div class="profile__top2">ID: <b>{{ $userInfo->id }}</b></div>
                @if($userInfo->isActiveStatus())
                    <div class="profile__top2">Статус: <b>Есть доступ</b></div>
                    <div class="profile__top2">Активый до: <b>{{ $userInfo->date_to->format('d.m.Y H:i:s') }}</b></div>
                @else
                    <div class="profile__top2">Статус: <b>Нет доступа</b></div>
                @endif
            </div>
            <div class="col-xl-3 col-md-4 col-12">
                <div class="profile__top1">Информация о договоре</div>
                <div class="profile__top2">Номер договора: №<b>{{ $userInfo->number_contract ?: ' -' }}</b></div>
                <div class="profile__top2">Действует с: <b>{{ $userInfo->date_from ? $userInfo->date_from->format('d.m.Y H:i:s') : '-' }}</b></div>
                <div class="profile__top2">Действует до: <b>{{ $userInfo->date_from ? $userInfo->date_to->format('d.m.Y H:i:s') : '-' }}</b></div>
            </div>
        </div>
    </div>

    <div class="profile__section">
        @if (session()->has('success'))
            <div class="contact-susses" style="display: block;">
                {{ session('success') }}
            </div>
        @endif
        @if (session()->has('error'))
            <div class="contact-warn" style="display: block;">
                {{ session('error') }}
            </div>
        @endif
        <form class="profile__form" wire:submit.prevent="editUser">
            <div class="profile__section__line">
                <div class="profile__sec__title">ПЕРСОНАЛЬНАЯ ИНФОРМАЦИЯ</div>
                <div class="row justify-content-center">
                    <div class="col-md-4">
                        <label>Имя</label>
                        <input value="{{ $userInfo->name }}" placeholder="Имя" wire:model="name" class="">
                        @error('name') <div class="pristine-error text-help">{{ $message }}</div> @enderror
                        <label>Фамилия</label>
                        <input value="{{ $userInfo->surname }}" placeholder="Фамилия" wire:model="surname">
                        @error('surname') <div class="pristine-error text-help">{{ $message }}</div> @enderror
                    </div>
                    <div class="col-md-4">
                        <label class="email-triger">E-mail
                            <i class="fas fa-info-circle"></i>
                            <div class="email-triger-info">Электронный адрес редактирует администрация сайта</div>
                        </label>
                        <input value="{{ $userInfo->email }}" disabled="">
                        <label>Телефон</label>
                        <input value="{{ $userInfo->phone }}" placeholder="Моб. телефон" wire:model="phone">
                        @error('phone') <div class="pristine-error text-help">{{ $message }}</div> @enderror
                    </div>
                </div>
            </div>

            <div class="profile__section__line">
                <div class="profile__sec__title">ДОПОЛНИТЕЛЬНАЯ ИНФОРМАЦИЯ</div>
                <div class="row">
                    <div class="col-md-4">
                        <label>УЧЕТНАЯ ЗАПИСЬ</label>
                        <select class="form-select form-select-sm" aria-label=".form-select-sm example" wire:model="is_entity" wire:change="setIsEntity($event.target.value)">
                            <option value="0">Физ. лицо</option>
                            <option value="1">Юр. лицо</option>
                        </select>
                        @error('is_entity') <div class="pristine-error text-help">{{ $message }}</div> @enderror
                    </div>

                    @if($is_entity == 0)
                        <div class="col-md-4">
                            <label>ИНН</label>
                            <input wire:model="inn" value="{{ $userInfo->inn }}">
                            @error('inn') <div class="pristine-error text-help">{{ $message }}</div> @enderror
                        </div>
                    @else
                        <div class="col-md-4">
                            <label>НАИМЕНОВАНИЕ</label>
                            <input wire:model="company_name" value="{{ $userInfo->company_name }}">
                            @error('company_name') <div class="pristine-error text-help">{{ $message }}</div> @enderror
                        </div>
                        <div class="col-md-4">
                            <label>ИНДЕТИФИКАЦИОННЫЙ КОД</label>
                            <input wire:model="company_inn" value="{{ $userInfo->company_inn }}">
                            @error('company_inn') <div class="pristine-error text-help">{{ $message }}</div> @enderror
                        </div>
                        <div class="col-md-4">
                            <label>Адрес</label>
                            <input wire:model="company_address" value="{{ $userInfo->company_address }}">
                            @error('company_address') <div class="pristine-error text-help">{{ $message }}</div> @enderror
                        </div>
                    @endif
                </div>
                <button type="submit">Сохранить</button>
                <button type="button">Отменить</button>
            </div>
            <div class="form-row text-center">
                <div class="col-12">
                    <a href="{{ route('user.editPasswordPage') }}" class="btn btn-outline-secondary btn-sm text-center">Смена пароля <i class="fas fa-key"></i></a>
                </div>
            </div>
        </form>
    </div>
</div>
