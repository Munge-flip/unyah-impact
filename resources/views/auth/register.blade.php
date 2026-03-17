<x-layouts.guest title="Sign Up">
    <auth-card>
        
        {{-- LEFT SIDE: Tells user to go to Sign In --}}
        <template #promo>
            <h2>ALREADY HAVE AN ACCOUNT?</h2>
            <p>Sign in to our account and enjoy your service with Hoyo Piloting service</p>
            <a href="{{ route('login') }}" class="submit-btn" style="text-decoration: none; display: inline-block; line-height: normal;">
                Sign In
            </a>
        </template>

        <template #form>
            <h2>SIGN UP</h2>
            <register-form 
                action="{{ route('register') }}" 
                :errors="{{ json_encode($errors->getMessages()) }}"
                :old="{{ json_encode(old()) }}"
            >
                <template #csrf>
                    @csrf
                </template>
            </register-form>
        </template>

    </auth-card>
</x-layouts.guest>