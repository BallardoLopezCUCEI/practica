<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Task extends Model
{
     /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'tasks';
    /**
     * The primary key associated with the table.
     *
     * @var string
     */
    protected $primaryKey = 'id';
    protected $fillable = ['title', 'description', 'completed'];
    use HasFactory;
}
