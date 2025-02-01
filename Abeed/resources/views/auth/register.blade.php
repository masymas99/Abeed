<x-guest-layout>
    <form method="POST" enctype="multipart/form-data" action="{{ route('register') }}">
        @csrf

        <!-- Name -->
        <div>
            <x-input-label for="name" :value="__('Name')" />
            <x-text-input id="name" class="block mt-1 w-full" type="text" name="name" :value="old('name')" required autofocus autocomplete="name" />
            <x-input-error :messages="$errors->get('name')" class="mt-2" />
        </div>

        <!-- Email Address -->
        <div class="mt-4">
            <x-input-label for="email" :value="__('Email')" />
            <x-text-input id="email" class="block mt-1 w-full" type="email" name="email" :value="old('email')" required autocomplete="username" />
            <x-input-error :messages="$errors->get('email')" class="mt-2" />
        </div>

        <!-- Password -->
        <div class="mt-4">
            <x-input-label for="password" :value="__('Password')" />

            <x-text-input id="password" class="block mt-1 w-full"
                            type="password"
                            name="password"
                            required autocomplete="new-password" />

            <x-input-error :messages="$errors->get('password')" class="mt-2" />
        </div>

        <!-- Confirm Password -->
        <div class="mt-4">
            <x-input-label for="password_confirmation" :value="__('Confirm Password')" />

            <x-text-input id="password_confirmation" class="block mt-1 w-full"
                            type="password"
                            name="password_confirmation" required autocomplete="new-password" />

            <x-input-error :messages="$errors->get('password_confirmation')" class="mt-2" />
        </div>


        <div>
            <label for="role" class="text-gray-400">Role</label>
            <select class="form-select bg-gray-900 text-gray-400 w-full rounded" name="role" id="role" required>
                <option value="candidate" selected>Candidate</option>
                <option value="employer">Employer</option>
            </select>
        </div>

        <div id="employer-fields" style="display: none;">
            <label class="text-gray-400 mt-4" for="company_name">Company Name</label>
            <input type="text" id="company_name"class="block mt-1 w-full  bg-gray-900 text-gray-400 w-full rounded" name="company_name">

            <label class="form-label text-gray-400 mt-4" for="company_logo">Company Logo</label>
            <input class="form-control text-gray-400 mt-4" type="file" id="company_logo" name="company_logo">
        </div>

        <div>
            <label class="text-gray-400 mt-4 rounded" for="phone">Phone</label>

            <x-text-input class="block mt-1 w-full" type="text" id="phone" name="phone"/>
        </div>

        <div>
            <label class="text-gray-400 mt-4 rounded" for="address">Address</label>
            <textarea class="bg-gray-900 text-white w-full" id="address" name="address"></textarea>
        </div>
        <div class="flex items-center justify-end mt-4">
            <a class="underline text-sm text-gray-600 dark:text-gray-400 hover:text-gray-900 dark:hover:text-gray-100 rounded-md focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500 dark:focus:ring-offset-gray-800" href="{{ route('login') }}">
                {{ __('Already registered?') }}
            </a>

            <x-primary-button class="ms-4">
                {{ __('Register') }}
            </x-primary-button>
        </div>
        <script>
            document.getElementById('role').addEventListener('change', function () {
                const employerFields = document.getElementById('employer-fields');
                if (this.value === 'employer') {
                    employerFields.style.display = 'block';
                } else {
                    employerFields.style.display = 'none';
                }
            });
        </script>

    </form>
</x-guest-layout>
