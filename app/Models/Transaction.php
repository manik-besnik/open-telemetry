<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;


/** 
 * @property int $id
 * @property string $trancation_type
 * @property int $amount
 */
class Transaction extends Model
{
    use HasFactory;

    protected $table = 'trancations';
    
    protected $fillable = ['trancation_type','amount'];
}
