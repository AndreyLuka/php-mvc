<?php include_once DIR_VIEWS_ABS . '/header.php'; ?>

<div class="container">
    <h1><small>Add new Task</small></h1>

    <?php include_once DIR_VIEWS_ABS . '/tasks/task-preview.php'; ?>

    <form enctype="multipart/form-data" action="<?php echo APP_DIR; ?>/?controller=task&action=new" method="POST">
        <div class="form-group">
            <label for="taskFormUsername">Username:</label>
            <input id="taskFormUsername" class="form-control form-control-sm" type="text" name="username" placeholder="Username" required>
        </div>
        <div class="form-group">
            <label for="taskFormEmail">Email:</label>
            <input id="taskFormEmail" class="form-control form-control-sm" type="email" name="email" placeholder="Email" required>
        </div>
        <div class="form-group">
            <label for="taskFormText">Text:</label>
            <textarea id="taskFormText" class="form-control form-control-sm" name="text" placeholder="Text" required></textarea>
        </div>
        <div class="form-group">
            <label for="taskFormImage">Choose image</label>
            <input id="taskFormImage" class="form-control form-control-sm" type="file" name="image">
        </div>
        <?php if (!$auth->guest() && $auth->user()->isAdmin()) { ?>
            <div class="form-group">
                <div class="form-check">
                    <input id="taskFormStatus" class="form-check-input" type="checkbox" name="status">
                    <label class="form-check-label" for="taskFormStatus">Done?</label>
                </div>
            </div>
        <?php } ?>

        <button class="btn btn-primary btn-sm mr-2 mb-3" type="submit">Add</button>
        <button id="taskFormBtnPreview" class="btn btn-default btn-sm mb-3" type="button">Preview</button>
    </form>
</div>

<?php include_once DIR_VIEWS_ABS . '/footer.php'; ?>
