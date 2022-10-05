<?php

namespace App\Core\Project\Models;

use Illuminate\Database\Eloquent\Model;

class Project extends Model
{

    /**
     * The attributes that are mass assignable.
     *
     * @var string[]
     */
    protected $fillable = [
        'name', 'description'
    ];

    /**
     * Get project users.
     */
    public function users()
    {
        return $this->belongsToMany(User::class, 'user_projects', 'user_id', 'project_id');
    }
}
