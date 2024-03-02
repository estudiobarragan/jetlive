<div>
    <x-button class="mb-4" wire:click='redirigir'>
        Ir a SPA
    </x-button>

    <h1 class="test-2xl font-semibold">
        Soy el padre y me llamo {{ $name }}
    </h1>

    <div>
        Desde el padre fijo:
        <x-input class="w-full" wire:model.live="name" required/>
        Desde el padre con hijo reactivo:
        <x-input class="w-full" wire:model.live="name1" required/>
        Desde el padre bidireccional
        <x-input class="w-full" wire:model.live="name2" required/>

        @livewire('children',['name' => $name,'tipo'=>1])
        @livewire('children',['name1' => $name1,'tipo'=>2])
        <livewire:children wire:model='name2' :key='$name2'/>
    </div>
</div>
