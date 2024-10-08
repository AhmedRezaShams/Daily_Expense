<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Expense extends Model
{
    use HasFactory, SoftDeletes;
    protected $table = 'expenses'; 
    protected $fillable = [
        'date',
        'category_id',
        'reason',
        'amount',
        'transaction_type',
    ];
    public static $type = [
        'debit' => 'In',
        'credit' => 'Out'
    ];
    public function category()
    {
        return $this->belongsTo(Category::class, 'category_id')->withTrashed();
    }

}
