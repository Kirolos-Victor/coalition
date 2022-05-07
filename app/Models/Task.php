<?php
namespace App\Models;

use App\Observers\TaskObserver;
use App\Scopes\PriorityScope;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Task extends Model
{
    use HasFactory;

    protected $table = 'tasks';
    protected $fillable = ['id', 'name', 'priority', 'project_id', 'created_at', 'updated_at'];
    public $timestamps = true;

    public function fetchTasks($request)
    {
        if ($request->has('project_id')) {
            $tasks = self::with('project')->where('project_id', '=', $request->project_id)->get();
        } else {
            $tasks = self::with('project')->get();
        }
        return $tasks;
    }

    public function project()
    {
        return $this->belongsTo(Project::class, 'project_id', 'id');
    }

    public function getCreatedAtAttribute($value)
    {
        return Carbon::parse($value)->diffForHumans();
    }

    public function getUpdatedAtAttribute($value)
    {
        return Carbon::parse($value)->diffForHumans();
    }

    protected static function boot()
    {
        parent::boot();
        self::observe(TaskObserver::class);
        static::addGlobalScope(new PriorityScope());
    }
}
