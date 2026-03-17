<x-layouts.guest title="Sign In">
    <auth-card>
        <template #promo>
            <h2>NEED AN ACCOUNT?</h2>
            <p>Sign up an account and enjoy the services with Hoyo Piloting service</p>
            <a href="{{ route('register') }}" class="submit-btn" style="text-decoration: none; display: inline-block; line-height: normal;">
                Create Account
            </a>
        </template>

        <template #form>
            <h2>SIGN IN</h2>
            <login-form 
                action="{{ route('login') }}" 
                initial-email="{{ old('email') }}"
                error-email="{{ $errors->first('email') }}"
            >
                <template #csrf>
                    @csrf
                </template>
            </login-form>
        </template>
    </auth-card>
</x-layouts.guest>
