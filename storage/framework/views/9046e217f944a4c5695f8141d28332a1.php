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

<style>
    .pagination-nav {
        display: flex;
        justify-content: center;
        margin: 2rem 0;
    }

    .pagination {
        display: flex;
        list-style: none;
        padding: 0;
        margin: 0;
        gap: 4px;
        align-items: center;
    }

    .pagination-item a,
    .pagination-item span {
        display: flex;
        align-items: center;
        justify-content: center;
        min-width: 40px;
        height: 40px;
        padding: 0 8px;
        text-decoration: none;
        border: 1px solid #e2e8f0;
        border-radius: 6px;
        color: #64748b;
        font-weight: 500;
        transition: all 0.15s ease;
    }

    .pagination-item a:hover {
        background-color: #f8fafc;
        border-color: #cbd5e1;
        color: #334155;
    }

    .pagination-item.active span {
        background-color: #3b82f6;
        border-color: #3b82f6;
        color: white;
    }

    .pagination-item.disabled span {
        color: #cbd5e1;
        cursor: not-allowed;
    }

    .pagination-dots {
        padding: 0 8px;
        color: #94a3b8;
        font-weight: bold;
        user-select: none;
    }

    @media (max-width: 640px) {
        .pagination-item a,
        .pagination-item span {
            min-width: 36px;
            height: 36px;
            font-size: 14px;
        }

        .pagination {
            gap: 2px;
        }
    }
</style>
<?php /**PATH C:\Users\dmark\PhpstormProjects\petzone\resources\views/vendor/pagination/pagination.blade.php ENDPATH**/ ?>
