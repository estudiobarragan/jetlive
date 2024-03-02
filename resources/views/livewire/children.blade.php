<div>
    <H3 class="ml-4">

        @if($tipo===1)
            Desde el hijo fijo:
            <x-input class="w-full" wire:model.live="name"/>
        @elseif($tipo===2)
            Desde el hijo Reactivo:
            <x-input class="w-full" wire:model.live="name1" readonly/>
        @else
            Desde el hijo bidireccional
            <x-input class="w-full" wire:model.live="name2"/>
        @endif
    </H3>
</div>
