<?php

namespace App\Aware;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\ParameterBag;

interface RequestAware
{
    public function setRequest(Request $request);
}
