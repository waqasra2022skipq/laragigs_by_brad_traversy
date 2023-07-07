<?php

namespace App\Models;

use App\Models\Listing;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Categories extends Model
{
    use HasFactory;

    public function Listing() {
        return $this->belongsToMany(Listing::class, 'terms_relationship', 'category_id', 'listing_id');
    }
}
