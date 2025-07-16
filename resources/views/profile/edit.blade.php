<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-black leading-tight text-center">
            {{ __('Edit Profile') }}
        </h2>
    </x-slot>

    <div class="py-12 min-h-screen">
        <div class="max-w-3xl mx-auto space-y-8">
            <div class="glass rounded-xl shadow-md border border-gray-200 p-8">
                <h3 class="font-semibold text-lg text-black mb-4">Profile Information</h3>
                <p class="text-black mb-6">Update your account's profile information and email address.</p>
                @include('profile.partials.update-profile-information-form', ['user' => auth()->user()])
            </div>
            <div class="glass rounded-xl shadow-md border border-gray-200 p-8">
                <h3 class="font-semibold text-lg text-black mb-4">Update Password</h3>
                <p class="text-black mb-6">Ensure your account is using a long, random password to stay secure.</p>
                @include('profile.partials.update-password-form')
            </div>
            <div class="flex justify-end">
                <button type="button" onclick="saveAllChanges()" class="inline-flex items-center gap-2 px-6 py-3 bg-[#1877f2] text-white font-semibold rounded-lg hover:bg-[#145db2] transition-colors shadow-md">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path>
                    </svg>
                    Save All Changes
                </button>
            </div>
        </div>
    </div>

    <script>
        function saveAllChanges() {
            // Submit the profile information form
            document.querySelector('form[action="{{ route("profile.update") }}"]').submit();
            
            // Submit the password form if it has data
            const passwordForm = document.querySelector('form[action="{{ route("password.update") }}"]');
            const currentPassword = passwordForm.querySelector('input[name="current_password"]').value;
            const password = passwordForm.querySelector('input[name="password"]').value;
            const passwordConfirmation = passwordForm.querySelector('input[name="password_confirmation"]').value;
            
            if (currentPassword || password || passwordConfirmation) {
                passwordForm.submit();
            }
        }
    </script>
</x-app-layout>
