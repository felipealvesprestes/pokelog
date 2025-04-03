<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class Pokemon extends Model
{
    use HasFactory;

    protected $table = 'pokemon';
    protected $fillable = [
        'name',
        'weight',
        'height',
    ];

    /**
     * The types that belong to the Pokemon.
     */
    public function types(): BelongsToMany
    {
        return $this->belongsToMany(Type::class, 'pokemon_type', 'pokemon_id', 'type_id');
    }
}
