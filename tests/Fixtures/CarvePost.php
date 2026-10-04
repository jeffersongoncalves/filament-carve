<?php

namespace JeffersonGoncalves\Filament\Carve\Tests\Fixtures;

use Illuminate\Database\Eloquent\Model;
use JeffersonGoncalves\Carve\Casts\AsCarve;

class CarvePost extends Model
{
    protected $guarded = [];

    public $timestamps = false;

    protected $casts = ['body' => AsCarve::class];
}
