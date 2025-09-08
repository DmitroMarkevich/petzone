<?php if($paginator->hasPages()): ?>
    <nav class="pagination-nav">
        <?php
            $current = $paginator->currentPage();
            $last = $paginator->lastPage();
            $delta = 1;

            $start = max(1, $current - $delta);
            $end = min($last, $current + $delta);

            if ($end - $start < $delta * 2) {
                if ($start == 1) {
                    $end = min($last, $start + $delta * 2);
                } else {
                    $start = max(1, $end - $delta * 2);
                }
            }
        ?>

        <ul class="pagination">
            <?php if($paginator->onFirstPage()): ?>
                <li class="pagination-item disabled"><span>‹</span></li>
            <?php else: ?>
                <li class="pagination-item"><a href="<?php echo e($paginator->previousPageUrl()); ?>">‹</a></li>
            <?php endif; ?>

            <?php if($start > 1): ?>
                <li class="pagination-item"><a href="<?php echo e($paginator->url(1)); ?>">1</a></li>
                <?php if($start > 2): ?>
                    <li class="pagination-dots">…</li>
                <?php endif; ?>
            <?php endif; ?>

            <?php for($page = $start; $page <= $end; $page++): ?>
                <?php if($page == $current): ?>
                    <li class="pagination-item active"><span><?php echo e($page); ?></span></li>
                <?php else: ?>
                    <li class="pagination-item"><a href="<?php echo e($paginator->url($page)); ?>"><?php echo e($page); ?></a></li>
                <?php endif; ?>
            <?php endfor; ?>

            <?php if($end < $last): ?>
                <?php if($end < $last - 1): ?>
                    <li class="pagination-dots">…</li>
                <?php endif; ?>
                <li class="pagination-item"><a href="<?php echo e($paginator->url($last)); ?>"><?php echo e($last); ?></a></li>
            <?php endif; ?>

            <?php if($paginator->hasMorePages()): ?>
                <li class="pagination-item"><a href="<?php echo e($paginator->nextPageUrl()); ?>">›</a></li>
            <?php else: ?>
                <li class="pagination-item disabled"><span>›</span></li>
            <?php endif; ?>
        </ul>
    </nav>
<?php endif; ?>
<?php /**PATH C:\Users\dmark\PhpstormProjects\petzone\resources\views\components\ui\pagination.blade.php ENDPATH**/ ?>