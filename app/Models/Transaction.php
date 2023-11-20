<?php

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Transaction extends Model
{
    use HasFactory,SoftDeletes;

    protected $fillable = [
        'amount',
        'payer',
        'due_on',
        'vat',
        'is_vat_inclusive',
        'status',
    ];
    public function getStatusAttribute()
    {
        $totalPaid = $this->payments()->sum('amount');
        $currentDate = Carbon::now();
        if (!$this->is_vat_inclusive) {
            $totalPaid = $totalPaid + ($totalPaid * ($this->vat / 100));
        }
        if ($totalPaid >= $this->amount ) {
            return 'Paid';
        } elseif ($currentDate->gt($this->due_on) && !$currentDate->isSameDay($this->due_on)) {
            return 'Overdue';
        }else{
            return 'Outstanding';
        }

    }
    public static function boot()
    {
        parent::boot();

        static::saving(function ($transaction) {
            $transaction->attributes['status'] = $transaction->status;
        });
    }

        public function user(){
        return $this->belongsTo(User::class,'payer','id');
    }
    public function payments(){
        return $this->hasMany(Payment::class,'transaction_id');
    }

}
