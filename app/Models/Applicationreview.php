<?php

namespace App\Models;

use App\Scopes\StatusScope;
use Illuminate\Support\Str;

use Spatie\Activitylog\LogOptions;
use Illuminate\Support\Facades\Auth;
use Illuminate\Database\Eloquent\Model;
use Spatie\Activitylog\Traits\LogsActivity;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Applicationreview extends Model
{
    use HasFactory, LogsActivity;
    public $timestamps = true;
    protected $guarded = ['id'];
    protected $table = 'applications';

    protected static $recordEvents = ['updated','deleted'];

    public function getActivitylogOptions(): LogOptions
    {
        return LogOptions::defaults()
        ->useLogName('applications')
        ->logAll()
        //->logOnly(['name'])
        ->setDescriptionForEvent(fn(string $eventName) => $eventName)
        //->dontLogIfAttributesChangedOnly(['sort'])
        ->logOnlyDirty()
        ->dontSubmitEmptyLogs();
    }

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
    }

    public function association() {
        return $this->belongsTo(Association::class,'association_id');
    }

    public function area() {
        return $this->belongsTo(Area::class,'area_id');
    }

    public function branch() {
        return $this->belongsTo(Branch::class,'branch_id');
    }

    public function category() {
        return $this->belongsTo(Category::class,'category_id');
    }

    public function service() {
        return $this->belongsTo(Service::class,'service_id');
    }

    public function serviceType() {
        return $this->belongsTo(ServiceType::class,'service_type_id');
    }

    public function user() {
        return $this->belongsTo(User::class,'user_id');
    }

    public function approval() {
        return $this->belongsTo(Approval::class,'approval_id');
    }

    public function file() {
        return $this->hasMany(File::class,'application_id','id');
    }



    # UserTypeWiseData
    public function scopeUtwd($query) {

        $authUser = Auth::guard('admin')->user()->load(['userType']);
        
        if($authUser->userType->default_role == Admin::DEFAULT_ROLE_LIST[11]){
            return $query->where(['created_by'=>$authUser->id]);
        } elseif($authUser->userType->default_role == Admin::DEFAULT_ROLE_LIST[10]){
            return $query->where(['area_id'=>$authUser->area_id,'branch_id'=>$authUser->branch_id]);
        } elseif($authUser->userType->default_role == Admin::DEFAULT_ROLE_LIST[9]){
            return $query->where(['area_id'=>$authUser->area_id,'branch_id'=>$authUser->branch_id]);
        } elseif($authUser->userType->default_role == Admin::DEFAULT_ROLE_LIST[8]){
            return $query->where(['area_id'=>$authUser->area_id]);
        } elseif($authUser->userType->default_role == Admin::DEFAULT_ROLE_LIST[7]){
            return $query->where(['area_id'=>$authUser->area_id]);
        } elseif($authUser->userType->default_role == Admin::DEFAULT_ROLE_LIST[6]){
            return $query->where(['area_id'=>$authUser->area_id]);
        } elseif($authUser->userType->default_role == Admin::DEFAULT_ROLE_LIST[5]){
            return $query->where(['area_id'=>$authUser->area_id]);
        } elseif($authUser->userType->default_role == Admin::DEFAULT_ROLE_LIST[3]){
            return $query->where('service_type_id','!=',Admin::MOEWOE);
        } elseif($authUser->userType->default_role == Admin::DEFAULT_ROLE_LIST[4]){
            return $query->where('service_type_id','!=',Admin::MOFA);
        } else{
            return $query;
        }

        return $query;
    }

    # ServiceTypeWiseData
    public function scopeStwd($query) {

        $authUser = Auth::guard('admin')->user()->load(['userType']);
        
        if($authUser->userType->default_role == Admin::DEFAULT_ROLE_LIST[3]){
            return $query->where('service_type_id','!=',Admin::MOEWOE);
        } elseif($authUser->userType->default_role == Admin::DEFAULT_ROLE_LIST[4]){
            return $query->where('service_type_id','!=',Admin::MOFA);
        } else{
            return $query;
        }

        return $query;
    }
}
