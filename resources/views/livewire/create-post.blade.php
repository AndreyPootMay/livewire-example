<div>
    <x-jet-danger-button wire:click="$set('open', true)">
        Create new post
    </x-jet-danger-button>

    <x-jet-dialog-modal wire:model="open">
        <x-slot name="title">
            New post
        </x-slot>

        <x-slot name="content">
            <div wire:loading wire:target="image"
                class="bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded relative" role="alert">
                <strong class="font-bold">Wait!</strong>
                <span class="block sm:inline">The image is uploading, wait a moment...</span>
                <span class="absolute top-0 bottom-0 right-0 px-4 py-3">
                    <svg class="fill-current h-6 w-6 text-red-500" role="button" xmlns="http://www.w3.org/2000/svg"
                        viewBox="0 0 20 20">
                        <title>Close</title>
                        <path
                            d="M14.348 14.849a1.2 1.2 0 0 1-1.697 0L10 11.819l-2.651 3.029a1.2 1.2 0 1 1-1.697-1.697l2.758-3.15-2.759-3.152a1.2 1.2 0 1 1 1.697-1.697L10 8.183l2.651-3.031a1.2 1.2 0 1 1 1.697 1.697l-2.758 3.152 2.758 3.15a1.2 1.2 0 0 1 0 1.698z" />
                    </svg>
                </span>
            </div>


            @if ($image)
                <img class="mb-4" src="{{ $image->temporaryUrl() }}">
            @endif
            <div class="mb-4">
                <x-jet-label value="Title" />
                <x-jet-input type="text" class="w-full" wire:model="title" />

                <x-jet-input-error for="title" />
            </div>

            <div class="mb-4">
                <x-jet-label value="Content" />
                <textarea type="text" class="form-comtrol w-full" rows="6" wire:model="content" /></textarea>

                <x-jet-input-error for="content" />
            </div>

            <div class="mb-4">
                <input type="file" wire:model="image" id="{{ $identifier }}">

                <x-jet-input-error for="image" />
            </div>
        </x-slot>

        <x-slot name="footer">
            <x-jet-secondary-button wire:click="$set('open', false)" wire:loading.attr="disabled"
                wire:target="save, image" class="disabled:opacity-25">
                Cancel
            </x-jet-secondary-button>
            <x-jet-danger-button wire:click="save">
                Save
            </x-jet-danger-button>
        </x-slot>
    </x-jet-dialog-modal>
</div>
