<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Task extends Model
{
    /**
    *  the attributes that are mass assignable
    *
    *  @var array
    */
    protected $fillable = ['name'];

    /**
     * Get the user the owns the task
     */
    public function user()
    {
      return $this->belongsTo(User::class);
    }
}
