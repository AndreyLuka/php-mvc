<?php include_once DIR_VIEWS_ABS . '/header.php'; ?>

<div class="container">
    <h1><small>Welcome to Task App!</small></h1>

    <div class="row">
        <div class="col-sm-6">
            <a class="btn btn-primary btn-sm mb-3" href="<?php echo APP_DIR; ?>/?controller=task&action=new">Add new</a>
        </div>

        <div class="col-sm-6">
            <form class="form-inline mb-3 justify-content-sm-end" action="<?php echo APP_DIR; ?>/?controller=task&action=index" method="GET">
                <?php include_once DIR_VIEWS_ABS . '/form-inputs-request.php'; ?>
                <div class="form-group mr-1">
                    <select class="form-control form-control-sm" name="order_by">
                        <option value="">Order By</option>
                        <option value="username" <?php echo $request->getQueryParam('order_by') == 'username' ? 'selected' : null; ?>>Username</option>
                        <option value="email" <?php echo $request->getQueryParam('order_by') == 'email' ? 'selected' : null; ?>>Email</option>
                        <option value="status" <?php echo $request->getQueryParam('order_by') == 'status' ? 'selected' : null; ?>>Status</option>
                    </select>
                </div>
                <div class="form-group mr-1">
                    <select class="form-control form-control-sm" name="direction">
                        <option value="">Direction</option>
                        <option value="asc" <?php echo $request->getQueryParam('direction') == 'asc' ? 'selected' : null; ?>>ASC</option>
                        <option value="desc" <?php echo $request->getQueryParam('direction') == 'desc' ? 'selected' : null; ?>>DESC</option>
                    </select>
                </div>
                <div class="form-group">
                    <button class="btn btn-sm" type="submit">Sort</button>
                </div>
            </form>
        </div>
    </div>

    <div class="table-responsive">
        <table class="table table-sm">
            <caption>List of tasks</caption>
            <thead>
            <tr>
                <th scope="col">#</th>
                <th scope="col">Username</th>
                <th scope="col">Email</th>
                <th scope="col">Text</th>
                <th scope="col">Image</th>
                <th scope="col">Status</th>
                <?php if (!$auth->guest() && $auth->user()->isAdmin()) { ?>
                    <th scope="col">Actions</th>
                <?php } ?>
            </tr>
            </thead>
            <tbody>
            <?php if (empty($tasks)) { ?>
                <tr>
                    <td colspan="7">No Tasks in list.</td>
                </tr>
            <?php } ?>
            <?php if (!empty($tasks)) { ?>
                <?php foreach ($tasks as $key => $task) { ?>
                    <tr>
                        <th scope="row"><?php echo $key + 1; ?></th>
                        <td><?php echo $task->getUsername(); ?></td>
                        <td><?php echo $task->getEmail(); ?></td>
                        <td><?php echo $task->getText(); ?></td>
                        <td>
                            <?php if ($task->getImage()) { ?>
                                <img src="<?php echo $task->getImagePath(); ?>">
                            <?php } ?>
                        </td>
                        <td><?php echo $task->getStatusText(); ?></td>
                        <?php if (!$auth->guest() && $auth->user()->isAdmin()) { ?>
                            <td>
                                <div class="btn-group">
                                    <a class="btn btn-success btn-sm" href="<?php echo APP_DIR; ?>/?controller=task&action=edit&id=<?php echo $task->getId(); ?>">Edit</a>
                                    <a class="btn btn-danger btn-sm" href="<?php echo APP_DIR; ?>/?controller=task&action=delete&id=<?php echo $task->getId(); ?>">Delete</a>
                                </div>
                            </td>
                        <?php } ?>
                    </tr>
                <?php } ?>
            <?php } ?>
            </tbody>
        </table>
    </div>

    <?php include_once DIR_VIEWS_ABS . '/pagination.php'; ?>
</div>

<?php include_once DIR_VIEWS_ABS . '/footer.php'; ?>
