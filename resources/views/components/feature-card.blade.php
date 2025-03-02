@props(['description','color','image','title'])

<div class="bg-white rounded-lg shadow-lg p-6 transition duration-300 ease-in-out transform hover:-translate-y-1 hover:shadow-xl">

    <div class="flex justify-center p-8">
        <i class="fa-solid {{ $image }} {{ $color }} w-20 h-20 mx-auto my-8"></i>
    </div>
    <h3 class="text-xl font-semibold text-gray-900 text-center mb-2">{{ $title }}</h3>
    <p class="text-gray-600 text-center">{{ $description }}</p>
</div>