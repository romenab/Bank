<x-layout>
    <x-slot:heading>
        Welcome, {{ $user->first_name }}!
    </x-slot:heading>
    <div class="flex flex-wrap max-w-4xl mx-auto gap-6">
        <div class="flex-shrink-0 h-full w-full max-w-xs bg-white border border-gray-200 rounded-lg shadow-lg dark:bg-gray-800 dark:border-gray-700 ">
            <div class="p-6">
                <form action="/account" method="GET">
                    <label for="account" class="block text-sm font-medium text-gray-700 dark:text-gray-300">Account type:</label>
                    <select id="account" name="account" autocomplete="account" class="mt-1 block w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm dark:bg-gray-700 dark:border-gray-600 dark:text-white dark:focus:ring-indigo-500 dark:focus:border-indigo-500">
                        <option value="main">Main</option>
                        <option value="investment">Investment</option>
                    </select>
                    <div class="pt-4">
                        <button type="submit" class=" w-full flex justify-center py-2 px-4 border border-transparent rounded-md shadow-sm text-sm font-medium text-white bg-indigo-600 hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500">
                            Submit
                        </button>
                    </div>
                </form>
            </div>
        </div>

        <div class="flex-grow bg-white shadow-md rounded-lg p-3 max-w-lg">
            <div class="text-center mb-3">
                <h2 class="text-2xl font-bold text-gray-900">{{ $user->first_name }} {{ $user->last_name }}</h2>
            </div>
            <div class="space-y-4">
                <div class="flex justify-between items-center p-4 bg-gray-100 rounded-lg">
                    <span class="font-medium text-gray-700">Email Address:</span>
                    <span class="text-gray-900">{{ $user->email }}</span>
                </div>
                <div class="flex justify-between items-center p-4 bg-gray-100 rounded-lg">
                    <span class="font-medium text-gray-700">Account Number:</span>
                    <span class="text-gray-900">{{ $account->account_number }}</span>
                </div>
                <div class="flex justify-between items-center p-4 bg-gray-100 rounded-lg">
                    <span class="font-medium text-gray-700">Currency:</span>
                    <span class="text-gray-900">{{ $account->currency }}</span>
                </div>
                <div class="flex justify-between items-center p-4 bg-gray-100 rounded-lg">
                    <span class="font-medium text-gray-700">Owned Money:</span>
                    <span class="text-gray-900">{{ number_format($account->money, 2) }}</span>
                </div>
            </div>
        </div>
    </div>

</x-layout>
