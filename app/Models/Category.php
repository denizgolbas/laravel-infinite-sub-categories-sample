<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'description',
        'slug',
        'parent_id'
    ];

    /**
    * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
    */

    public function parent() {
        return $this->belongsTo(self::class, 'parent_id','id');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function child() {
        return $this->hasMany(self::class, 'parent_id','id');
    }

    /**
     * Recursive categories
     */

    public function children(){
        return $this->child()->with('children');
    }

}