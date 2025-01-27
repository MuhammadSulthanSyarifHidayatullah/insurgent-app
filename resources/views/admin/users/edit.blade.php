<x-admin-layout>
    <x-slot name="title">EDIT USERS | PARTISAN</x-slot>
    <div class="py-12">
        <div class="max-w-xl mx-auto sm:px-6 lg:px-8">
            <div class=" overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6">
                    <form method="POST" action="{{ route('admin.users.update', $user) }}">
                        @csrf
                        @method('PUT')
                        <div class="flex justify-center flex-col gap-4 mt-5">
                            <div class="flex flex-col">
                                <label for="name" class="block font-medium text-sm text-gray-700">
                                    Name</label>
                                <input
                                    class="border-gray-300 focus:border-indigo-500 focus:ring-indigo-500 rounded-md shadow-sm"
                                    type="text" name="name" id="name" value="{{ $user->name }}" required>
                            </div>
                            <div class="flex flex-col">
                                <label for="email" class="block font-medium text-sm text-gray-700">
                                    Email</label>
                                <input
                                    class="border-gray-300 focus:border-indigo-500 focus:ring-indigo-500 rounded-md shadow-sm"
                                    type="email" name="email" id="email" value="{{ $user->email }}" required>
                            </div>
                            <div class="flex flex-col">
                                <label for="phone" class="block font-medium text-sm text-gray-700">
                                    Phone</label>
                                <input
                                    class="border-gray-300 focus:border-indigo-500 focus:ring-indigo-500 rounded-md shadow-sm"
                                    type="text" name="phone" id="phone" value="{{ $user->phone }}" required>
                            </div>
                            <div class="flex justify-center mt-2">
                                <x-primary-button type="submit">Update User</x-primary-button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

</x-admin-layout>
