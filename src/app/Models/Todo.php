<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Todo extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'title',
        'content',
    ];

    public function getAll()
    {
        return $this->all();
    }

    public function oneCreate($request)
    {
        $request['user_id'] = 1;
        $this->fill($request->all())->save();
    }

    public function oneGet($todo_id)
    {
        return $this->find($todo_id);
    }

    public function oneUpdate($request, $todo_id)
    {
        $target = $this->find($todo_id);
        $target->update($request->all());
    }

    public function oneDelete($todo_id)
    {
        $this->find($todo_id)->delete();
    }
}
