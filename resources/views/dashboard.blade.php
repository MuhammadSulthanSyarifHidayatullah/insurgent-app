<x-app-layout>
    <x-slot name="title">Dashboard | Insurgent</x-slot>
    <section class="relative bg-cover bg-center bg-no-repeat object-bottom"
    style="background-image: url('{{ asset('images/header-image.jpg') }}')">
    <!-- Updated Background Overlay -->
    <div class="absolute inset-0 bg-gray-900/75 sm:bg-transparent sm:bg-gradient-to-r from-gray-900/95 to-transparent">
    </div>

    <!-- Content Section -->
    <div class="relative mx-auto max-w-screen-xl px-4 py-32 sm:px-6 lg:flex lg:h-screen lg:items-center lg:px-8">
        <div class="max-w-xl text-center sm:text-left">
            <h1 class="text-3xl font-extrabold text-white sm:text-5xl">
                Ayo Temukan Outfit
                <strong class="block font-extrabold text-gray-500">
                    Favorit Mu.
                </strong>
            </h1>

            <p class="mt-4 max-w-lg text-white sm:text-xl/relaxed">
                Lorem ipsum dolor sit amet consectetur, adipisicing elit. Nesciunt illo tenetur fuga ducimus
                numquam ea!
            </p>

            <!-- Button Section -->
            <div class="mt-8 flex flex-wrap gap-4 text-center justify-center sm:justify-center md:justify-start" >
                <a href="{{ route('products.index') }}"><x-primary-button class=" py-4 px-4 rounded flex-grow">Belanja Sekarang</x-primary-button></a>
                <a href="about"><x-secondary-button class=" py-4 px-8 rounded">Tentang Kami</x-secondary-button></a>
            </div>
        </div>
    </div>
</section>
</x-app-layout>

