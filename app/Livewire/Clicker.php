<?php

namespace App\Livewire;

use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Livewire\Attributes\Rule;
use Livewire\Component;
use Livewire\WithPagination;

class Clicker extends Component
{
    use WithPagination;

    #[Rule('required|min:2|max:50')]
    public $name;

    #[Rule('required|email|unique:users')]
    public $email;

    #[Rule('required|min:5')]
    public $password;
    public function createNewUser()
    {
        $validator = $this->validate();

        User::create([
            'name' => $validator['name'],
            'email' => $validator['email'],
            'password' => Hash::make($validator['password']),
        ]);

        $this->reset(['name', 'email', 'password']);

        request()->session()->flash('success', 'User Created Successfully!');
    }
    public function render()
    {
        $users = User::paginate(5);

        return view('livewire.clicker',[
            'users' => $users,
        ]);
    }
}
