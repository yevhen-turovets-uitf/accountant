<div class="contact-page">
    <h1 class="help-title">{{ __('titles.contacts') }}</h1>
    <div class="contact-page__wrap">
        <h2>Контактная информация</h2>
        @foreach($feedbackInfo as $info)
            <p>{!! $info['description'] !!} @if($info['map']) (<a href="{{ $info['map'] }}" target="_blank">Google Карты</a>) @endif</p>
        @endforeach
        <h2>Задайте вопрос</h2>
        <p>
            У Вас есть вопрос по работе с базой данных? Заполните форму и нажмите кнопку <b>Отправить</b>. Мы постараемся ответить максимально быстро.
        </p>
        @if(!$success)
            <form class="contact-page-form" wire:submit.prevent="sendForm">
                <div class="row">
                    <div class="col-sm-4">
                        <div class="form-group">
                            <label class="control-label">Ваше имя <span class="text-danger">*</span></label>
                            <input type="text" wire:model="name" value="" class="form-control">
                            @error('name') <div class="pristine-error text-help">{{ $message }}</div> @enderror
                        </div>
                    </div>
                    <div class="col-sm-4">
                        <div class="form-group">
                            <label class="control-label">E-mail <span class="text-danger">*</span></label>
                            <input type="text" wire:model="email" value="" class="form-control">
                            @error('email') <div class="pristine-error text-help">{{ $message }}</div> @enderror
                        </div>
                    </div>
                    <div class="col-sm-4">
                        <div class="form-group">
                            <label class="control-label">Телефон</label>
                            <input type="text" wire:model="phone" value="" class="form-control">
                            @error('phone') <div class="pristine-error text-help">{{ $message }}</div> @enderror
                        </div>
                    </div>
                </div>
                <div class="form-group">
                    <label class="control-label">Ваше сообщение (вопрос)</label>
                    <textarea class="form-control" wire:model="description" rows="6"></textarea>
                    @error('description') <div class="pristine-error text-help">{{ $message }}</div> @enderror
                </div>

                <div class="b-well__actions">
                    <button type="submit" class="btn btn-primary">Отправить</button>
                </div>
            </form>
        @else
            <div class="contact-susses">
                Спасибо! Ваше сообщение отправлено.
            </div>
        @endif
    </div>
</div>
