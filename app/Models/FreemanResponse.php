<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class FreemanResponse extends Model
{
    use HasFactory;

    /**
     * The attributes that aren't mass assignable.
     *
     * @var array
     */
    protected $guarded = [];

    public function workorder()
    {
        return $this->hasone(Workorder::class,'id', 'workorderid');
    }
    public function freeman()
    {
        return $this->hasone(FreeManReg::class,'id', 'freemanid');
    }
}
