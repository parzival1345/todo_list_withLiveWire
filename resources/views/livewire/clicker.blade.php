<div>
    @if(session('success'))
        <span class="px-3 py-3 bg-green-300 text-white rounded"> {{ session('success') }} </span>
    @endif
    <form wire:submit="createNewUser" action="">

        <input class="block rounded border border-gray-100 px-3 mt-2" wire:model="name" type="text" placeholder="name">
        <br>
        @error('name')
        <span class="text-red-500 text-xs"> {{ $message }} </span>
        @enderror

        <input class="block rounded border border-gray-100 px-3 mt-2" wire:model="email" type="email" placeholder="email">
        <br>
        @error('email')
        <span class="text-red-500 text-xs"> {{ $message }} </span>
        @enderror

        <input class="block rounded border border-gray-100 px-3 mt-2" wire:model="password" type="password" placeholder="password">
        <br>
        @error('password')
        <span class="text-red-500 text-xs"> {{ $message }} </span>
        @enderror

        <button class="block rounded px-3 py-1 bg-gray-400 text-white"> Create </button>
    </form>

    <hr>

    @foreach($users as $user)
        {{ $user->name }}
        <hr>
    @endforeach
</div>
