<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Transaction extends Model
{
  protected $table = 'transactions';

  protected $fillable = [
    'amount',
    'description',
    'date',
    // adicione outros campos aqui
  ];

  // adicione relacionamentos e métodos personalizados aqui

}