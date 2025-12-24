<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Documento extends Model
{
  use HasFactory;
  protected $table = 'documento';
  protected $fillable = [
    'tipo',
    'autor_id',
    'url',
    'tcc_id',
    'nome_arquivo',
    'hash'
  ];
  public function tcc()
  {
    return $this->belongsTo(Tcc::class);
  }
  public function autor()
  {
    return $this->belongsTo(User::class);
  }

}
