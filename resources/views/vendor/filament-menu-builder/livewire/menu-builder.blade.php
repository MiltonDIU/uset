<div x-data="{
    data: $wire.entangle('data'),
    getDataStructure(parentNode) {
        const items = Array.from(parentNode.children).filter((item) => {
            return item.classList.contains('item');
        });

        return Array.from(items).map((item) => {
            const id = item.getAttribute('data-id');
            const nestedContainer = item.querySelector('.nested');
            const children = nestedContainer ? this.getDataStructure(nestedContainer) : [];

            return { id: parseInt(id), children };
        });
    }
}">
    {{-- Inject Sortable.js if not already present --}}
    <script src="https://cdn.jsdelivr.net/npm/sortablejs@1.15.2/Sortable.min.js"></script>
    <style>
        .nested-wrapper .item {
            margin-bottom: 0.5rem;
        }
        .nested-wrapper .item > div:first-child {
            display: flex !important;
            justify-content: space-between !important;
            align-items: center !important;
            background-color: white !important;
            border: 1px solid #d1d5db !important;
            border-radius: 0.375rem !important;
            padding-right: 0.5rem !important;
            box-shadow: 0 1px 2px 0 rgba(0, 0, 0, 0.05) !important;
        }
        .dark .nested-wrapper .item > div:first-child {
            background-color: #111827 !important;
            border-color: #1f2937 !important;
        }
        .nested-wrapper .handle {
            cursor: grab;
            padding: 0.5rem;
            border-right: 2px solid #d1d5db;
            display: flex !important;
            align-items: center !important;
            justify-content: center !important;
        }
        .dark .nested-wrapper .handle {
            border-right-color: #1f2937;
        }
        .nested-wrapper .handle:active {
            cursor: grabbing;
        }
        /* Target only the actual icons, not loading indicators */
        .nested-wrapper .handle svg,
        .nested-wrapper .fi-icon-btn svg,
        .nested-wrapper .item .font-medium + svg,
        .handle-icon {
            /*display: inline-block !important;*/
            vertical-align: middle !important;
            width: 20px !important;
            height: 20px !important;
        }
        .nested-wrapper .handle svg {
            width: 24px !important;
            height: 24px !important;
        }
        .nested-wrapper .fi-btn svg,
        .nested-wrapper .fi-icon-btn svg {
            width: 18px !important;
            height: 18px !important;
        }
        .nested-wrapper .flex {
            display: flex !important;
        }
        .nested-wrapper .items-center {
            align-items: center !important;
        }
        .nested-wrapper .gap-2 {
            gap: 0.5rem !important;
        }
        .nested-wrapper .ml-2 {
            margin-left: 0.5rem !important;
        }
        .nested-wrapper .ml-6 {
            margin-left: 1.5rem !important;
        }
        .nested-wrapper .mb-2 {
            margin-bottom: 0.5rem !important;
        }
    </style>


    <form wire:submit="save">
        @if($items->count() > 0)
        <div class="nested-wrapper">
            <div id="parentNested" class="nested"
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
                 ">
                @foreach($items as $item)
                    @include('filament-menu-builder::livewire.menu-item', ['item' => $item])
                @endforeach
            </div>
        </div>
        <x-filament::button
            wire:loading.attr="disabled"
            type="submit"
            class="mt-2"
        >
            <x-filament::loading-indicator wire:loading class="h-5 w-5" />
            {{ __('filament-menu-builder::menu-builder.save') }}
        </x-filament::button>

        <x-filament::button
            wire:loading.attr="disabled"
            type="button"
            class="mt-2"
            color="danger"
            wire:click="$refresh"
        >
            <x-filament::loading-indicator wire:loading class="h-5 w-5" />
            {{ __('filament-menu-builder::menu-builder.reset') }}
        </x-filament::button>
        <p class="text-gray-500 text-center mt-2 text-[13px]">
            {{ __('filament-menu-builder::menu-builder.menu_item_information') }}
        </p>
        @else
            <div class="text-gray-500 text-center">
                <p>
                    {{ __('filament-menu-builder::menu-builder.empty_menu_items_hint_1') }}
                </p>
                <p>
                    {{ __('filament-menu-builder::menu-builder.empty_menu_items_hint_2') }}
                </p>
            </div>
        @endif
    </form>

    <x-filament-actions::modals />
</div>

