<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Validation\Rule;

class Task extends Model
{
    /** @use HasFactory<\Database\Factories\TaskFactory> */
    use HasFactory;

    const LIMIT_MAX = 1000;

    public $timestamps = false;
    protected $table = 'tasks';
    protected $primaryKey = 'id';
    protected $fillable = ['title', 'description', 'status'];
    protected $attributes = ['status' => 'new'];

    /**
     * Правила валидации модели Task
     * @return array
     */
    public static function rules(): array
    {
        return [
            'title' => ['required', 'max:255'],
            'description' => ['max:2048'],
            'status' => Rule::in(['', 'new', 'inwork', 'done']),
        ];
    }
}
