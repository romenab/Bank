<x-layout>
    <x-slot:heading>
        Crypto
    </x-slot:heading>

    <form action="/crypto/available" method="get">
        <button type="submit"
                class=" w-auto flex justify-center py-2 px-4 border border-transparent rounded-md shadow-sm text-sm font-medium text-white bg-indigo-600 hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500">
            Available Cryptocurrencies
        </button>
    </form>

    <div class="flex justify-center space-x-10 pt-4">
        <div
            class="flex-1 max-w-sm p-6 bg-white border border-gray-200 rounded-lg shadow-lg dark:bg-gray-800 dark:border-gray-700">
            <form action="/crypto/buy" method="POST" class="space-y-4 h-full flex flex-col">
                @csrf
                <div class="text-red-500 font-semibold text-xl">
                    @if (session('purchased'))
                        <div class="alert alert-success">
                            {{ session('purchased') }}
                        </div>
                    @endif
                </div>
                <h2 class="text-lg font-semibold leading-7 text-gray-900 dark:text-white" id="modal-title">Purchase</h2>
                <div>
                    <label for="crypto_buy" class="block text-sm font-medium text-gray-700 dark:text-gray-300">Cryptocurrency</label>
                    <select id="crypto_buy" name="crypto_buy" autocomplete="crypto_buy"
                            class="mt-1 block w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm dark:bg-gray-700 dark:border-gray-600 dark:text-white dark:focus:ring-indigo-500 dark:focus:border-indigo-500">
                        @foreach($crypto as $c)
                            <option value="{{ $c['name'] }}">
                                {{ $c['name'] }}
                            </option>
                        @endforeach
                    </select>
                    <x-form-error name="crypto_buy"/>
                </div>
                <div>
                    <label for="crypto_amount"
                           class="block text-sm font-medium text-gray-700 dark:text-gray-300">Amount</label>
                    <input name="crypto_amount" id="crypto_amount" step="0.01" type="number" min="0.01"
                           class="mt-1 block w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-indigo-500 dark:focus:border-indigo-500"/>
                    <x-form-error name="crypto_amount"/>
                </div>
                <button type="submit"
                        class="w-full flex justify-center py-2 px-4 border border-transparent rounded-md shadow-sm text-sm font-medium text-white bg-indigo-600 hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500">
                    Purchase
                </button>
            </form>
        </div>

        @if($ownedCrypto->isNotEmpty())

            <div
                class="flex-1 max-w-sm p-6 bg-white border border-gray-200 rounded-lg shadow-lg dark:bg-gray-800 dark:border-gray-700 flex flex-col">
                <form action="/crypto/sell" method="POST" class="flex flex-col space-y-4 flex-1">
                    @csrf
                    <div class="text-red-500 font-semibold text-xl">
                        @if (session('sold'))
                            <div class="alert alert-success">
                                {{ session('sold') }}
                            </div>
                        @endif
                    </div>
                    <h2 class="text-lg font-semibold leading-7 text-gray-900 dark:text-white" id="modal-title">Sell</h2>
                    <div>
                        <label for="crypto_sell" class="block text-sm font-medium text-gray-700 dark:text-gray-300">Choose
                            Cryptocurrency</label>
                        <select id="crypto_sell" name="crypto_sell" autocomplete="crypto_sell"
                                class="mt-1 block w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm dark:bg-gray-700 dark:border-gray-600 dark:text-white dark:focus:ring-indigo-500 dark:focus:border-indigo-500">
                            @foreach($ownedCrypto as $owned)
                                <option value="{{ $owned->id }}">
                                    {{ $owned->crypto_name }}
                                </option>
                            @endforeach
                        </select>
                        <x-form-error name="crypto_sell"/>
                    </div>
                    <div class="flex-grow"></div>
                    <div>
                        <button type="submit"
                                class="w-full flex justify-center py-2 px-4 border border-transparent rounded-md shadow-sm text-sm font-medium text-white bg-indigo-600 hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500">
                            Sell
                        </button>
                    </div>
                </form>
            </div>
    </div>


    <div class="mt-10 relative overflow-x-auto shadow-md sm:rounded-lg">
        <table class="w-full text-sm text-left rtl:text-right text-gray-500 dark:text-gray-400">
            <thead class="text-xs text-gray-700 uppercase dark:text-gray-400">
            <tr>
                <th scope="col" class="px-6 py-3 bg-gray-50 dark:bg-gray-800">name</th>
                <th scope="col" class="px-6 py-3">Amount</th>
                <th scope="col" class="px-6 py-3 bg-gray-50 dark:bg-gray-800">Price Then</th>
                <th scope="col" class="px-6 py-3">Price now</th>
                <th scope="col" class="px-6 py-3 bg-gray-50 dark:bg-gray-800">Profit</th>
                <th scope="col" class="px-6 py-3">%</th>
            </tr>
            </thead>
            @foreach($tableUpdate as $table)
                <tbody>
                <tr class="border-b border-gray-200 dark:border-gray-700">
                    <th scope="row"
                        class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap bg-gray-50 dark:text-white dark:bg-gray-800">{{ $table['crypto_name'] }}</th>
                    <td class="px-6 py-4">{{ $table['amount'] }}</td>
                    <td class="px-6 py-4 bg-gray-50 dark:bg-gray-800">{{ number_format($table['purchase_price'], 2) }}</td>
                    <td class="px-6 py-4">{{ number_format($table['priceNow'], 2) }}</td>
                    <td class="px-6 py-4 bg-gray-50 dark:bg-gray-800 {{ $table['profit'] > 0 ? 'text-lime-600' : 'text-red-500' }}">{{ number_format($table['profit'], 2) }}</td>
                    <td class="px-6 py-4 {{ $table['percentage'] > 0 ? 'text-lime-600' : 'text-red-500' }}">{{ number_format($table['percentage'], 2) }}</td>
                </tr>
                </tbody>
            @endforeach

        </table>
    </div>
    @endif
</x-layout>
