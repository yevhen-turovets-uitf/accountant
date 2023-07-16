<div class="container-fluid">
    <div class="row">
        <div class="col-xl-6 col-lg-5">
            <ul class="top-line__menu nav">
                <li><a href="{{ route('help') }}">Помощь</a></li>
                <li><a href="{{ route('contacts') }}">Контакты</a></li>
            </ul>
        </div>
        <div class="col-xl-3 col-4 ">
            <div class="spravka ">
                <div>Справка - </div>
                <div>
                    <a href="tel:0713301683">071 330 16 83</a>
                </div>
            </div>
        </div>
        <div class="col-xl-3 col-3">
            <div class="top-line__help ">
                <a href="mailto:testemail@gmail.com ">testemail@gmail.com</a>
                <form action="{{ route('contacts') }}">
                    <button type="button " class="btn btn-primary ">Задать вопрос</button>
                </form>
            </div>
        </div>
    </div>
</div>
