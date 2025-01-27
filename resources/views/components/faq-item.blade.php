@props(['question', 'answer'])

<div x-data="{ open: false }" class="border-b border-gray-200">
    <button @click="open = !open" class="flex justify-between items-center w-full py-4 text-left">
        <span class="text-lg font-medium text-gray-900">{{ $question }}</span>
        <svg class="h-6 w-6 text-gray-500" fill="none" viewBox="0 0 24 24" stroke="currentColor"
            :class="{ 'rotate-180': open }">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7" />
        </svg>
    </button>
    <div x-show="open" x-transition:enter="transition ease-out duration-100"
        x-transition:enter-start="opacity-0 transform scale-95" x-transition:enter-end="opacity-100 transform scale-100"
        x-transition:leave="transition ease-in duration-75" x-transition:leave-start="opacity-100 transform scale-100"
        x-transition:leave-end="opacity-0 transform scale-95" class="pb-4 pr-4">
        <p class="text-gray-600">{{ $answer }}</p>
    </div>
</div>
