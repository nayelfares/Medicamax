<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\Status;
use Webpatser\Uuid\Uuid;
use Illuminate\Database\Eloquent\SoftDeletes;
class Unit extends Model
{
    // use SoftDeletes;
     protected $dates = ['deleted_at'];
    /**
     * The table associated with the model.
     *
     * @var string 
     */ 
    protected $table = 'units';
 
 
    public static function boot()
    {
        parent::boot();
        self::creating(function ($model) {
            $model->uuid = (string) Uuid::generate();
        });
    }
    
    public function getRouteKeyName()
    {
        return 'uuid';
    }
    /**
    * The attributes that aren't mass assignable.
    *
    * @var array
    */
    protected $guarded = [];

    protected $fillable =['en_name','ar_name','status_id'];

}
