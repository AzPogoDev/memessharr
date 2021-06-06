<?php

namespace App\Aware;

use PDO;

interface PdoAware
{
    public function setPdo(PDO $pdo);
}
