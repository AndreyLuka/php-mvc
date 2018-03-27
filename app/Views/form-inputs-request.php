<?php if ($request->getQueryParam('controller')) { ?>
    <input type="hidden" name="controller" value="<?php echo $request->getQueryParam('controller'); ?>">
<?php } ?>
<?php if ($request->getQueryParam('action')) { ?>
    <input type="hidden" name="action" value="<?php echo $request->getQueryParam('action'); ?>">
<?php } ?>
<?php if ($request->getQueryParam('p')) { ?>
    <input type="hidden" name="p" value="<?php echo $request->getQueryParam('p'); ?>">
<?php } ?>
