<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

/**
 * Class OpusCard from STM
 * @package App
 *
 */
class OpusCard extends Model
{
     protected $fillable = ['number', 'email', 'expiry_date', 'linked_with_igo'];
}
