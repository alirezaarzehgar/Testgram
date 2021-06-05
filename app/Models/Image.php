<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Image extends Model
{
    use HasFactory;

    protected $fillable = ['url'];

    public function path()
    {
        $url = collect(explode('/', $this->url));
        $url = $url->slice(2);
        $url = implode('/', $url->toArray());
        $url = 'storage/profiles/' . $url;

        return asset($url);
    }
}
