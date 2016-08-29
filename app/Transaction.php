<?php

namespace app;

use Illuminate\Database\Eloquent\Model;

class Transaction extends Model
{
    public function details()
    {
        return $this->hasMany('App\TransactionDetail');
    }
}
