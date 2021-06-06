<?php


namespace App\Aware;

use Twig\Environment;

interface TwigAware
{
    public function setTwig(Environment $twig);
}