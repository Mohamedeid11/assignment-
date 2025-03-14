<?php

namespace App\Models;

use App\ModelFilters\ProjectFilter;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use EloquentFilter\Filterable;

class Project extends Model
{
    use HasFactory, Filterable;

    protected $fillable = ['name', 'status'];

    public function users()
    {
        return $this->belongsToMany(User::class);
    }

    public function timesheets()
    {
        return $this->hasMany(Timesheet::class);
    }

    public function attributes()
    {
        return $this->morphMany(AttributeValue::class, 'entity');
    }

    public function modelFilter()
    {
        return $this->provideFilter(ProjectFilter::class);
    }
}
