<div>
    {{-- Boton de nuevo post --}}
    <div class="flex justify-begin">
        <x-button wire:click="new">
            New
        </x-button>
    </div>

    {{-- Listado de post presente en la DB --}}
    <div class="mt-8 bg-white shadow rounded-lg p-6">
        <ul class="list-disc list-inside space-y-2">
            @foreach ($posts as $pos )
                <li class="flex justify-between" wire:key="post-{{$pos->id}}">
                    {{$pos->title}}
                    <span>
                        <x-button wire:click="edit({{$pos->id}})">
                            Edit
                        </x-button>
                        <x-danger-button wire:click="delete({{$pos->id}})">
                            Delete
                        </x-danger-button>
                    </span>
                </li>
                
            @endforeach
            
        </ul>
        <div class="mt-4">
            {{$posts->links()}}
        </div>
    </div>

    {{-- Formulario para el crud --}}
    <form wire:submit="sendForm">
        <x-dialog-modal class="mt-4" wire:model="post.open">
            <x-slot name="title">
                @if($post->action==="new")
                    {{__('Create a new post')}}
                @elseif($post->action==="edit")
                    {{__('Update a post')}}
                @else
                    <div class="text-white bg-red-700">
                        {{__('¡¿Confirm that you want to delete this post?!')}}
                    </div>
                @endif
            </x-slot>

            <x-slot name="content">
                <div class="w-full mb-4">
                    @if($post->image)
                        {{-- @if($post->image->temporaryUrl()) --}}
                            <img src='{{ $post->image->temporaryUrl() }}' alt='nada'>
                        {{-- @else
                            <img src='{{ $post->image->path }}' alt='nada'>
                            @dump($post->image)
                        @endif --}}
                    @endif
                </div>
                <div class="mb-4">
                    <x-label>
                        Titulo del post
                    </x-label>
                    @if($post->action==='delete')
                        <x-input class="w-full" wire:model.live="post.title" required readonly/>
                    @else
                        <x-input class="w-full" wire:model.live="post.title" required/>
                    @endif
                    
                    <x-input-error for='post.title'></x-input-error>
                </div>
                <div class="mb-4">
                    <x-label>
                        Contenido
                    </x-label>
                    @if($post->action==='delete')
                        <x-textarea class="w-full" wire:model="post.content" required readonly></x-textarea>
                    @else
                        <x-textarea class="w-full" wire:model="post.content" required></x-textarea>
                    @endif
                    <x-input-error for='post.content'></x-input-error>
                </div>
                <div class="mb-4">
                    <x-label>Categoria</x-label>
                    @if($post->action==='delete')
                        <x-select class="w-full"  wire:model="post.category_id" required disabled>
                            <option value="" disabled>Seleccionte una categoria</option>
                            @foreach ($categories as $category)
                                <option value="{{$category->id}}">
                                    ({{$category->id}})-{{$category->name}}
                                </option>
                            @endforeach
                    </x-select>
                    @else
                        <x-select class="w-full"  wire:model="post.category_id" required>
                            <option value="" disabled>Seleccionte una categoria</option>
                            @foreach ($categories as $category)
                                <option value="{{$category->id}}">
                                    ({{$category->id}})-{{$category->name}}
                                </option>
                            @endforeach
                        </x-select>
                    @endif
                        
                    <x-input-error for='post.category_id'></x-input-error>
                </div>
                <div class="mb-4">
                    <x-label>Imagen</x-label>
                    <div
                        x-data="{ uploading: false, progress: 0 }"
                        x-on:livewire-upload-start="uploading = true"
                        x-on:livewire-upload-finish="uploading = false"
                        x-on:livewire-upload-cancel="uploading = false"
                        x-on:livewire-upload-error="uploading = false"
                        x-on:livewire-upload-progress="progress = $event.detail.progress">

                        <x-input type="file" wire:model="post.image" 
                                            wire:key="{{$post->imageKey}}"/>

                        <!-- Progress Bar -->
                        <div x-show="uploading">
                            <progress  max="100" x-bind:value="progress"></progress>
                        </div>
                    </div>
                    <x-input-error for='post.image'></x-input-error>
                </div>
                <div class="mb-4">
                    <x-label>Etiquetas</x-label>
                    <ul class="columns-5">
                        @foreach ($tags as $tag)
                            <li>
                                <label>
                                    @if($post->action==='delete')
                                        <x-checkbox  wire:model="post.tags" value="{{$tag->id}}" disabled/>
                                            {{$tag->name}}
                                    @else
                                        <x-checkbox  wire:model="post.tags" value="{{$tag->id}}"/>
                                            {{$tag->name}}
                                    @endif
                                    
                                </label>
                            </li>
                        @endforeach
                    </ul>
                    <x-input-error for='post.tags'></x-input-error>
                </div>
                
            </x-slot>

            <x-slot name="footer">
                <div class="grid grid-cols-12">
                    <div class="mb-4 col-start-1 col-end-3 bg-yellow-300 text-red-700 font-bold" wire:loading wire:target="sendForm">
                        Procesando...
                    </div>
                    <div class="col-start-4 col-end-13 col-span-2">
                        <x-danger-button class="mr-2" wire:click="cancel" wire:keydown.escape="cancel">
                            {{__('Cancel')}}
                        </x-danger-button>
                        @if($post->action==="new")
                            <x-button class="disabled:opacity-30" wire:target="sendForm" wire:loading.attr="disabled">
                                {{__('Create')}}
                            </x-button>
                        @elseif($post->action==="edit")
                            <x-button class="disabled:opacity-30" wire:target="sendForm" wire:loading.attr="disabled">
                                {{__('Update')}}
                            </x-button>
                        @elseif($post->action==="delete")
                            <x-button class="disabled:opacity-30" wire:target="sendForm" wire:loading.attr="disabled">
                                {{__('Delete')}}
                            </x-button>
                        @endif
                        
                    </div>
                </div>
            </x-slot>
        </x-dialog-modal>
    </form>



    @push('js')
        <script>
            // document.addEventListener('livewire:initialized', function () {});
            
            Livewire.on('postAction',function(message){
                console.log(message);                
            })
        </script>        
    @endpush
</div>
