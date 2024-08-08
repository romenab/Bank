<x-layout>
    <x-slot:heading>
        Investment account
    </x-slot:heading>
    @if($account->investment_money === null)
        <form action="/investment" method="POST">
            @csrf
            <div>
                <x-form-button>
                    Create An Account
                </x-form-button>
            </div>
        </form>
    @else
        <div class="mb-6">
            <p class="text-xl font-semibold text-gray-800 bg-white border border-gray-300 p-4 rounded-md shadow-sm inline-block">
                Your money: {{ number_format($account->investment_money , 2) }} {{ $account->currency }}
            </p>
        </div>
        <div class="flex justify-center space-x-10">
            <div
                class="flex-1 max-w-sm p-6 bg-white border border-gray-200 rounded-lg shadow-lg dark:bg-gray-800 dark:border-gray-700">
                <form action="/investment/receive" method="POST" class="space-y-4 h-full">
                    @csrf
                    <h3 class="text-lg font-semibold leading-7 text-gray-900 dark:text-white" id="modal-title">Transfer
                        Money To Investment Account</h3>
                    <div>
                        <label for="receive_investment_money"
                               class="block text-sm font-medium text-gray-700 dark:text-gray-300">Amount</label>
                        <input name="receive_investment_money" id="receive_investment_money" step="0.01" type="number"
                               min="0.01"
                               class="mt-1 block w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-indigo-500 dark:focus:border-indigo-500"/>
                        <x-form-error name="receive_investment_money"></x-form-error>
                    </div>
                    <button type="submit"
                            class="w-full flex justify-center py-2 px-4 border border-transparent rounded-md shadow-sm text-sm font-medium text-white bg-indigo-600 hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500">
                        Send Money
                    </button>
                </form>
            </div>
            <div
                class="flex-1 max-w-sm p-6 bg-white border border-gray-200 rounded-lg shadow-lg dark:bg-gray-800 dark:border-gray-700">
                <form action="/investment/send" method="POST" class="space-y-4 h-full">
                    @csrf
                    <h3 class="text-lg font-semibold leading-7 text-gray-900 dark:text-white" id="modal-title">Transfer
                        Money To Main Account</h3>
                    <div>
                        <label for="send_investment_money"
                               class="block text-sm font-medium text-gray-700 dark:text-gray-300">Amount</label>
                        <input name="send_investment_money" id="send_investment_money" step="0.01" type="number"
                               min="0.01"
                               class="mt-1 block w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-indigo-500 dark:focus:border-indigo-500"/>
                        <x-form-error name="send_investment_money"></x-form-error>
                    </div>
                    <button type="submit"
                            class="w-full flex justify-center py-2 px-4 border border-transparent rounded-md shadow-sm text-sm font-medium text-white bg-indigo-600 hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500">
                        Send Money
                    </button>
                </form>
            </div>
        </div>

    @endif
</x-layout>
