<?php

namespace App\Models;

use App\Scopes\StatusScope;
use Illuminate\Support\Str;

use Spatie\Activitylog\LogOptions;
use App\Scopes\TitleAscendingScope;

use Illuminate\Support\Facades\Auth;
use Illuminate\Database\Eloquent\Model;
use Spatie\Activitylog\Traits\LogsActivity;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Branch extends Model
{
    use HasFactory, LogsActivity;
    public $timestamps = true;
    protected $guarded = ['id'];

    protected static $recordEvents = ['updated','deleted'];

    public function getActivitylogOptions(): LogOptions
    {
        return LogOptions::defaults()
        ->useLogName('branches')
        ->logAll()
        //->logOnly(['name'])
        ->setDescriptionForEvent(fn(string $eventName) => $eventName)
        //->dontLogIfAttributesChangedOnly(['sort'])
        ->logOnlyDirty()
        ->dontSubmitEmptyLogs();
    }

    protected $casts = [
        //'status' => 'boolean',
        'email_verified_at' => 'datetime',
    ];

    public function getStatusAttribute($value)
    {
        return $status = (app()->getLocale() == 'en') ? Status::EN[$value] : Status::BN[$value];
    }

    // public function scopeActive($query)
    // {
    //     return $query->where('status',1);
    // }


    //Admin::withoutGlobalScopes([FirstScope::class, SecondScope::class])->get();

    protected static function booted()
    {
        static::addGlobalScope(new StatusScope);
        static::addGlobalScope(new TitleAscendingScope);
    }

    public function officeType() {
        return $this->belongsTo(OfficeType::class,'office_type_id');
    }

    public function association() {
        return $this->belongsTo(Association::class,'association_id');
    }

    public function area() {
        return $this->belongsTo(Area::class,'area_id');
    }

    # UserTypeWiseData
    public function scopeUtwd($query) {

        $authUser = Auth::guard('admin')->user()->load(['userType']);
        
        if($authUser->userType->default_role == Admin::DEFAULT_ROLE_LIST[11]){
            return $query->where(['id'=>$authUser->area_id]);
        } elseif($authUser->userType->default_role == Admin::DEFAULT_ROLE_LIST[10]){
            return $query->where(['id'=>$authUser->area_id]);
        } elseif($authUser->userType->default_role == Admin::DEFAULT_ROLE_LIST[9]){
            return $query->where(['id'=>$authUser->area_id]);
        } elseif($authUser->userType->default_role == Admin::DEFAULT_ROLE_LIST[8]){
            return $query->where(['id'=>$authUser->area_id]);
        } elseif($authUser->userType->default_role == Admin::DEFAULT_ROLE_LIST[7]){
            return $query->where(['id'=>$authUser->area_id]);
        } elseif($authUser->userType->default_role == Admin::DEFAULT_ROLE_LIST[6]){
            return $query->where(['id'=>$authUser->area_id]);
        } elseif($authUser->userType->default_role == Admin::DEFAULT_ROLE_LIST[5]){
            return $query->where(['id'=>$authUser->area_id]);
        } else{
            return $query;
        }

        return $query;
    }
}
