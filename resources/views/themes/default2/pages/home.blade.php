@extends(app(Modules\Theme\app\Services\ThemeService::class)->view('layouts.master'))

@section('title', 'হোম - স্কলার্স ইউনিভার্সিটি')

@section('content')
<!-- Hero Section -->
<header class="relative h-[600px] flex items-center overflow-hidden">
    <div class="absolute inset-0">
        <img
            src="https://images.unsplash.com/photo-1541339907198-e08756ebafe3?auto=format&fit=crop&w=1950&q=80"
            alt="University Campus"
            class="w-full h-full object-cover"
        >
        <div class="absolute inset-0 hero-gradient"></div>
    </div>

    <div class="relative max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 w-full">
        <div class="max-w-2xl text-white">
            <span class="text-secondary font-bold tracking-widest text-xs uppercase mb-4 block">Excellence in Innovation</span>
            <h1 class="text-5xl md:text-6xl font-extrabold leading-tight mb-6">
                আপনার স্বপ্নের <br/>
                ক্যারিয়ার গড়ুন
            </h1>
            <p class="text-blue-50 text-lg mb-8 leading-relaxed max-w-xl">
                বিশ্বমানের শিক্ষা, আধুনিক গবেষণা এবং একটি প্রাণবন্ত কমিউনিটির সমন্বয়ে আমরা তৈরি করছি আগামীর নেতৃত্ব। আজই যোগ দিন আমাদের স্কলার পরিবারে।
            </p>
            <div class="flex space-x-4">
                <button class="bg-accent text-white px-8 py-3 rounded text-sm font-bold hover:bg-blue-700 transition-all shadow-md uppercase">APPLY NOW</button>
                <button class="border-2 border-white text-white px-8 py-3 rounded text-sm font-bold hover:bg-white/10 transition-all uppercase">VIRTUAL TOUR</button>
            </div>
        </div>
    </div>
</header>

<!-- Quick Stats Strip -->
<div class="grid grid-cols-2 md:grid-cols-4 bg-white border-b border-slate-200">
    <div class="p-8 border-r border-slate-100 flex flex-col items-center text-center">
        <span class="text-4xl font-extrabold text-primary">#১২</span>
        <span class="text-[10px] text-slate-500 uppercase tracking-widest mt-2 font-semibold">পাবলিক রিসার্চ ইউনিভার্সিটি</span>
    </div>
    <div class="p-8 border-r border-slate-100 flex flex-col items-center text-center">
        <span class="text-4xl font-extrabold text-primary">২২:১</span>
        <span class="text-[10px] text-slate-500 uppercase tracking-widest mt-2 font-semibold">শিক্ষার্থী-শিক্ষক অনুপাত</span>
    </div>
    <div class="p-8 border-r border-slate-100 flex flex-col items-center text-center">
        <span class="text-4xl font-extrabold text-primary">$৪৫০M</span>
        <span class="text-[10px] text-slate-500 uppercase tracking-widest mt-2 font-semibold">বার্ষিক গবেষণা তহবিল</span>
    </div>
    <div class="p-8 flex flex-col items-center text-center">
        <span class="text-4xl font-extrabold text-primary">৯৪%</span>
        <span class="text-[10px] text-slate-500 uppercase tracking-widest mt-2 font-semibold">ক্যারিয়ার প্লেসমেন্ট হার</span>
    </div>
</div>

<!-- Content Section -->
<section id="academic" class="py-20 max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
    <div class="grid grid-cols-1 lg:grid-cols-3 gap-8">
        <!-- Box 1: Events -->
        <div class="bg-white p-8 rounded-lg shadow-sm border border-slate-200">
            <h3 class="text-primary font-bold mb-6 flex items-center border-b border-slate-200 pb-3 uppercase text-xs tracking-widest">
                <span>আসন্ন ইভেন্টসমূহ</span>
            </h3>
            <div class="space-y-6">
                <div class="flex items-start">
                    <div class="bg-blue-50 text-primary px-3 py-2 rounded text-center min-w-[60px] mr-4 border border-blue-100">
                        <div class="text-[10px] font-bold opacity-70 uppercase tracking-widest">MAY</div>
                        <div class="text-xl font-bold leading-none">১০</div>
                    </div>
                    <div>
                        <h4 class="text-sm font-bold text-slate-800">বার্ষিক সাংস্কৃতিক উৎসব</h4>
                        <p class="text-xs text-slate-500 italic mt-1">সেন্ট্রাল অডিটোরিয়াম</p>
                    </div>
                </div>
                <div class="flex items-start">
                    <div class="bg-blue-50 text-primary px-3 py-2 rounded text-center min-w-[60px] mr-4 border border-blue-100">
                        <div class="text-[10px] font-bold opacity-70 uppercase tracking-widest">MAY</div>
                        <div class="text-xl font-bold leading-none">১৫</div>
                    </div>
                    <div>
                        <h4 class="text-sm font-bold text-slate-800">রোবোটিক্স সেমিনার</h4>
                        <p class="text-xs text-slate-500 italic mt-1">টেক প্লাজা বি</p>
                    </div>
                </div>
            </div>
            <button class="mt-8 text-xs font-bold text-accent uppercase tracking-widest hover:underline">সকল ইভেন্ট দেখুন</button>
        </div>

        <!-- Box 2: Student Services -->
        <div class="bg-primary p-8 rounded-lg shadow-sm text-white flex flex-col">
            <h3 class="text-secondary font-bold mb-4 uppercase text-[10px] tracking-widest">For Students</h3>
            <h2 class="text-3xl font-bold mb-6 leading-tight">সাফল্যের সব উপকরণ এক জায়গায়।</h2>
            <ul class="space-y-3 mb-8 flex-1">
                <li class="flex items-center text-sm text-blue-100"><span class="mr-2 text-secondary">●</span> ক্যাম্পাস হাউজিং</li>
                <li class="flex items-center text-sm text-blue-100"><span class="mr-2 text-secondary">●</span> আর্থিক সহায়তা অফিস</li>
                <li class="flex items-center text-sm text-blue-100"><span class="mr-2 text-secondary">●</span> লাইব্রেরি রিসোর্স</li>
                <li class="flex items-center text-sm text-blue-100"><span class="mr-2 text-secondary">●</span> ক্যারিয়ার সার্ভিসেস</li>
            </ul>
            <button class="w-fit text-left font-bold text-sm border-b border-white/20 pb-1 hover:border-white transition-all">STUDENT HUB ঘুরে দেখুন</button>
        </div>

        <!-- Box 3: News -->
        <div class="bg-white p-8 rounded-lg shadow-sm border border-slate-200">
            <h3 class="text-primary font-bold mb-6 border-b border-slate-200 pb-3 uppercase text-xs tracking-widest">সর্বশেষ সংবাদ</h3>
            <div class="space-y-6">
                <div>
                    <p class="text-[10px] text-accent font-bold uppercase mb-1 tracking-widest">গবেষণা</p>
                    <p class="text-sm font-bold text-slate-800 leading-snug">কোয়ান্টাম কম্পিউটিংয়ে যুগান্তকারী সাফল্য</p>
                </div>
                <div>
                    <p class="text-[10px] text-accent font-bold uppercase mb-1 tracking-widest">ক্যাম্পাস</p>
                    <p class="text-sm font-bold text-slate-800 leading-snug">নতুন ৫০,০০০ বর্গফুটের ইঞ্জিনিয়ারিং সেন্টার</p>
                </div>
            </div>
            <button class="mt-8 text-xs font-bold text-accent uppercase tracking-widest hover:underline">সকল সংবাদ দেখুন</button>
        </div>
    </div>
</section>
@endsection
