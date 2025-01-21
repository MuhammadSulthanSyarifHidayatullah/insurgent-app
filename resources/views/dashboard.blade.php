<x-app-layout>
    <x-slot name="title">Dashboard | Partisan</x-slot>
    <section class="relative bg-cover bg-center bg-no-repeat object-bottom"
        style="background-image: url('{{ asset('images/header-image.jpg') }}')">
        <div
            class="absolute inset-0 bg-gray-900/75 sm:bg-transparent sm:bg-gradient-to-r from-gray-900/95 to-transparent">
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
                <div class="mt-8 flex flex-wrap gap-4 text-center justify-center sm:justify-center md:justify-start">
                    <a href="{{ route('products.index') }}">
                        <x-primary-button class=" py-4 px-4 rounded flex-grow">
                            Belanja Sekarang
                        </x-primary-button>
                    </a>
                    <a href="about">
                        <x-secondary-button class=" py-4 px-8 rounded">
                            Tentang Kami
                        </x-secondary-button>
                    </a>
                </div>
            </div>
        </div>
    </section>
    <section class="rotate-180">
        <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 1440 320">
            <path fill="#1f2937" fill-opacity="1"
                d="M0,128L48,112C96,96,192,64,288,64C384,64,480,96,576,122.7C672,149,768,171,864,197.3C960,224,1056,256,1152,250.7C1248,245,1344,203,1392,181.3L1440,160L1440,320L1392,320C1344,320,1248,320,1152,320C1056,320,960,320,864,320C768,320,672,320,576,320C480,320,384,320,288,320C192,320,96,320,48,320L0,320Z">
            </path>
        </svg>
    </section>
    <section class="pt-4">
        <div class="flex flex-wrap justify-center gap-10 p-5 m-5">
            <div class="bg-white py-4 rounded-lg w-64 shadow-lg flex flex-col items-center justify-center hover:scale-125 transition ease-in-out">   
                <img src="{{ asset('advantage/advantage 1.svg') }}" alt="" class="w-40 h-w-40 mx-auto pb-3">
                <h1 class="text-3xl font-bold text-center">Cepat</h1>
                <p class="text-center">Lorem ipsum dolor sit amet consectetur adipisicing elit. Numquam, sit?</p>
            </div>
            <div class="bg-white py-4 rounded-lg w-64 shadow-lg flex flex-col items-center justify-center hover:scale-125 transition ease-in-out">   
                <img src="{{ asset('advantage/advantage 1.svg') }}" alt="" class="w-40 h-w-40 mx-auto pb-3">
                <h1 class="text-3xl font-bold text-center">Murah</h1>
                <p class="text-center">Lorem ipsum dolor sit amet consectetur adipisicing elit. Numquam, sit?</p>
            </div>
            <div class="bg-white py-4 rounded-lg w-64 shadow-lg flex flex-col items-center justify-center hover:scale-125 transition ease-in-out">   
                <img src="{{ asset('advantage/advantage 1.svg') }}" alt="" class="w-40 h-w-40 mx-auto pb-3">
                <h1 class="text-3xl font-bold text-center">Terpercaya</h1>
                <p  class="text-center">Lorem ipsum dolor sit amet consectetur adipisicing elit. Numquam, sit?</p>
            </div>
        </div>
    </section>
    <section class=" px-6">
        <div class="space-y-4">
            <details class="group [&_summary::-webkit-details-marker]:hidden" open>
                <summary
                    class="flex cursor-pointer items-center justify-between gap-1.5 rounded-lg bg-gray-800 p-4 text-white">
                    <h2 class="font-medium">Memgapa harus beli di Partisan?</h2>

                    <svg class="size-5 shrink-0 transition duration-300 group-open:-rotate-180"
                        xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7" />
                    </svg>
                </summary>

                <p class="mt-4 px-4 leading-relaxed text-gray-700">
                    Lorem ipsum dolor sit amet consectetur, adipisicing elit. Ab hic veritatis molestias culpa in,
                    recusandae laboriosam neque aliquid libero nesciunt voluptate dicta quo officiis explicabo
                    consequuntur distinctio corporis earum similique!
                </p>
            </details>

            <details class="group [&_summary::-webkit-details-marker]:hidden">
                <summary
                    class="flex cursor-pointer items-center justify-between gap-1.5 rounded-lg bg-gray-800 p-4 text-white">
                    <h2 class="font-medium">Apa ketuntungan beli di Partisan?</h2>

                    <svg class="size-5 shrink-0 transition duration-300 group-open:-rotate-180"
                        xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7" />
                    </svg>
                </summary>

                <p class="mt-4 px-4 leading-relaxed text-gray-700">
                    Lorem ipsum dolor sit amet consectetur, adipisicing elit. Ab hic veritatis molestias culpa in,
                    recusandae laboriosam neque aliquid libero nesciunt voluptate dicta quo officiis explicabo
                    consequuntur distinctio corporis earum similique!
                </p>
            </details>
        </div>
    </section>
</x-app-layout>
