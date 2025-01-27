@props(['icon', 'title', 'description'])

<div class="bg-white rounded-lg shadow-lg p-6 transition duration-300 ease-in-out transform hover:-translate-y-1 hover:shadow-xl">
    <img src="{{ $icon }}" alt="{{ $title }} icon" class="w-32 h-32 mx-auto mb-8">
    <h3 class="text-xl font-semibold text-gray-900 text-center mb-2">{{ $title }}</h3>
    <p class="text-gray-600 text-center">{{ $description }}</p>
</div>