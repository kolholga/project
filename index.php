<?php

require_once  'system/core/functions.php';
require_once 'system/core/Router.php';

pr($_REQUEST);

$r = new Router();

Router::getRouts('^(.*)$', 'news/index');
