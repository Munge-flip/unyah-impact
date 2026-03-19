<x-layouts.app>
    <x-slot:sidebar>
        <x-user.sidebar />
    </x-slot:sidebar>

    <section class="content">
        <div id="account-section" class="content-section">
            <h1>My Account</h1>

            <profile-card 
                name="{{ auth()->user()->name }}" 
                role="{{ auth()->user()->role }}" 
                avatar="{{ auth()->user()->avatar ? asset(auth()->user()->avatar) : '' }}"
            ></profile-card>

            <info-card title="Personal Information" manage-route="{{ route('user.dashboard.edit') }}">
                <div class="info-grid">
                    <div class="info-item">
                        <label>Name</label> <p>{{ auth()->user()->name }}</p>
                    </div>
                    <div class="info-item">
                        <label>Email Address</label>
                        <p>{{ auth()->user()->email }}</p>
                    </div>
                    <div class="info-item">
                        <label>Mobile Number</label>
                        <p>{{ auth()->user()->phone ?? 'Not set' }}</p>
                    </div>
                </div>
            </info-card>

            <info-card title="Password and Security" manage-route="{{ route('user.dashboard.update') }}">
                <div class="info-grid">
                    <div class="info-item">
                        <label>Password</label>
                        <p>••••••••</p>
                    </div>
                    <div class="info-item">
                        <label>Account Created</label>
                        <p>{{ auth()->user()->created_at->format('M d, Y') }}</p>
                    </div>
                </div>
            </info-card>
        </div>
    </section>
</x-layouts.app>