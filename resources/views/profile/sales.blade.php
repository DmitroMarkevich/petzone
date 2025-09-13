@extends('layouts.profile')

@section('title', 'Мої продажі')

@section('profile-content')
    @if($sales->isEmpty())
        <div class="no-results">
            <p>{{ __('common.nothing_found') }}</p>
        </div>
    @else
        <div class="sales-container">
            <h2 class="page-title">Мої продажі</h2>

            <x-filter-buttons :items="$sales->getCollection()" :filters="[
                ['key' => 'status', 'value' => 'PENDING', 'label' => 'Очікують підтвердження'],
                ['key' => 'status', 'value' => 'CONFIRMED', 'label' => 'Підтверджені'],
                ['key' => 'status', 'value' => 'CANCELED', 'label' => 'Відхилені']
                ]" :current-filter="request('status')"
            />

            <div class="adverts-list">
                @forelse($sales as $sale)
                    @continue(!$sale->advert)

                    <div class="advert-item" data-status="{{ $sale->status->value }}" x-data="{ open: false }">
                        <div class="advert-main">
                            <div class="advert-left">
                                <div class="advert-image-wrapper">
                                    <img src="{{ $sale->advert->main_image }}" class="advert-image" alt="{{ $sale->advert->title }}">
                                </div>

                                <div class="advert-content">
                                    <a class="advert-title" href="{{ route('advert.show', $sale->advert->id) }}">
                                        {{ $sale->advert->title }}
                                    </a>

                                    <p>Служба доставки:
                                        <img src="{{ \App\Enum\DeliveryMethod::getIcon($sale->delivery_method) }}"
                                             alt="Delivery" class="delivery-icon">
                                        {{ \App\Enum\DeliveryMethod::getTranslation($sale->delivery_method) }}
                                    </p>

                                    <div class="advert-date-wrapper">
                                        <img src="{{ asset('images/profile/calendar.svg') }}" alt="Calendar">
                                        <span class="advert-date">{{ $sale->created_at->format('d.m.y, H:i') }}</span>
                                    </div>

                                    <button type="button" class="toggle-details" @click="open = !open">
                                        <span x-text="open ? 'Згорнути' : 'Розгорнути'"></span>
                                    </button>
                                </div>
                            </div>

                            <div class="advert-right">
                                <p class="advert-price">{{ $sale->total_price }}₴</p>

                                @if($sale->status->value == \App\Enum\OrderStatus::PENDING->value)
                                    <div class="advert-actions">
                                        <form action="{{ route('profile.sales.confirm', $sale->id) }}" method="POST">
                                            @csrf
                                            <button type="submit" class="edit-btn">Підтвердити</button>
                                        </form>

                                        <form action="{{ route('profile.sales.reject', $sale->id) }}" method="POST">
                                            @csrf
                                            <button type="submit" class="delete-btn">Відхилити</button>
                                        </form>
                                    </div>
                                @endif
                            </div>
                        </div>

                        <div class="advert-details" x-show="open" x-transition>
                            <div class="details-section">
                                <h4 class="details-title">Інформація про покупця</h4>
                                <div class="details-list">
                                    <div>
                                        <span>Покупець:</span>
                                        <a href="{{ route('home') }}" title="Перейти до профілю покупця">
                                            {{ $sale->buyer->first_name }} {{ $sale->buyer->last_name }}
                                        </a>
                                    </div>
                                    <span>Ім'я: {{ $sale->recipient->first_name }}</span>
                                    <span>Прізвище: {{ $sale->recipient->last_name }}</span>
                                    <span>По батькові: {{ $sale->recipient->middle_name }}</span>
                                    <span>Телефон: {{ $sale->recipient->phone_number }}</span>
                                </div>
                            </div>
                            <div class="details-section">
                                <h4 class="details-title">Деталі замовлення</h4>
                                <div class="details-list">
                                    <span>Статус: {{ $sale->status }}</span>
                                    <span>ID угоди: {{ $sale->order_number }}</span>
                                    <span>Комісія: 2% + 20₴</span>
                                    <span>До зарахування: {{ $sale->total_price }} ₴</span>
                                </div>
                            </div>
                        </div>
                    </div>
                @empty
                    <p>Продажі відсутні.</p>
                @endforelse

                @if($sales->hasPages())
                    {{ $sales->links() }}
                @endif
            </div>
        </div>
    @endif

    @if(session('success'))
        <x-ui.flash-message :message="session('success')" />
    @endif
@endsection


<style>
    .advert-details {
        display: grid;
        grid-template-columns: repeat(auto-fit, minmax(250px, 1fr));
        gap: 20px;

        background: #fff;
        border-radius: 12px;
        padding: 20px 30px;
        margin-bottom: 10px;
        font-family: 'Inter', 'sans-serif';
        box-shadow: 0 4px 12px rgba(0, 0, 0, 0.1);
    }

    .details-section {
        display: flex;
        flex-direction: column;
        color: #1C1B1C;

        .details-title {
            padding-bottom: 10px;
            margin-bottom: 10px;
            border-bottom: 2px solid #f0f0f0;
        }

        .details-list {
            display: grid;
            gap: 8px;
        }
    }

    .advert-details a:hover {
        text-decoration: underline;
    }

    .delivery-icon {
        width: 20px;
        height: auto;
        vertical-align: middle;
    }

    @media (max-width: 768px) {
        .advert-details {
            grid-template-columns: 1fr;
            padding: 15px 20px;
        }
    }
</style>
