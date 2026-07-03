@props(['title', 'value', 'icon', 'color' => 'indigo', 'subtitle' => null])

@php
    $colorMap = [
        'indigo' => ['bg' => 'bg-indigo-50', 'text' => 'text-indigo-600', 'icon' => 'bg-indigo-100'],
        'emerald' => ['bg' => 'bg-emerald-50', 'text' => 'text-emerald-600', 'icon' => 'bg-emerald-100'],
        'amber' => ['bg' => 'bg-amber-50', 'text' => 'text-amber-600', 'icon' => 'bg-amber-100'],
        'rose' => ['bg' => 'bg-rose-50', 'text' => 'text-rose-600', 'icon' => 'bg-rose-100'],
    ];
    $c = $colorMap[$color] ?? $colorMap['indigo'];
@endphp

<div class="group relative bg-white rounded-2xl border border-slate-200/80 p-6 hover:shadow-lg hover:shadow-slate-200/50 hover:border-slate-300 transition-all duration-300">
    <div class="flex items-start justify-between">
        <div>
            <p class="text-sm font-medium text-slate-500 mb-1">{{ $title }}</p>
            <p class="text-3xl font-bold text-slate-900 tracking-tight">{{ $value }}</p>
            @if($subtitle)
                <p class="text-xs text-slate-400 mt-1">{{ $subtitle }}</p>
            @endif
        </div>
        <div class="{{ $c['icon'] }} p-3 rounded-xl group-hover:scale-110 transition-transform duration-300">
            {!! $icon !!}
        </div>
    </div>
    <div class="absolute bottom-0 left-6 right-6 h-0.5 {{ str_replace('bg-', 'bg-', $c['icon']) }} rounded-full scale-x-0 group-hover:scale-x-100 transition-transform duration-500 origin-left"></div>
</div>
