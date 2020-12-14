<div class="h-100 row align-items-center">
    <div class="col-5"></div>
    <div class="col" >
        <x-guest-layout>
            <x-jet-authentication-card>
                <x-slot name="logo">
                    {{-- <x-jet-authentication-card-logo />--}}
                </x-slot>

                <x-jet-validation-errors class="mb-4" />

                @if (session('status'))
                    <div class="mb-4 font-medium text-sm text-green-600">
                        {{ session('status') }}
                    </div>
                @endif

                <form method="POST" action="{{ route('login') }}">
                    @csrf

                    <div>
                        <x-jet-label value="{{ __('Email') }}" />
                        <x-jet-input class="block mt-1 w-full" type="email" name="email" :value="old('email')" required autofocus />
                    </div>

                    <div class="mt-4">
                        <x-jet-label value="{{ __('Password') }}" />
                        <x-jet-input class="block mt-1 w-full" type="password" name="password" required autocomplete="current-password" />
                    </div>

                    <div class="block mt-4">
                        <label class="flex ">

                            <span class="ml-2 text-sm text-gray-600"><input type="checkbox" class="form-checkbox" name="remember">  {{ __('Remember me') }}</span>
                        </label>
                    </div>

                    <div class="flex items-center justify-end mt-4">
                        @if (Route::has('password.request'))
                            <a class="underline text-sm text-gray-600 hover:text-gray-900" href="{{ route('password.request') }}">
                                {{ __('Forgot your password?') }}
                            </a>
                        @endif

                        <x-jet-button class="mt-2 btn-primary">
                            {{ __('Login') }}
                        </x-jet-button>
                    </div>
                </form>
            </x-jet-authentication-card>
        </x-guest-layout>
    </div>
</div>


