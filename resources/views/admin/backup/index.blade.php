<x-admin-layout>
    <x-slot name="title">Backup Database | Admin Partisan</x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 bg-white border-b border-gray-200">
                    <h1 class="text-3xl font-bold mb-6 text-gray-800 flex items-center">
                        <i class="fas fa-database text-blue-600 mr-3"></i> Database Backup Management
                    </h1>

                    @if (session('success'))
                        <div class="bg-green-100 border-l-4 border-green-500 text-green-700 p-4 mb-6" role="alert">
                            <div class="flex">
                                <div class="py-1"><i class="fas fa-check-circle text-green-500 mr-3"></i></div>
                                <div>
                                    <p class="font-bold">Success</p>
                                    <p>{{ session('success') }}</p>
                                </div>
                            </div>
                        </div>
                    @endif

                    @if (session('error'))
                        <div class="bg-red-100 border-l-4 border-red-500 text-red-700 p-4 mb-6" role="alert">
                            <div class="flex">
                                <div class="py-1"><i class="fas fa-exclamation-circle text-red-500 mr-3"></i></div>
                                <div>
                                    <p class="font-bold">Error</p>
                                    <p>{{ session('error') }}</p>
                                </div>
                            </div>
                        </div>
                    @endif

                    <div class="bg-gray-100 p-6 rounded-lg shadow-inner mb-6">
                        <h2 class="text-xl font-semibold mb-4 text-gray-700">Create New Backup</h2>
                        <p class="text-gray-600 mb-4">Click the button below to create a new backup of your database.
                            This process may take a few moments.</p>
                        <form action="{{ route('admin.backup') }}" method="POST">
                            @csrf
                            <button type="submit"
                                class="bg-blue-600 hover:bg-blue-700 text-white px-6 py-3 rounded-lg shadow-sm focus:outline-none focus:ring-2 focus:ring-blue-500 focus:ring-offset-2 flex items-center transition duration-150 ease-in-out">
                                <i class="fas fa-database mr-2"></i> Create Backup Now
                            </button>
                        </form>
                    </div>

                    @if (session('success') && isset($backupFile))
                        <div class="bg-green-100 p-6 rounded-lg shadow-inner">
                            <h2 class="text-xl font-semibold mb-4 text-gray-700">Download Latest Backup</h2>
                            <p class="text-gray-600 mb-4">Your backup has been created successfully. You can download it
                                using the button below.</p>
                            <a href="{{ route('admin.backup.download') }}"
                                class="bg-green-600 hover:bg-green-700 text-white px-6 py-3 rounded-lg shadow-sm focus:outline-none focus:ring-2 focus:ring-green-500 focus:ring-offset-2 flex items-center inline-block transition duration-150 ease-in-out">
                                <i class="fas fa-download mr-2"></i> Download Backup
                            </a>
                        </div>
                    @endif
                </div>
            </div>
        </div>
    </div>
</x-admin-layout>
