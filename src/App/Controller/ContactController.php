<?php

namespace App\Controller;

use Symfony\Component\HttpFoundation\Response;

class ContactController
{
    public function contact() {
        return new Response('<p>You are in the <strong>contact</strong> !</p>');
    }
}
