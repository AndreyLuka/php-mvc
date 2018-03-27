<?php if ($pagination->exists()) { ?>
    <nav>
        <ul class="pagination pagination-sm">
            <li class="page-item <?php echo $pagination->hasPrev() ? null : 'disabled'; ?>">
                <?php if ($pagination->hasPrev()) { ?>
                    <a class="page-link" href="<?php echo sprintf('%s/?%sp=%d', APP_DIR, $request->getQueryString(['p']), ($pagination->getCurrentPage() - 1)); ?>">Previous</a>
                <?php } else { ?>
                    <a class="page-link">Previous</a>
                <?php } ?>
            </li>

            <?php for($i = 1; $i <= $pagination->getNumOfPages(); $i++) { ?>
                <li class="page-item <?php echo $i != $pagination->getCurrentPage() ? null : 'active'; ?>">
                    <?php if ($i != $pagination->getCurrentPage()) { ?>
                        <a class="page-link" href="<?php echo sprintf('%s/?%sp=%d', APP_DIR, $request->getQueryString(['p']), $i); ?>"><?php echo $i; ?></a>
                    <?php } else { ?>
                        <a class="page-link"><?php echo $i; ?></a>
                    <?php } ?>
                </li>
            <?php } ?>

            <li class="page-item <?php echo $pagination->hasNext() ? null : 'disabled'; ?>">
                <?php if ($pagination->hasNext()) { ?>
                    <a class="page-link" href="<?php echo sprintf('%s/?%sp=%d', APP_DIR, $request->getQueryString(['p']), ($pagination->getCurrentPage() + 1)); ?>">Next</a>
                <?php } else { ?>
                    <a class="page-link">Next</a>
                <?php } ?>
            </li>
        </ul>
    </nav>
<?php } ?>
