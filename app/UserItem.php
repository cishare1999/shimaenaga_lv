<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class UserItem extends Model
{
  function user()
  {
    return $this->belongsTo(User::class);
  }
}
