<x-app-layout>
    <x-slot name="title">About | Insurgent</x-slot>
    <section>
        <div class="mx-auto max-w-screen-2xl px-4 py-8 sm:px-6 lg:px-8">
            <div class="grid grid-cols-1 gap-4 md:grid-cols-2">
                <div class="bg-gray-600 p-8 md:p-12 lg:px-16 lg:py-24 rounded-md shadow-md">
                    <div class="mx-auto max-w-xl text-center">
                        <h2 class="text-2xl font-bold text-white md:text-3xl">
                            Tentang Kami - INSURGENT
                        </h2>

                        <p class="hidden text-white/90 sm:mt-4 sm:block">
                            Selamat datang di INSURGENT, destinasi utama Anda untuk streetwear yang berani dan penuh
                            gaya! Didirikan dengan misi untuk memberdayakan ekspresi diri melalui fashion, INSURGENT
                            menawarkan berbagai pakaian unik dan berkualitas tinggi yang mencerminkan individualitas,
                            kebebasan, dan semangat pemberontakan.
                        </p>

                        <div class="mt-4 md:mt-8">
                        </div>
                    </div>
                </div>

                <div class="grid grid-cols-2 gap-4 md:grid-cols-1 lg:grid-cols-2">
                    <img alt=""
                        src="{{ asset('images/about-image-1.jpg') }}"
                        class="h-40 w-full object-cover sm:h-56 md:h-full rounded-md shadow-md" />

                    <img alt=""
                        src="{{ asset('images/about-image-2.jpg') }}"
                        class="h-40 w-full object-cover sm:h-56 md:h-full rounded-md shadow-md" />
                </div>
            </div>
        </div>
    </section>
</x-app-layout>
