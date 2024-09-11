<?php

namespace App\Livewire;

use App\Models\Todo;
use Livewire\Attributes\Rule;
use Livewire\Component;
use Livewire\WithPagination;
use Mockery\Exception;

class TodoList extends Component
{
    use WithPagination;

    #[Rule('required|min:3|max:50')]
    public $name;

    public $search;

    public $editingTodoID;
    #[Rule('required|min:3|max:50')]
    public $editingTodoName;

    public function create()
    {
        //validate
        $validated = $this->validateOnly('name');
        //create the todo
        Todo::create($validated);
        //clear input
        $this->reset('name');
        //send flash message
        session()->flash('success', 'created');

        $this->resetPage();
    }

    public function delete($todoID)
    {
        try {
            Todo::find($todoID)->delete();
        } catch (Exception $e) {
            session()->flash('error', 'Field to delete todo!');
            return;
        }

    }

    public function toggle($todoID)
    {
        $todo = Todo::find($todoID);
        $todo->completed = !$todo->completed;
        $todo->save();
    }

    public function edit($todoID)
    {
        $this->editingTodoID = $todoID;
        $this->editingTodoName = Todo::find($todoID)->name;
    }

    public function update()
    {
        $this->validateOnly('editingTodoName');
        Todo::find($this->editingTodoID)->update([
            'name' => $this->editingTodoName
        ]);

        $this->cancel();
    }

    public function cancel()
    {
        $this->reset('editingTodoID', 'editingTodoName');
    }

    public function render()
    {
        return view('livewire.todo-list', [
            'todos' => Todo::latest()->where('name', 'like', "%{$this->search}%")->paginate(3)
        ]);
    }
}
