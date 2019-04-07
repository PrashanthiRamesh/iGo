<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

/**
 * Class LinkedOpusCard from Native app- iGo
 * @package App
 */
class LinkedOpusCard extends Model
{
    protected $fillable = ['name','number', 'email', 'expiry_date', 'account_email'];
}
