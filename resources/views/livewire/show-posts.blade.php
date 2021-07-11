<div>
    <x-slot name="header">
        <h2 class="font-semibold text-x1 text-gray-800 leading-tight">
            {{ __('Dashboard') }}
        </h2>
    </x-slot>
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-12">
        <x-table>
            <div class="px-6 py-4 flex items-center">
                <x-jet-input type="text" class="flex-1 mr-4" placeholder="Search..." wire:model="search" />

                @livewire('create-post')
            </div>
            @if ($posts->count() > 0)
                <table class="min-w-full divide-y divide-gray-200">
                    <thead class="bg-gray-50">
                        <tr>
                            <th scope="col"
                                class="w-24 cursor-pointer px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider"
                                wire:click="order('id')">
                                Id
                                @if ($sort == 'id')
                                    @if ($direction == 'desc')
                                        <i class="fa fa-sort-desc float-right mt-1"></i>
                                    @else
                                        <i class="fa fa-sort-asc float-right mt-1"></i>
                                    @endif
                                @else
                                    <i class="fa fa-sort float-right mt-1"></i>
                                @endif
                            </th>
                            <th scope="col"
                                class="cursor-pointer px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider"
                                wire:click="order('title')">
                                Title
                                @if ($sort == 'title')
                                    @if ($direction == 'desc')
                                        <i class="fa fa-sort-desc float-right mt-1"></i>
                                    @else
                                        <i class="fa fa-sort-asc float-right mt-1"></i>
                                    @endif
                                @else
                                    <i class="fa fa-sort float-right mt-1"></i>
                                @endif
                            </th>
                            <th scope="col"
                                class="cursor-pointer px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider"
                                wire:click="order('content')">
                                Content
                                @if ($sort == 'content')
                                    @if ($direction == 'desc')
                                        <i class="fa fa-sort-desc float-right mt-1"></i>
                                    @else
                                        <i class="fa fa-sort-asc float-right mt-1"></i>
                                    @endif
                                @else
                                    <i class="fa fa-sort float-right mt-1"></i>
                                @endif
                            </th>
                            <th scope="col" class="relative px-6 py-3">
                                Status
                            </th>
                            <th scope="col" class="relative px-6 py-3">
                                <span class="sr-only">Actions</span>
                            </th>
                        </tr>
                    </thead>
                    <tbody class="bg-white divide-y divide-gray-200">
                        @foreach ($posts as $post)
                            <tr>
                                <td class="px-6 py-4">
                                    <div class="flex items-center">
                                        <div class="text-sm font-medium text-gray-900">
                                            {{ $post->id }}
                                        </div>
                                    </div>
                                </td>
                                <td class="px-6 py-4">
                                    <div class="text-sm text-gray-900">{{ $post->title }}</div>
                                </td>
                                <td class="px-6 py-4">
                                    <span class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full">
                                        {{ $post->content }}
                                    </span>
                                </td>
                                <td class="px-6 py-4">
                                    @if ($post->active)
                                        <span
                                            class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full bg-green-100 text-green-800">
                                            Active
                                        </span>
                                    @else
                                        <span
                                            class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full bg-red-100 text-green-800">
                                            Inactive
                                        </span>
                                    @endif
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap text-sm font-medium">
                                    {{-- @livewire('edit-post', ['post' => $post], key($post->id)) --}}
                                    <a wire:click="edit({{ $post }})" class="btn btn-green">
                                        <i class="fas fa-edit"></i>
                                    </a>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            @else
                <div class="px-6 py-4">
                    Empty set.
                </div>
            @endif
        </x-table>
    </div>
</div>
