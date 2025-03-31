<?php

namespace App\Application\Traits;

trait ToArrayable
{
    public function toArray(): array
    {
        return get_object_vars($this);
    }
}
