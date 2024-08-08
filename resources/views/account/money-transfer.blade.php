<x-layout>
    <x-slot:heading>
        Money Transfer
    </x-slot:heading>

    <div class="flex justify-center">
        <div class="flex-1 max-w-lg p-6 bg-white border border-gray-200 rounded-lg shadow-lg dark:bg-gray-800 dark:border-gray-700">
            <form action="/transfer" method="POST" class="space-y-4">
                @csrf
                @if (session('success'))
                    <div class="text-green-500 font-semibold text-sm">
                        <div class="alert alert-success">
                            {{ session('success') }}
                        </div>
                    </div>
                @endif

                <div class="grid grid-cols-1 gap-4 sm:grid-cols-2">
                    <div>
                        <label for="first_name" class="block text-sm font-medium text-gray-700 dark:text-gray-300">Recipient's First Name</label>
                        <input name="first_name" id="first_name" type="text" class="mt-1 block w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-indigo-500 dark:focus:border-indigo-500"/>
                        <x-form-error name="first_name"/>
                    </div>

                    <div>
                        <label for="last_name" class="block text-sm font-medium text-gray-700 dark:text-gray-300">Recipient's Last Name</label>
                        <input name="last_name" id="last_name" type="text" class="mt-1 block w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-indigo-500 dark:focus:border-indigo-500"/>
                        <x-form-error name="last_name"/>
                    </div>
                </div>

                <div>
                    <label for="account_number" class="block text-sm font-medium text-gray-700 dark:text-gray-300">Account Number</label>
                    <input name="account_number" id="account_number" type="text" class="mt-1 block w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-indigo-500 dark:focus:border-indigo-500"/>
                    <x-form-error name="account_number"/>
                </div>

                <div>
                    <label for="money" class="block text-sm font-medium text-gray-700 dark:text-gray-300">Amount</label>
                    <input name="money" id="money" type="number" step="0.01" min="0.01" class="mt-1 block w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-indigo-500 dark:focus:border-indigo-500"/>
                    <x-form-error name="money"/>
                    <p class="text-xs font-semibold text-red-500">Your money: {{ number_format($account->money, 2) }} {{ $account->currency }}</p>
                </div>

                <button type="submit" class="w-full flex justify-center py-2 px-4 border border-transparent rounded-md shadow-sm text-sm font-medium text-white bg-indigo-600 hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500">
                    Send Money
                </button>
            </form>
        </div>
    </div>
{{--    <div class="pt-10"></div>--}}

{{--    <div class="flex justify-center pt-2">--}}
{{--        <div class="flex-1 max-w-lg p-6 bg-white border border-gray-200 rounded-lg shadow-lg dark:bg-gray-800 dark:border-gray-700">--}}
{{--            <div class="flex justify-between items-center">--}}
{{--                <h3 class="text-l font-semibold text-gray-800 dark:text-gray-100">Name Surname</h3>--}}
{{--                <h3 class="text-l font-bold text-green-600 dark:text-green-400text-right">+ 100 EUR</h3>--}}
{{--            </div>--}}
{{--            <p class="text-xs text-gray-600 dark:text-gray-300 mt-1">Date</p>--}}
{{--        </div>--}}
{{--    </div>--}}
</x-layout>
