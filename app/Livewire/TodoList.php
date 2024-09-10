<?php

namespace App\Livewire;

use App\Models\Todo;
use Livewire\Attributes\Rule;
use Livewire\Component;
use Livewire\WithPagination;

class TodoList extends Component
{
    use WithPagination;

    #[Rule('required|min:3|max:50')]
    public $name;

    public $search;

    public function create()
    {
        //validate
        $validated = $this->validateOnly('name');
        //create the todo
        Todo::create($validated);
        //clear input
        $this->reset('name');
        //send flash message
        session()->flash('success' , 'created');
    }
    public function render()
    {
        return view('livewire.todo-list', [
            'todos' => Todo::latest()->paginate(3)
        ]);
    }
}
