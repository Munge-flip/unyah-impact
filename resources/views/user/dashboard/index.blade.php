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
                        <img src="img/weblogo.png" alt="User Avatar">
                    </div>
                    <div class="profile-info">
                        <h2>U***nh</h2>
                        <p class="user-status">Active Member</p>
                    </div>
                </div>
            </div>

            <div class="info-card">
                <div class="card-header">
                    <h3>Personal Information</h3>
                    <a href=" {{ route('user.dashboard.edit') }} " class="edit-btn">Manage →</a>
                </div>
                <div class="info-grid">
                    <div class="info-item">
                        <label>Username</label>
                        <p>U***nh</p>
                    </div>
                    <div class="info-item">
                        <label>Email Address</label>
                        <p>gg******2@ssct.edu.ph</p>
                    </div>
                    <div class="info-item">
                        <label>Mobile Number</label>
                        <p>999****99</p>
                    </div>
                </div>
            </div>

            <div class="info-card">
                <div class="card-header">
                    <h3>Password and Security</h3>
                    <a href=" {{ route('user.dashboard.update') }} " class="edit-btn">Manage →</a>
                </div>
                <div class="info-grid">
                    <div class="info-item">
                        <label>Password</label>
                        <p>••••••••</p>
                    </div>
                    <div class="info-item">
                        <label>Last Updated</label>
                        <p>07/10/225</p>
                    </div>
                </div>
            </div>
        </div>


    </section>

</x-layouts.app>
