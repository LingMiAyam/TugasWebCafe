<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class UlasanMenu extends Model
{
    use HasFactory;

    protected $table = 'ulasan_menu';

    protected $fillable = [
        'menu_id',
        'user_id',
        'rating',
        'komentar',
    ];

    public function menu()
    {
        return $this->belongsTo(Menu::class, 'menu_id');
    }

    public function user()
    {
    return $this->belongsTo(User::class);
    }
}