<x-guest-layout>
    <div class="mb-4 text-sm text-gray-600">
        Please enter the OTP sent to your email.
    </div>

    <x-auth-validation-errors class="mb-4" :errors="$errors" />

    <form method="POST" action="{{ route('verify.otp.post') }}">
        @csrf

        <div>
            <x-label for="otp" :value="'OTP Code'" />
            <x-input id="otp" class="block mt-1 w-full" type="text" name="otp" required autofocus />
        </div>

        <div class="flex items-center justify-end mt-4">
            <x-primary-button class="ml-4">
                Verify OTP
            </x-primary-button>
        </div>
    </form>
</x-guest-layout>
