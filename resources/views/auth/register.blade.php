<x-layouts.guest title="Sign Up">
    <x-auth-card>
        
        {{-- LEFT SIDE: Tells user to go to Sign In --}}
        <x-slot:info>
            <h2>ALREADY HAVE AN ACCOUNT?</h2>
            <p>Sign in to our account and enjoy your service with Hoyo Piloting service</p>
            <a href="{{ route('login') }}" class="submit-btn" style="text-decoration: none; display: inline-block; line-height: normal;">
                Sign In
            </a>
        </x-slot:info>

        <x-slot:form>
            <h2>SIGN UP</h2>
            
            <form class="form-content active" action="{{ route('register') }}" method="POST">
                @csrf
                
                <div class="form-group">
                    <input type="text" name="name" placeholder="Name" required>
                </div>
                <div class="form-group">
                    <input type="email" name="email" placeholder="Email" required>
                </div>
                <div class="form-group">
                    <input type="tel" name="phone" placeholder="Phone Number" required>
                </div>
                <div class="form-group">
                    <input type="password" name="password" placeholder="Password" required>
                </div>
                <div class="form-group">
                    <input type="password" name="password_confirmation" placeholder="Confirm Password" required>
                </div>

                <button type="submit" class="submit-btn">Sign Up</button>
            </form>
        </x-slot:form>

    </x-auth-card>
</x-layouts.guest>