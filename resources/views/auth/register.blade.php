<x-layout>
    <x-slot:heading>
        Registration
    </x-slot:heading>
    <div class="sm:mx-auto sm:w-full sm:max-w-sm">
            <form action="/register" method="POST">
                @csrf
                <div class="flex-1 max-w-sm p-6 bg-white border border-gray-200 rounded-lg shadow-lg dark:bg-gray-800 dark:border-gray-700">
                <x-form-field>
                    <x-form-label for="first_name">First Name</x-form-label>
                    <div class="mt-2">
                        <x-form-input name="first_name" id="first_name"/>
                        <x-form-error name="first_name"/>
                    </div>
                </x-form-field>

                <x-form-field>
                    <x-form-label for="last_name">Last Name</x-form-label>
                    <div class="mt-2">
                        <x-form-input name="last_name" id="last_name"/>
                        <x-form-error name="last_name"/>
                    </div>
                </x-form-field>

                <x-form-field>
                    <x-form-label for="email">Email</x-form-label>
                    <div class="mt-2">
                        <x-form-input name="email" id="email" type="email"/>
                        <x-form-error name="email"/>
                    </div>
                </x-form-field>

                <x-form-field>
                    <x-form-label for="password">Password</x-form-label>
                    <div class="mt-2">
                        <x-form-input name="password" id="password" type="password"/>
                        <x-form-error name="password"/>
                    </div>
                </x-form-field>
                <div class="mt-3">
                    <x-form-button>Continue</x-form-button>
                </div>
                </div>
            </form>
        </div>
</x-layout>
