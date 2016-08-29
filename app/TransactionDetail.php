<?php

namespace app;

use Illuminate\Database\Eloquent\Model;

class TransactionDetail extends Model
{
    public function transaction()
    {
        return $this->belongsTo('App\Transaction');
    }
}
