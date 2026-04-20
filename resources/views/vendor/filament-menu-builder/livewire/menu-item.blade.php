<div class="item" data-id="{{ $item->id }}" wire:key="{{'menu-item-'.$item->id}}">
    <div class="flex justify-between mb-2 items-center rounded bg-white border border-gray-300 shadow-sm pr-2 dark:bg-gray-900 dark:border-gray-800">

        <div class="flex items-center min-w-0 flex-1">
            {{-- Drag Handle --}}
            <div class="handle">
                <x-filament::icon
                    icon="heroicon-o-arrows-up-down"
                    class="handle-icon"
                />
            </div>


            {{-- Name + Badges --}}
            <div class="ml-2 flex items-center gap-2 min-w-0 flex-1">
                <span class="font-medium truncate">{{ $item->menu_name }}</span>
                <x-filament::badge size="xs" class="px-2 flex-shrink-0" color="gray">
                    {{ $item->normalized_type }}
                </x-filament::badge>
                @if(! $item->is_link_resolved)
                    <x-filament::badge size="xs" class="px-2 flex-shrink-0" color="danger">
                        {{ $item->link_error ?? 'Link cannot be resolved!' }}
                    </x-filament::badge>
                @endif
            </div>
        </div>

        {{-- Action Buttons --}}
        <div class="flex gap-2 items-center flex-shrink-0 [&_svg]:shrink-0">
            {{($this->createSubItemAction)(['menuItemId' => $item->id])}}
            {{($this->editAction)(['menuItemId' => $item->id])}}
            {{($this->duplicateAction)(['menuItemId' => $item->id])}}
            {{($this->deleteAction)(['menuItemId' => $item->id])}}
            <x-filament-actions::group class="hidden" :actions="[
                ($this->viewAction)(['menuItemId' => $item->id]),
                ($this->goToLinkAction)([])->url($item->is_link_resolved ? $item->link : '#'),
            ]" />
        </div>
    </div>

    {{-- Nested Children --}}
    <div
        class="nested ml-6"
        data-id="{{ $item->id }}"
        style="min-height: 5px;"
        x-init="
            new Sortable($el, {
                handle: '.handle',
                group: 'nested',
                animation: 150,
                fallbackOnBody: true,
                swapThreshold: 0.65,
                onEnd: (evt) => {
                    data = getDataStructure(document.getElementById('parentNested'));
                }
            })
        "
    >
        @foreach($item->children as $children)
            @include('filament-menu-builder::livewire.menu-item', ['item' => $children])
        @endforeach
    </div>
</div>

