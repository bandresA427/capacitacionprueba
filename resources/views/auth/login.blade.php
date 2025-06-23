<x-guest-layout>
    <!-- Session Status -->

    <div class="container">
        <img src="{{ asset('fondoplanta.jpg') }}" alt="Login background" style="float:left; width: 850px; height: 500px;">

        <div class="card card-primary card-outline-primary ml-2 mt-2 card-md align-items-center" style="width: 500px; height: 500px; float:right; margin-right: 20px;">
            <div class="card-body"> <br><br><br>
                <x-auth-session-status class="mb-4" :status="session('status')" />
                <form method="POST" action="{{ route('login') }}">
                    @csrf
                    <!-- Email Address -->
                    <img src="{{ asset('SISCA.png') }}" style="float: left;">
                    <img src="{{ asset('jeantexlogoB.jpg') }}" style="float: right;"> <br><br><br>
                    <div>
                        <x-input-label for="email" :value="__('Correo electronico')" />
                        <x-text-input id="email" class="block mt-1 w-full" type="email" name="email" :value="old('email')" required autofocus autocomplete="username" />
                        <x-input-error :messages="$errors->get('email')" class="mt-2" />
                    </div>

                    <!-- Password -->
                    <div class="mt-4">
                        <x-input-label for="password" :value="__('Contraseña')" />

                        <x-text-input id="password" class="block mt-1 w-full" type="password" name="password" required autocomplete="current-password" />

                        <x-input-error :messages="$errors->get('password')" class="mt-2" />
                    </div>

                    <!-- Remember Me -->
                    <div class="block mt-4">
                        <label for="remember_me" class="inline-flex items-center">
                            <input id="remember_me" type="checkbox" class="rounded border-gray-300 text-indigo-600 shadow-sm focus:ring-indigo-500" name="remember">
                            <span class="ms-3 text-sm text-gray-600" style="width: 60px;">{{ __('Recuerdame') }}</span>
                        </label>
                    </div>
            </div>
            <div class="flex items-center justify-end mt-4">


                <x-primary-button class="ms-4" style="width: 150px; height: 60px; background-color:#0e4a80; font-size: 20px; " >

                    {{ __('Ingresar') }}
                </x-primary-button>



            </div>

            </form>
        </div>
    </div>
    </div>
</x-guest-layout>