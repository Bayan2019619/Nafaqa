<x-guest-layout dir="rtl">
    <div class="mb-4 text-sm text-gray-600" dir="rtl">
        "هل نسيت كلمة المرور؟ لا بأس، أدخل بريدك الالكتروني ورقم هاتفك وستتمكن من اعادة تعيين كلمة المرور"
    </div>

    <!-- Session Status -->
    <x-auth-session-status class="mb-4" :status="session('status')" />

    <form method="POST" action="{{ route('password.email') }}" dir="rtl">
        @csrf

        <div class="mt-4">
    <x-input-label for="phone" :value="__('Phone')" />
    <x-text-input 
        id="phone" 
        dir="rtl" 
        maxlength="10"
        class="block mt-1 w-full" 
        type="tel" 
        name="phone" 
        :value="old('phone')" 
        placeholder="09XXXXXXXX"  
        required 
        autofocus 
        autocomplete="username"
        pattern="09[0-9]{8}"
        title="يرجى إدخال رقم هاتف يبدأ بـ 09 ويتكون من 10 أرقام"
    />
    <x-input-error :messages="$errors->get('phone')" class="mt-2" />
</div>

        <div class="flex items-center justify-end mt-4">
            <x-primary-button>
                {{ __('Submit') }}
            </x-primary-button>
        </div>
    </form>
</x-guest-layout>
