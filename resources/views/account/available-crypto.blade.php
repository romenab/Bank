<x-layout>
    <x-slot:heading>
        Available Cryptocurrencies
    </x-slot:heading>

    <div class="mt-10 relative overflow-x-auto shadow-md sm:rounded-lg">
        <table class="w-full text-sm text-left rtl:text-right text-gray-500 dark:text-gray-400">
            <thead class="text-xs text-gray-700 uppercase dark:text-gray-400">
            <tr>
                <th scope="col" class="px-6 py-3 bg-gray-50 dark:bg-gray-800">Name</th>
                <th scope="col" class="px-6 py-3">Price $</th>
                <th scope="col" class="px-6 py-3 bg-gray-50 dark:bg-gray-800">1h %</th>
                <th scope="col" class="px-6 py-3">24h %</th>
                <th scope="col" class="px-6 py-3 bg-gray-50 dark:bg-gray-800">7d %</th>
                <th scope="col" class="px-6 py-3">Market Cap</th>
            </tr>
            </thead>
            @foreach($currencies as $currency)
                <tbody>
                <tr class="border-b border-gray-200 dark:border-gray-700">
                    <th scope="row" class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap bg-gray-50 dark:text-white dark:bg-gray-800">{{ $currency['name'] }}</th>
                    <td class="px-6 py-4">{{ number_format($currency['price'], 2, '.', ',') }}</td>
                    <td class="px-6 py-4 bg-gray-50 dark:bg-gray-800 {{ $currency['percent_one'] > 0 ? 'text-green-600' : 'text-red-500' }}">{{ round($currency['percent_one'], 2) }}</td>
                    <td class="px-6 py-4 {{ $currency['percent_twenty_four'] > 0 ? 'text-green-600' : 'text-red-500' }}">{{ round($currency['percent_twenty_four'], 2) }}</td>
                    <td class="px-6 py-4 bg-gray-50 dark:bg-gray-800 {{ $currency['percent_seven'] > 0 ? 'text-green-600' : 'text-red-500' }}">{{  round($currency['percent_seven'], 2) }}</td>
                    <td class="px-6 py-4 x">{{ number_format($currency['market_cap'], 0, '.', ',') }}</td>
                </tr>
                </tbody>
            @endforeach
        </table>
    </div>
</x-layout>
