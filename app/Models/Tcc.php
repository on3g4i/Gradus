<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Tcc extends Model
{
    use HasFactory, SoftDeletes;
    protected $table = 'tcc';
    protected $fillable = [
        'orientador_id',
        'aluno_id',
        'nome_projeto',
        'descricao',
        'dia_defesa'
    ];
    public function aluno()
    {
        return $this->belongsTo(User::class, 'aluno_id');
    }
    public function orientador()
    {
        return $this->belongsTo(User::class, 'orientador_id');
    }
    public function documentos()
    {
        return $this->hasMany(Documento::class, 'tcc_id');
    }
    public function defesas()
    {
        return $this->hasMany(Defesa::class);
    }

}
