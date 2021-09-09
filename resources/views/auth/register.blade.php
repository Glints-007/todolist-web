<x-guest-layout>
    <section>
        <x-slot name="logo">
            {{-- <a href="/">
                <x-application-logo class="w-20 h-20 fill-current text-gray-500" />
            </a> --}}
        </x-slot>

        <div class="card">
            <div class="card__inner">
                <div class="image__wrapper">
                    <img src="{{ asset('img/img-1.png') }}" alt="Illustration Image">
                </div>
                <div class="login-form">
                    <!-- Validation Errors -->
                    <x-auth-validation-errors class="mb-4" :errors="$errors" />

                    <form method="POST" action="{{ route('register') }}">
                        @csrf

                        <!-- Name -->
                        <div>
                            <x-label for="name" :value="__('Name')" />

                            <x-input id="name" class="block mt-1 w-full" type="text" name="name" :value="old('name')" required autofocus />
                        </div>

                        <!-- Email Address -->
                        <div class="mt-2">
                            <x-label for="email" :value="__('Email')" />

                            <x-input id="email" class="block mt-1 w-full" type="email" name="email" :value="old('email')" required />
                        </div>

                        <!-- Password -->
                        <div class="mt-2">
                            <x-label for="password" :value="__('Password')" />

                            <x-input id="password" class="block mt-1 w-full"
                                            type="password"
                                            name="password"
                                            required autocomplete="new-password" />
                        </div>

                        <!-- Confirm Password -->
                        <div class="mt-2">
                            <x-label for="password_confirmation" :value="__('Confirm Password')" />

                            <x-input id="password_confirmation" class="block mt-1 w-full"
                                            type="password"
                                            name="password_confirmation" required />
                        </div>

                        <!-- Role -->
                        <div class="mt-2">
                            <x-label for="role" :value="__('Register as')" />

                            <x-select id="role" class="block mt-1 w-full"
                                            name="role" required>
                                            <option value=0>User</option>
                                            <option value=1>Admin</option>
                            </x-select>
                        </div>

                        <div class="flex items-center justify-end mt-2">
                            <a class="underline text-sm text-gray-600 hover:text-gray-900" href="{{ route('login') }}">
                                {{ __('Already registered?') }}
                            </a>

                            <x-button class="ml-4">
                                {{ __('Register') }}
                            </x-button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </section>
</x-guest-layout>
