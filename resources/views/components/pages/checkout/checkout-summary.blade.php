@props(['advert'])

<div class="checkout-summary">
    <h4 class="summary-title">Разом</h4>

    <div class="order-total">
        <div class="form-row">
            <p>Товар на суму</p>
            <p class="advert-price">{{ $advert->price }}₴</p>
        </div>

        <div class="form-row">
            <p>Вартість доставки</p>
            <span>Безкоштовно</span>
        </div>
    </div>

    <button type="submit" class="order-button">Замовлення підтверджую</button>

    <p class="order-info">
        Отримання замовлення від 5 000 ₴ - 30 000 ₴ за наявності документів.
        При оплаті готівкою від 30 000 ₴ необхідно надати документи для верифікації
        згідно вимог Закону України від 06.12.2019 №361-IX
    </p>

    <div class="order-terms">
        <p class="terms-title">Підтверджуючи замовлення, я приймаю умови:</p>
        <ul class="terms-list">
            <li><a href="#" class="terms-link">Положення про обробку персональних даних.</a></li>
            <li><a href="#" class="terms-link">Угоди користувача.</a></li>
        </ul>
    </div>
</div>
