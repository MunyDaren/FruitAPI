<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Purchase extends Model
{
    use HasFactory;

    // Define the table associated with the model (optional if using the default convention)
    protected $table = 'purchases';

    // Define the attributes that are mass assignable
    protected $fillable = [
        'total_amount',
    ];

    // Define the attributes that should be cast to native types
    protected $casts = [
        'total_amount' => 'decimal:2', // Ensure total_amount is stored as a decimal with 2 decimal places
    ];
}

