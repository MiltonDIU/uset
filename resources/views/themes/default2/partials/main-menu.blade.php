@if(isset($mobile) && $mobile)
    <!-- Mobile Nav Items -->
    <div class="px-2 pt-2 pb-3 space-y-1 sm:px-3 text-white">
        @foreach($menuItems as $item)
            @if($item->children->isEmpty())
                <a href="{{ $item->link }}" 
                   target="{{ $item->target }}"
                   class="block px-3 py-2 font-medium {{ request()->url() === $item->link ? 'bg-white/10' : 'hover:bg-white/10' }} rounded-md">
                    {{ $item->name }}
                </a>
            @else
                <!-- Mobile Submenu -->
                <div x-data="{ open: false }">
                    <button @click="open = !open" class="flex items-center justify-between w-full px-3 py-2 font-medium hover:bg-white/10 rounded-md outline-none">
                        {{ $item->name }} <i data-lucide="chevron-down" class="h-4 w-4" :class="open ? 'rotate-180' : ''"></i>
                    </button>
                    <div x-show="open" class="bg-blue-950/50 ml-4 rounded-md mt-1" x-cloak>
                        @foreach($item->children as $child)
                            <a href="{{ $child->link }}" 
                               target="{{ $child->target }}"
                               class="block px-4 py-2 text-sm text-blue-100 hover:text-white">
                                {{ $child->name }}
                            </a>
                        @endforeach
                    </div>
                </div>
            @endif
        @endforeach

        <div class="px-3 py-4">
            <button class="w-full bg-secondary text-primary py-3 rounded font-bold uppercase tracking-widest">
                PORTAL LOGIN
            </button>
        </div>
    </div>
@else
    <!-- Desktop Nav Items -->
    <div class="hidden md:flex items-center space-x-6">
        @foreach($menuItems as $item)
            @if($item->children->isEmpty())
                <a href="{{ $item->link }}" 
                   target="{{ $item->target }}"
                   class="text-sm font-medium transition-colors {{ request()->url() === $item->link ? 'text-secondary' : 'text-white hover:text-secondary' }}">
                    {{ $item->name }}
                </a>
            @else
                <!-- Dropdown -->
                <div class="relative group" x-data="{ open: false }" @mouseenter="open = true" @mouseleave="open = false">
                    <button class="flex items-center gap-1 text-sm font-medium transition-colors text-white hover:text-secondary outline-none">
                        {{ $item->name }} <i data-lucide="chevron-down" class="h-4 w-4"></i>
                    </button>
                    <div
                        x-show="open"
                        x-transition
                        class="absolute top-full left-0 w-52 bg-white shadow-xl rounded-md py-2 mt-2 border border-slate-100"
                        x-cloak
                    >
                        @foreach($item->children as $child)
                            <a href="{{ $child->link }}" 
                               target="{{ $child->target }}"
                               class="block px-4 py-2 text-sm text-slate-700 hover:bg-slate-50 hover:text-primary">
                                {{ $child->name }}
                            </a>
                        @endforeach
                    </div>
                </div>
            @endif
        @endforeach

        <button class="bg-secondary text-primary px-6 py-2 rounded font-bold hover:bg-yellow-400 transition-all uppercase text-xs tracking-widest shadow-sm">
            PORTAL LOGIN
        </button>
    </div>
@endif
