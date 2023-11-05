<?php

namespace Agro\System;

use Agro\Router\Router;
use Agro\View\View;

enum DefaultProviders: string
{
    case VIEW = View::class;

    case ROUTER = Router::class;
}
