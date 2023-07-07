<?php

namespace App\Models;

use App\Models\User;
use App\Models\Categories;
use GuzzleHttp\Psr7\Request;
use Illuminate\Support\Carbon;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Listing extends Model
{
    use HasFactory;

    protected $fillable = ['user_id', 'title', 'content', 'company', 'email', 'location', 'website', 'expires', 'logo'];
    

    public function categories() {
        return $this->belongsToMany(Categories::class, 'terms_relationship', 'listing_id', 'category_id');
    }

    public function user() {
        return $this->belongsTo(User::class, 'id');
    }

    public function scopeFilter($query, array $filters) {

        if( $filters['search'] ?? false) {
            $query->where('title', 'like', '%' . request('search') .'%')
                ->orWhere('content', 'like', '%' . request('search') .'%')
            ;
        }

    }

}
