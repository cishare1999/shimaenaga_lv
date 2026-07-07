<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class UserData extends Model
{
  //新規登録でUserとリレーションする設定
  protected $fillable = ['user_id','birthday'];

  function user()
  {
    return $this->belongsTo(User::class);
  }
}
