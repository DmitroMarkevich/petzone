@extends('layouts.app')

@section('app-content')
    <div class="hero-container">
        <div class="hero-text">
            <h1 class="hero-title">Місце, де ваші улюбленці знайдуть усе необхідне</h1>
            <p class="hero-subtitle">Купуйте чи продавайте товари для тварин швидко та зручно на нашій платформі.</p>
            <a href="{{ route('adverts.create') }}" class="hero-button">Додати оголошення</a>
        </div>
        <div class="hero-image">
            <img src="{{ asset('images/home/hero-image.jpg') }}" alt="banner">
        </div>
    </div>

    <div class="page-container">
        <div class="content-sections">
            <section class="content-section">
                <h2 class="section-title">Підберіть товари для вашого улюбленця</h2>
                <div class="section-container">
                    <div class="category-item">
                        <img src="{{ asset('images/home/dog.png') }}" alt="Собака" class="category-image">
                        <h4 class="category-title">Для Собак</h4>
                    </div>
                    <div class="category-item">
                        <img src="{{ asset('images/home/cat.png') }}" alt="Кіт" class="category-image">
                        <h4 class="category-title">Для Котів</h4>
                    </div>
                    <div class="category-item">
                        <img src="{{ asset('images/home/hamster.png') }}" alt="Гризун" class="category-image">
                        <h4 class="category-title">Для Гризунів</h4>
                    </div>
                    <div class="category-item">
                        <img src="{{ asset('images/home/parrot.png') }}" alt="Птах" class="category-image">
                        <h4 class="category-title">Для Птахів</h4>
                    </div>
                    <div class="category-item">
                        <img src="{{ asset('images/home/fish.png') }}" alt="Риба" class="category-image">
                        <h4 class="category-title">Для Риб</h4>
                    </div>
                    <div class="category-item">
                        <img src="{{ asset('images/home/reptile.png') }}" alt="Рептилія" class="category-image">
                        <h4 class="category-title">Для Рептилій</h4>
                    </div>
                    <div class="category-item">
                        <img src="{{ asset('images/home/medicinal.png') }}" alt="Загальні товари"
                             class="category-image">
                        <h4 class="category-title">Загальні Товари</h4>
                    </div>
                    <div class="category-item">
                        <img src="{{ asset('images/home/another.png') }}" alt="Інше" class="category-image">
                        <h4 class="category-title">Інші Товари</h4>
                    </div>
                </div>
            </section>

            <section class="content-section">
                <div class="form-row">
                    <h2 class="section-title">Популярні товари</h2>
                    <div class="scroll-buttons">
                        <button class="scroll-btn left">
                            <img src="{{ asset('images/less-than.svg') }}" alt="<">
                        </button>
                        <button class="scroll-btn right">
                            <img src="{{ asset('images/greater-than.svg') }}" alt=">">
                        </button>
                    </div>
                </div>
                <div class="home-adverts-list" id="popular-adverts">
                    @foreach($popularAdverts as $advert)
                        @include('components.advert-card', ['adverts' => $advert])
                    @endforeach
                </div>

                <div class="scroll-indicator" id="scroll-indicator">
                    <span class="active"></span>
                    <span></span>
                    <span></span>
                </div>
            </section>

            <section class="content-section">
                <div class="form-row">
                    <h2 class="section-title">Акційні товари</h2>
                    <a href="" class="view-all-button">Дивитись усе
                        <img src="{{ asset('images/greater-than.svg') }}" alt=">">
                    </a>
                </div>
                <div class="home-adverts-list">
                    @foreach($discountedAdverts as $advert)
                        @include('components.advert-card', ['adverts' => $advert])
                    @endforeach
                </div>
            </section>

            <section class="content-section">
                <div class="form-row">
                    <h2 class="section-title">Свіжі пропозиції</h2>
                    <a href="" class="view-all-button">Дивитись усе
                        <img src="{{ asset('images/greater-than.svg') }}" alt=">">
                    </a>
                </div>
                <div class="home-adverts-list">
                    @foreach($freshAdverts as $advert)
                        @include('components.advert-card', ['adverts' => $advert])
                    @endforeach
                </div>
            </section>

            <section class="content-section">
                <h2 class="section-title">Процес доставки (Як це працює?)</h2>
                <div class="section-container">
                    <div class="delivery-step-item">
                        <img src="{{ asset('images/home/01.svg') }}" alt="">
                        <h4 class="delivery-step-title">Переглянь оголошення</h4>
                        <p class="delivery-step-description">
                            Знайди ідеальний продукт для свого вихованця, який відповідає всім твоїм потребам.
                        </p>
                    </div>
                    <div class="delivery-step-item">
                        <h4 class="delivery-step-title">Обери спосіб доставки</h4>
                        <p class="delivery-step-description">
                            Вибери зручний спосіб доставки: Нова Пошта або Укрпошта.
                        </p>
                        <img src="{{ asset('images/home/02.svg') }}" alt="">
                    </div>
                    <div class="delivery-step-item">
                        <img src="{{ asset('images/home/03.svg') }}" alt="">
                        <h4 class="delivery-step-title">Відстежуй своє замовлення</h4>
                        <p class="delivery-step-description">
                            Отримай номер для відстеження та контролюй кожен крок процесу доставки.
                        </p>
                    </div>
                    <div class="delivery-step-item">
                        <h4 class="delivery-step-title">Забери та оплати</h4>
                        <p class="delivery-step-description">
                            Забери замовлення на пошті, оглянь та оплати при отриманні.
                        </p>
                        <img src="{{ asset('images/home/04.svg') }}" alt="">
                    </div>
                </div>
            </section>

            <section class="content-section">
                <h2 class="section-title">Чому ми?</h2>
                <div class="section-container">
                    <div class="why-us-item">
                        <img src="{{ asset('images/home/quality.png') }}" alt="Продукти високої якості">
                        <h4 class="why-us-title">Продукти високої якості</h4>
                    </div>
                    <div class="why-us-item">
                        <img src="{{ asset('images/home/sellers.png') }}" alt="Прямий зв'язок з продавцями">
                        <h4 class="why-us-title">Прямий зв'язок з продавцями</h4>
                    </div>
                    <div class="why-us-item">
                        <img src="{{ asset('images/home/choice.png') }}" alt="Широкий вибір">
                        <h4 class="why-us-title">Широкий вибір</h4>
                    </div>
                    <div class="why-us-item">
                        <img src="{{ asset('images/home/delivery.png') }}" alt="Гнучкі варіанти доставки">
                        <h4 class="why-us-title">Гнучкі варіанти доставки</h4>
                    </div>
                    <div class="why-us-item">
                        <img src="{{ asset('images/home/reviews.png') }}" alt="Відгуки та рейтинги">
                        <h4 class="why-us-title">Відгуки та рейтинги</h4>
                    </div>
                </div>
            </section>
        </div>
    </div>
@endsection
