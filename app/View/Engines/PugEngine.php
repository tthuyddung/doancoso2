<?php

namespace App\View\Engines;

use Illuminate\Contracts\View\Engine;
use Pug\Pug;

class PugEngine implements Engine
{
    protected $pug;

    public function __construct(Pug $pug)
    {
        $this->pug = $pug;
    }

    public function get($path, array $data = [])
    {
        return $this->pug->render($path, $data);
    }
}
