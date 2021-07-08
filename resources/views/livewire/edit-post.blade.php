<div>
    <a class="btn btn-green" wire:click="$set('open', true)">
        <i class="fa fa-edit"></i>
    </a>

    <x-jet-dialog-modal wire:model="open">
        <x-slot name="title">
            Update post: {{ $post->title }}
        </x-slot>
        <x-slot name="content">
            <div class="mb-4">
                <x-jet-label value="Título del post" />
                <x-jet-input wire:model="post.title" type="text" class="w-full" />
            </div>
            <div class="mb-4">
                <x-jet-label value="Contenido del post" />
                <textarea wire:model="post.content" rows="10" class="form-control"></textarea>
            </div>
        </x-slot>
        <x-slot name="footer">
            <x-jet-secondary-button wire:click="$set('open', false)">
                Cancel
            </x-jet-secondary-button>
            <x-jet-secondary-button wire:click="save" wire:loading.attr="disabled" class="disabled-opacity-25">
                Save
            </x-jet-secondary-button>
        </x-slot>
    </x-jet-dialog-modal>
</div>
