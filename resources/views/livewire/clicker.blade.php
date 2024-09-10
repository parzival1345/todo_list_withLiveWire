<div>
    @if(session('success'))
        <span class="px-3 py-3 bg-green-300 text-white rounded"> {{ session('success') }} </span>
    @endif
    <form wire:submit="createNewUser" action="">

        <input class="rounded border border-gray-100 px-3 py-1 my-2" wire:model="name" type="text" placeholder="name">
        <br>
        @error('name')<span class="text-xs text-red-500 block"> {{ $message }} </span>@enderror

        <input class="rounded border border-gray-100 px-3 py-1 my-2" wire:model="email" type="email" placeholder="email">
        <br>
        @error('email')<span class="text-xs text-red-500 block"> {{ $message }} </span>@enderror

        <input class="rounded border border-gray-100 px-3 py-1 my-2" wire:model="password" type="password" placeholder="password">
        <br>
        @error('password')<span class="text-xs text-red-500 block"> {{ $message }} </span>@enderror

        <button class="mt-2 px-3 py-1 bg-gray-400 rounded text-white"> Create </button>
    </form>

    <hr>

    @foreach($users as $user)
        {{ $user->name }}
        <hr>
    @endforeach
        <br>
    {{ $users->links('vendor.livewire.simple-tailwind') }}
</div>
