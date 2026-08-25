<?php
// app/Models/Category.php
namespace App\Models;
use Illuminate\Database\Eloquent\Model;

class Category extends Model {
    protected $fillable = ['key','name_ar','name_en','icon','color','bg','is_active','sort_order'];
    protected $casts    = ['is_active' => 'boolean'];

    public function entities() {
        return $this->hasMany(Entity::class)->orderBy('sort_order');
    }
}

/* ──────────────────────────────────── */

// app/Models/Entity.php
namespace App\Models;
use Illuminate\Database\Eloquent\Model;

class Entity extends Model {
    protected $fillable = ['category_id','name_ar','name_en','icon','color','bg','tag_ar','tag_en','is_active','sort_order'];
    protected $casts    = ['is_active' => 'boolean'];

    public function category() { return $this->belongsTo(Category::class); }
    public function services() { return $this->hasMany(Service::class)->orderBy('sort_order'); }
    public function requests() { return $this->hasMany(ServiceRequest::class); }
}

/* ──────────────────────────────────── */

// app/Models/Service.php
namespace App\Models;
use Illuminate\Database\Eloquent\Model;

class Service extends Model {
    protected $fillable = [
        'entity_id','name_ar','name_en','icon',
        'price','description_ar','description_en',
        'estimated_days','is_active','sort_order'
    ];
    protected $casts = [
        'price'         => 'decimal:2',
        'is_active'     => 'boolean',
        'estimated_days'=> 'integer',
    ];

    public function entity()   { return $this->belongsTo(Entity::class); }
    public function requests() { return $this->hasMany(ServiceRequest::class); }
}

/* ──────────────────────────────────── */

// app/Models/ServiceRequest.php
namespace App\Models;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;

class ServiceRequest extends Model {
    protected $fillable = [
        'ref_number','user_id','service_id','entity_id',
        'client_name','client_email','client_phone','client_id_number',
        'company_name','company_cr','notes','attachments',
        'price','status','reject_reason',
        'estimated_completion','completed_at','handled_by',
    ];
    protected $casts = [
        'attachments'  => 'array',
        'price'        => 'decimal:2',
        'completed_at' => 'datetime',
    ];

    protected static function boot() {
        parent::boot();
        static::creating(function ($model) {
            if (empty($model->ref_number)) {
                $model->ref_number = 'AMR-' . strtoupper(Str::random(6));
            }
        });
    }

    public function user()    { return $this->belongsTo(User::class); }
    public function service() { return $this->belongsTo(Service::class); }
    public function entity()  { return $this->belongsTo(Entity::class); }
    public function handler() { return $this->belongsTo(User::class, 'handled_by'); }
    public function logs()    { return $this->hasMany(RequestLog::class, 'request_id')->orderBy('created_at', 'desc'); }
    public function payment() { return $this->hasOne(Payment::class, 'request_id'); }

    public function getStatusLabelAttribute(): array {
        return match($this->status) {
            'pending'    => ['ar' => 'قيد الانتظار',    'en' => 'Pending'],
            'processing' => ['ar' => 'جاري المعالجة',   'en' => 'Processing'],
            'in_progress'=> ['ar' => 'قيد التنفيذ',     'en' => 'In Progress'],
            'done'       => ['ar' => 'تمت العملية',      'en' => 'Completed'],
            'rejected'   => ['ar' => 'مرفوض',            'en' => 'Rejected'],
            default      => ['ar' => 'غير معروف',        'en' => 'Unknown'],
        };
    }
}

/* ──────────────────────────────────── */

// app/Models/RequestLog.php
namespace App\Models;
use Illuminate\Database\Eloquent\Model;

class RequestLog extends Model {
    protected $fillable = ['request_id','user_id','status','note'];
    public function request() { return $this->belongsTo(ServiceRequest::class, 'request_id'); }
    public function user()    { return $this->belongsTo(User::class); }
}

/* ──────────────────────────────────── */

// app/Models/Payment.php
namespace App\Models;
use Illuminate\Database\Eloquent\Model;

class Payment extends Model {
    protected $fillable = [
        'user_id','request_id','amount','type',
        'description_ar','description_en','status','transaction_ref'
    ];
    protected $casts = ['amount' => 'decimal:2'];
    public function user()    { return $this->belongsTo(User::class); }
    public function request() { return $this->belongsTo(ServiceRequest::class, 'request_id'); }
}
