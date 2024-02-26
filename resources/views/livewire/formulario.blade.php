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
            @foreach ($posts as $post )
                <li class="flex justify-between" wire:key="post-{{$post->id}}">
                    {{$post->title}}
                    <span>
                        <x-button wire:click="edit({{$post->id}})">
                            Edit
                        </x-button>
                        <x-danger-button wire:click="delete({{$post->id}})">
                            Delete
                        </x-danger-button>
                    </span>
                </li>
                
            @endforeach
            
        </ul>
    </div>

    {{-- Formulario para el crud --}}
    <form wire:submit="sendForm">
        <x-dialog-modal wire:model="open">

            <x-slot name="title">
                @if($action==="new")
                    {{__('Create a new post')}}
                @elseif($action==="edit")
                    {{__('Update a post')}}
                @else
                    <div class="text-white bg-red-700">
                        {{__('¡¿Confirm that you want to delete this post?!')}}
                    </div>
                @endif
            </x-slot>

            <x-slot name="content">                
                <div class="mb-4">
                    <x-label>
                        Titulo del post
                    </x-label>
                    <x-input class="w-full" wire:model="post.title" required/>
                    <x-input-error for='post.title'></x-input-error>
                </div>
                <div class="mb-4">
                    <x-label>
                        Contenido
                    </x-label>
                    <x-textarea class="w-full" wire:model="post.content" required></x-textarea>
                    <x-input-error for='post.content'></x-input-error>
                </div>
                <div class="mb-4">
                    <x-label>Categoria</x-label>
                    
                    <x-select class="w-full"  wire:model="post.category_id" required>
                        <option value="" disabled>Seleccionte una categoria</option>
                        @foreach ($categories as $category)
                            <option value="{{$category->id}}">
                                ({{$category->id}})-{{$category->name}}
                            </option>
                        @endforeach
                    </x-select>
                    <x-input-error for='post.category_id'></x-input-error>
                </div>
                <div class="mb-4">
                    <x-label>Etiquetas</x-label>
                    <ul class="columns-5">
                        @foreach ($tags as $tag)
                            <li>
                                <label>
                                    <x-checkbox  wire:model="post.tags" value="{{$tag->id}}"/>
                                        {{$tag->name}}
                                    
                                </label>
                            </li>
                        @endforeach
                    </ul>
                    <x-input-error for='post.tags'></x-input-error>
                </div>
            </x-slot>

            <x-slot name="footer">
                <div class="flex justify-end">
                    <x-danger-button class="mr-2" wire:click="$set('open',false)">
                        {{__('Cancel')}}
                    </x-danger-button>
                    @if($action==="new")
                        <x-button>{{__('Create')}}</x-button>
                    @elseif($action==="edit")
                        <x-button>{{__('Update')}}</x-button>
                    @else
                        <x-button>{{__('Delete')}}</x-button>
                    @endif
                    
                </div>
            </x-slot>
        </x-dialog-modal>
    </form>
</div>
