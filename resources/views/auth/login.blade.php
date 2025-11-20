<x-layouts.guest title="Sign In">
    <x-auth-card>
        
        {{-- LEFT SIDE: Tells user to go to Sign Up --}}
        <x-slot:info>
            <h2>NEED AN ACCOUNT?</h2>
            <p>Sign up an account and enjoy the services with Hoyo Piloting service</p>
            <a href="{{ route('register') }}" class="submit-btn" style="text-decoration: none; display: inline-block; line-height: normal;">
                Create Account
            </a>
        </x-slot:info>

        {{-- RIGHT SIDE: The Login Form --}}
        <x-slot:form>
            <h2>SIGN IN</h2>
            
            <form class="form-content active" action="{{ route('login') }}" method="POST">
                @csrf
                
                <div class="form-group">
                    <input type="email" name="email" placeholder="Email" required>
                </div>
                <div class="form-group">
                    <input type="password" name="password" placeholder="Password" required>
                </div>

                <button type="submit" class="submit-btn">Sign In</button>
            </form>
        </x-slot:form>

    </x-auth-card>
</x-layouts.guest>