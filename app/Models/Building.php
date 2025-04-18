<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use MatanYadaev\EloquentSpatial\Objects\Point;
use MatanYadaev\EloquentSpatial\Traits\HasSpatial;
use Rutorika\Sortable\SortableTrait;

class Building extends Model
{
    use HasFactory;
    use SortableTrait;
    use HasSpatial;

    protected $fillable = [
        'title',
        'short_description',
        'long_description',
        'bg_image',
        'position',
        'location'
    ];

    protected $casts = [
        'location' => Point::class,
    ];


    public function images(): HasMany
    {
        return $this->hasMany(Image::class);
    }
    public static function setNewOrder(array $order)
    {
        foreach ($order as $index => $id) {
            $building = self::find($id);
            if ($building) {
                $building->update(['position' => $index + 1]);
            }
        }
    }
}



