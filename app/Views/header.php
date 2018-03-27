<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <link href="favicon.ico" rel="icon" type="image/x-icon">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css">
    <title>Task App</title>
</head>

<body>
<header>
    <div class="container">
        <nav class="navbar navbar-expand-lg navbar-light bg-light pr-0 pl-0">
            <a class="navbar-brand" href="<?php echo APP_DIR; ?>/">Task App</a>
            <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>

            <div class="collapse navbar-collapse" id="navbarSupportedContent">
                <ul class="navbar-nav mr-auto">
                    <li class="nav-item">
                        <a class="nav-link" href="<?php echo APP_DIR; ?>/">Home</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="<?php echo APP_DIR; ?>/?controller=task&action=new">Add new</a>
                    </li>
                </ul>
                <?php if ($auth->guest()) { ?>
                    <form class="form-inline my-2 my-lg-0" action="<?php echo APP_DIR; ?>/?controller=auth&action=login" method="POST">
                        <input class="form-control form-control-sm mr-sm-2" type="text" name="login" placeholder="Login" required>
                        <input class="form-control form-control-sm mr-sm-2" type="password" name="password" placeholder="Password" required>
                        <button class="btn btn-sm btn-outline-success my-2 my-sm-0" type="submit">Login</button>
                    </form>
                <?php } else { ?>
                    <div>
                        <span>Hello, <?php echo $auth->user()->getUsername(); ?>!</span>
                        <a class="btn btn-sm btn-outline-success my-2 my-sm-0" href="<?php echo APP_DIR; ?>/?controller=auth&action=logout">Logout</a>
                    </div>
                <?php } ?>
            </div>
        </nav>
    </div>
</header>
