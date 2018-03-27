<div class="table-responsive">
    <h6>Preview:</h6>
    <table id="taskPreview" class="table table-sm">
        <caption>List of tasks</caption>
        <thead>
        <tr>
            <th scope="col">#</th>
            <th scope="col">Username</th>
            <th scope="col">Email</th>
            <th scope="col">Text</th>
            <th scope="col">Image</th>
            <?php if (!$auth->guest() && $auth->user()->isAdmin()) { ?>
                <th scope="col">Status</th>
            <?php } ?>
        </tr>
        </thead>
        <tbody>
        <tr>
            <th id="taskPreviewId" scope="row"></th>
            <td id="taskPreviewUsername"></td>
            <td id="taskPreviewEmail"></td>
            <td id="taskPreviewText"></td>
            <td><img id="taskPreviewImage" src=""></td>
            <?php if (!$auth->guest() && $auth->user()->isAdmin()) { ?>
                <td id="taskPreviewStatus"></td>
            <?php } ?>
        </tr>
        </tbody>
    </table>
</div>
