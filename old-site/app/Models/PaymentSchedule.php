<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PaymentSchedule extends Model
{
    use HasFactory;
    protected $fillable = [
        'user_id',
        'project_id',
        'unit_id',
        'json',
        'down_payment',
        'monthly_installment',
        'quarterly_installment',
        'half_yearly_installment',
        'yearly_installment',
        'possession',
        'loan_amount',
        'start_of_work',
        'slab_casting',
        'plinth',
        'colour',
        'created_at'
    ];
    protected $table = 'payment_schedule';

    public function user()
    {
        return $this->belongsTo(User::class);
    }
    public function project()
    {
        return $this->belongsTo(Project::class);
    }
    public function unit()
    {
        return $this->belongsTo(Unit::class);
    }
}
