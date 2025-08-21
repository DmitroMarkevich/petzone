<?php $__env->startSection('title', 'Оплата скасована'); ?>

<?php $__env->startPush('styles'); ?>
    <style>
        .checkout-cancel {
            font-family: 'Inter', 'sans-serif';
            display: flex;
            justify-content: center;
            align-items: center;
            min-height: 70vh;
            padding: 2rem;
        }

        .checkout-cancel .card {
            text-align: center;
            background: #fff;
            padding: 3rem 2rem;
            border-radius: 32px;
            box-shadow: 0 8px 24px rgba(0, 0, 0, 0.15);
            max-width: 480px;
        }

        .checkout-cancel h1 {
            color: #FE3535;
            font-size: 2rem;
            margin-bottom: 1rem;
            font-weight: 600;
        }

        .checkout-cancel p {
            font-size: 1.1rem;
            margin-bottom: 2rem;
            color: #1C1B1C;
            line-height: 1.5;
        }

        .checkout-cancel .order-info p {
            font-weight: 500;
            font-size: 1.1rem;
            margin-bottom: 0.5rem;
            color: #1C1B1C;
        }

        .checkout-cancel .order-info ul {
            list-style: none;
            padding-left: 0;
            margin-top: 0.5rem;
        }

        .checkout-cancel .order-info ul li {
            position: relative;
            padding-left: 1.8rem;
            margin-bottom: 0.6rem;
            font-size: 1rem;
            color: #484647;
        }

        .checkout-cancel .order-info ul li::before {
            content: "•";
            position: absolute;
            left: 0;
            color: #FE3535;
            font-weight: bold;
            font-size: 1.2rem;
        }

        .card {
            display: flex;
            align-items: center;
            flex-direction: column;
            gap: 32px;
        }
    </style>
<?php $__env->stopPush(); ?>

<?php $__env->startSection('content'); ?>
    <?php echo $__env->make('partials.header', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?>

    <main class="checkout-cancel">
        <div class="card">
            <div>
                <div class="icon">
                    <svg width="64" height="64" viewBox="0 0 24 24" fill="none" stroke="#FE3535"
                         stroke-width="2">
                        <circle cx="12" cy="12" r="10"/>
                        <line x1="15" y1="9" x2="9" y2="15"/>
                        <line x1="9" y1="9" x2="15" y2="15"/>
                    </svg>
                </div>

                <h1>Оплата скасована</h1>

                <div class="order-info">
                    <p>Замовлення №<?php echo e($orderId); ?> не було оплачено</p>
                    <p>Можливі причини скасування:</p>
                    <ul>
                        <li>Скасування платежу користувачем</li>
                        <li>Недостатньо коштів на рахунку</li>
                        <li>Технічна помилка платіжної системи</li>
                        <li>Перевищено час очікування платежу</li>
                    </ul>
                </div>
            </div>

            <div class="actions">
                <a href="<?php echo e(route('home')); ?>">Повернутися на головну</a>
            </div>
        </div>
    </main>

    <?php echo $__env->make('partials.footer', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?>
<?php $__env->stopSection(); ?>


<?php echo $__env->make('layouts.app', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH C:\Users\dmark\PhpstormProjects\petzone\resources\views/checkout/cancel.blade.php ENDPATH**/ ?>