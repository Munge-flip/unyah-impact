<x-layouts.app>
    <x-slot:sidebar>
        <x-user.sidebar />
    </x-slot:sidebar>

    <section class="content">
        <div id="account-section" class="content-section">
            <h1>My Account</h1>

            <div class="profile-card">
                <div class="profile-header">
                    <div class="avatar">
                        <img src="{{ auth()->user()->avatar ? asset(auth()->user()->avatar) : asset('img/weblogo.png') }}" alt="User Avatar">
                    </div>
                    <div class="profile-info">
                        <h2>{{ auth()->user()->name }}</h2>
                        <p class="user-status">
                            {{ ucfirst(auth()->user()->role) }}
                        </p>
                    </div>
                </div>
            </div>

            <div class="info-card">
                <div class="card-header">
                    <h3>Personal Information</h3>
                    <a href="{{ route('user.dashboard.edit') }}" class="edit-btn">Manage →</a>
                </div>
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
            </div>

            <div class="info-card">
                <div class="card-header">
                    <h3>Password and Security</h3>
                    <a href="{{ route('user.dashboard.update') }}" class="edit-btn">Manage →</a>
                </div>
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
            </div>
        </div>
    </section>
</x-layouts.app>