<x-guest-layout>
<x-form method="POST" action="{{ route('register.store') }}">
    <div>
        <x-label for="name" value="{{ __('Name') }}" />
        <x-input id="name" class="block mt-1 w-full" type="text" name="name" :value="old('name')" required autofocus
            autocomplete="name" />
    </div>
    <div class="mt-4">
        <x-label for="email" value="{{ __('Email') }}" />
        <x-input id="email" class="block mt-1 w-full" type="email" name="email" :value="old('email')" required
            autocomplete="username" />
    </div>
    <div class="flex justify-between gap-5 items-center">
        <div class="mt-4 w-50">
            <x-label for="matricula" value="{{ __('Num. de Matrícula') }}" />
            <x-input id="matricula" class="block mt-1 w-full" type="number" name="matricula" :value="old('matricula')"
                required autocomplete="username" />
        </div>
        <div class="mt-4 w-50">
            <x-label for="users ">
                Selecione o tipo de Usuário
            </x-label>
            <select name="users" id="users"
                class="w-full bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-indigo-500 focus:border-indigo-500 block p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-indigo-500 dark:focus:border-indigo-500">
                <option value="orientador">Orientador</option>
                <option value="aluno">Aluno</option>
            </select>
        </div>
    </div>
    <div class="mt-4">
        <x-label for="password" value="{{ __('Password') }}" />
        <x-input id="password" class="block mt-1 w-full" type="password" name="password" required
            autocomplete="new-password" />
    </div>
    <div class="mt-4">
        <x-label for="password_confirmation" value="{{ __('Confirm Password') }}" />
        <x-input id="password_confirmation" class="block mt-1 w-full" type="password" name="password_confirmation"
            required autocomplete="new-password" />
    </div>
    @if (Laravel\Jetstream\Jetstream::hasTermsAndPrivacyPolicyFeature())
        <div class="mt-4">
            <x-label for="terms">
                <div class="flex items-center">
                    <x-checkbox name="terms" id="terms" required />
                    <div class="ms-2">
                        {!! __('I agree to the :terms_of_service and :privacy_policy', [
            'terms_of_service' => '<a target="_blank" href="' . route('terms.show') . '" class="underline text-sm text-gray-600 dark:text-gray-400 hover:text-gray-900 dark:hover:text-gray-100 rounded-md focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500 dark:focus:ring-offset-gray-800">' . __('Terms of Service') . '</a>',
            'privacy_policy' => '<a target="_blank" href="' . route('policy.show') . '" class="underline text-sm text-gray-600 dark:text-gray-400 hover:text-gray-900 dark:hover:text-gray-100 rounded-md focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500 dark:focus:ring-offset-gray-800">' . __('Privacy Policy') . '</a>',
        ]) !!}
                    </div>
                </div>
            </x-label>
        </div>
    @endif
    <x-slot:button>
        <div class="flex items-center justify-end mt-4">
            <x-button class="ms-4">
                {{ __('Registre o usuário') }}
            </x-button>
        </div>
    </x-slot:button>
</x-form>
</x-guest-layout>