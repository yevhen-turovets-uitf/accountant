<div>
    <div class="title">{{ __('titles.edit_password') }}</div>
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
        <form method="POST" class="profile__form" wire:submit.prevent="editPassword">
            <input type="hidden" name="_method" value="PATCH">
            <div class="profile__section__line">
                <div class="profile__sec__title">ПАРОЛЬ</div>
                <div class="row">
                    <div class="col-md-4">
                        <label>СТАРЫЙ ПАРОЛЬ</label>
                        <input type="hidden" name="id" value="1">
                        <input type="password" value="" class="form-control" placeholder="старый пароль" wire:model="old_password">
                        @error('old_password') <div class="pristine-error text-help">{{ $message }}</div> @enderror
                    </div>
                    <div class="col-md-4">
                        <label>Новый пароль</label>
                        <input id="password" type="password" class="form-control " wire:model="password" placeholder="новый пароль" autocomplete="current-password">
                        @error('password') <div class="pristine-error text-help">{{ $message }}</div> @enderror
                    </div>
                    <div class="col-md-4">
                        <label>Повтор пароля</label>
                        <input id="password" type="password" class="form-control " placeholder="новый пароль повторно" wire:model="password_confirmation" autocomplete="current-password">
                        @error('password_confirmation') <div class="pristine-error text-help">{{ $message }}</div> @enderror
                    </div>
                </div>
                <button type="submit">Сохранить</button>
                <button type="reset">Отменить</button>
            </div>
        </form>
    </div>
</div>
