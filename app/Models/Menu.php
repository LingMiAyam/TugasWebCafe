<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Menu extends Model
{
    use HasFactory;

    protected $table = 'menus'; 

    protected $fillable = [
        'nama_menu',
        'kategori',
        'harga',
        'foto'
    ];

    public function ulasan_menu()
{
    return $this->hasMany(\App\Models\UlasanMenu::class, 'menu_id');
}

}