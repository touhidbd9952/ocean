<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Workorder extends Model
{
    use HasFactory;

    /**
     * The attributes that aren't mass assignable.
     *
     * @var array
     */
    protected $guarded = [];

    public function customer()
    {
        return $this->hasone(CustomerReg::class,'id', 'cusid');
    }
    public function worktype()
    {
        return $this->hasone(Worktype::class,'id', 'worktypeid');
    }
    public function work()
    {
        return $this->hasone(Work::class,'id', 'workid');
    }
}
