<x-layouts.admin>
    <section class="content">
        <div class="content-section">
            <h1>My Profile</h1>

            <div class="profile-card" style="background: linear-gradient(135deg, #667eea 0%, #764ba2 100%); padding: 30px; border-radius: 15px; margin-bottom: 25px; box-shadow: 0 8px 20px rgba(102, 126, 234, 0.3);">
                <div class="profile-header" style="display: flex; align-items: center; gap: 20px;">
                    <div class="avatar" style="width: 80px; height: 80px; border-radius: 50%; overflow: hidden; border: 4px solid white; box-shadow: 0 4px 10px rgba(0, 0, 0, 0.2);">
                        <div style="width:100%; height:100%; display:flex; align-items:center; justify-content:center; background:#fff; font-size:24px; font-weight:bold; color:#667eea;">
                            {{ strtoupper(substr(auth()->user()->name, 0, 2)) }}
                        </div>
                    </div>
                    <div class="profile-info">
                        <h2 style="font-size: 28px; color: white; margin-bottom: 5px;">{{ auth()->user()->name }}</h2>
                        <p style="color: rgba(255, 255, 255, 0.9); font-size: 16px;">Administrator</p>
                    </div>
                </div>
            </div>

            <div class="info-card">
                <div class="card-header">
                    <h3>Personal Information</h3>
                    <a href="{{ route('admin.profile.edit') }}" class="edit-btn">Manage →</a>
                </div>
                <div class="info-grid">
                    <div class="info-item">
                        <label>Name</label>
                        <p>{{ auth()->user()->name }}</p>
                    </div>
                    <div class="info-item">
                        <label>Email Address</label>
                        <p>{{ auth()->user()->email }}</p>
                    </div>
                    <div class="info-item">
                        <label>Mobile Number</label>
                        <p>{{ auth()->user()->phone ?? 'Not set' }}</p>
                    </div>
                    <div class="info-item">
                        <label>Role</label>
                        <p style="text-transform: capitalize;">{{ auth()->user()->role }}</p>
                    </div>
                </div>
            </div>

            <div class="info-card">
                <div class="card-header">
                    <h3>Password and Security</h3>
                    <a href="{{ route('admin.profile.password') }}" class="edit-btn">Manage →</a>
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
</x-layouts.admin>