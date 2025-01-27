
<footer class="">
    <div class="mx-auto max-w-5xl px-4 pb-16 bg-gray-300 sm:px-6 lg:px-8">
        <div class="flex justify-center">
            <x-application-logo class="h-32"></x-application-logo>
        </div>

        <p class="mx-auto mt-6 max-w-md text-center leading-relaxed text-gray-500">
            Lorem ipsum dolor, sit amet consectetur adipisicing elit. Incidunt consequuntur amet culpa cum
            itaque neque.
        </p>

        <ul class="mt-12 flex flex-wrap justify-center gap-6 md:gap-8 lg:gap-12">
            <li>
                <a class="text-gray-700 transition hover:text-gray-700/75" href="{{ route('dashboard') }}"> Dashboard
                </a>
            </li>

            <li>
                <a class="text-gray-700 transition hover:text-gray-700/75" href="{{ route('about') }}"> About Us </a>
            </li>

            <li>
                <a class="text-gray-700 transition hover:text-gray-700/75" href="{{ route('products.index') }}"> Product
                </a>
            </li>


        </ul>
    </div>
</footer>
