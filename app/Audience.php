<?php

namespace App;

use Illuminate\Database\Eloquent\SoftDeletes;

class Audience extends Model
{
    use SoftDeletes;

    public function getDescription()
    {
        return $this->description;
    }
}
