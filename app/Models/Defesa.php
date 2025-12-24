<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Defesa extends Model
{
    use HasFactory;
    protected $table = 'defesa';
    protected $fillable = [
        'banca',
        'atas_url',
        'fichas_avaliacao'
    ];
    public function tcc()
    {
        return $this->belongsTo(Tcc::class);
    }
}
