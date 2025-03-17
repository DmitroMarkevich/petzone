<div id="verification-message" class="success-message">
    <svg class="success-icon" viewBox="0 0 24 24">
        <path fill="green" d="M9 16.17L4.83 12l-1.42 1.41L9 19l12-12-1.41-1.42z"/>
    </svg>
    <p class="message-title">Дякуємо!</p>
    <p class="message-text"><?php echo e($message); ?></p>
</div>

<script>
    $(document).ready(function () {
        const $messageBox = $("#verification-message");

        if ($messageBox.length) {
            setTimeout(() => {
                $messageBox.addClass("hidden");
            }, 3000);
        }
    });
</script>
<?php /**PATH C:\Users\dmark\PhpstormProjects\petzone\resources\views/components/success-message.blade.php ENDPATH**/ ?>