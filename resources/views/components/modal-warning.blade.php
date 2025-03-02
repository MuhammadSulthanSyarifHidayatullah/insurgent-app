<!-- filepath: /c:/laragon/www/insurgent-app/resources/views/components/modal.blade.php -->
<div x-data="{ show: false }" x-show="show" class="fixed inset-0 flex items-center justify-center z-50">
    <div class="fixed inset-0 bg-gray-500 opacity-75"></div>
    <div @click.away="show = false" class="bg-white rounded-lg overflow-hidden shadow-xl transform transition-all sm:w-full sm:max-w-lg">
        <div class="px-4 py-5 sm:p-6">
            {{ $slot }}
        </div>
        <div class="px-4 py-3 sm:px-6 sm:flex sm:flex-row-reverse">
            <button @click="show = false" type="button" class="mt-3 w-full inline-flex justify-center rounded-md border border-gray-300 shadow-sm px-4 py-2 bg-white text-base font-medium text-gray-700 hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500 sm:mt-0 sm:ml-3 sm:w-auto sm:text-sm">
                Close
            </button>
        </div>
    </div>
</div>