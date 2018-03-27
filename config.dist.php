<?php

/**
 * Configuration variables.
 */

define('DB_HOST', 'localhost');
define('DB_NAME', '');
define('DB_USER', 'root');
define('DB_PASS', '');
define('DB_CHARSET', 'utf8');
define('DB_TABLE_PREFIX', '');
define('APP_DIR', ''); // Move App to custom directory
define('DIR_ROOT_ABS', __DIR__);
define('DIR_VIEWS_ABS', DIR_ROOT_ABS . '/app/Views');
define('DIR_PUBLIC_ABS', DIR_ROOT_ABS . '/public');
define('DIR_ASSETS', '/assets');
define('DIR_ASSETS_JS', DIR_ASSETS . '/js');
define('DIR_UPLOADS', '/uploads');
define('DIR_UPLOADS_ABS', DIR_PUBLIC_ABS . DIR_UPLOADS);
define('IMG_MAX_WIDTH', 320);
define('IMG_MAX_HEIGHT', 240);
define('DEFAULT_CONTROLLER', 'Task');
