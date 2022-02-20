<?php

namespace App\Http\Controllers;

use App\Models\Todo;
use Illuminate\Http\Request;

class TodoController extends Controller
{
    private $todo;

    public function __construct(Todo $todo)
    {
        $this->todo = $todo;
    }

    public function showIndex()
    {
        $todos = $this->todo->getAll();
        // dd($todo)；
        return view('todo.index', compact('todos'));
    }

    public function showCreateView()
    {
        return view('todo.create');
    }

    public function create(Request $request)
    {
        $this->todo->oneCreate($request);
        return redirect()->to('todo');
    }

    public function showUpdateView($todo_id)
    {
        $todo = $this->todo->oneGet($todo_id);
        return view('todo.update', compact('todo'));
    }

    public function update(Request $request, $todo_id)
    {
        $this->todo->oneUpdate($request, $todo_id);
        return redirect()->to('todo');
    }

    public function delete($todo_id)
    {
        $this->todo->oneDelete($todo_id);
        return redirect()->to('todo');
    }
}
