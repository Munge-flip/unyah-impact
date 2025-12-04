<x-layouts.agent>
    <section class="content">
        <div id="account-section" class="content-section active">
            <h1>My Account</h1>

            <div class="agent-profile-card">
                <div class="profile-header">
                    <div class="avatar">
                        <div style="width:100%; height:100%; display:flex; align-items:center; justify-content:center; background:#fff; font-size:24px; font-weight:bold; color:#667eea;">
                            {{ strtoupper(substr($agent->name, 0, 2)) }}
                        </div>
                    </div>
                    <div class="profile-info">
                        <h2>{{ $agent->name }}</h2>
                        <p class="agent-role">Agent ID: #{{ $agent->id }}</p>
                    </div>
                </div>

                <div class="performance-stats">
                    <div class="stat-item">
                        <div class="stat-icon">📦</div>
                        <div class="stat-details">
                            <p class="stat-label">Orders Handling</p>
                            <p class="stat-value">{{ $ordersHandling }}</p>
                        </div>
                    </div>
                    <div class="stat-item">
                        <div class="stat-icon">✅</div>
                        <div class="stat-details">
                            <p class="stat-label">Completed</p>
                            <p class="stat-value">{{ $completedCount }}</p>
                        </div>
                    </div>
                    <div class="stat-item">
                        <div class="stat-icon">📊</div>
                        <div class="stat-details">
                            <p class="stat-label">Completion Rate</p>
                            <p class="stat-value">{{ $completionRate }}</p>
                        </div>
                    </div>
                </div>
            </div>

            <div class="info-card">
                <div class="card-header">
                    <h3>Personal Information</h3>
                    <a href="{{ route('agent.dashboard.edit') }}" class="edit-btn">Manage →</a>
                </div>
                <div class="info-grid">
                    <div class="info-item">
                        <label>Name</label>
                        <p>{{ $agent->name }}</p>
                    </div>
                    <div class="info-item">
                        <label>Email Address</label>
                        <p>{{ $agent->email }}</p>
                    </div>
                    <div class="info-item">
                        <label>Mobile Number</label>
                        <p>{{ $agent->phone ?? 'Not set' }}</p>
                    </div>
                </div>
            </div>

            <div class="info-card">
                <div class="card-header">
                    <h3>Password and Security</h3>
                    <a href="{{ route('agent.dashboard.update') }}" class="edit-btn">Manage →</a>
                </div>
                <div class="info-grid">
                    <div class="info-item">
                        <label>Password</label>
                        <p>••••••••</p>
                    </div>
                    <div class="info-item">
                        <label>Account Created</label>
                        <p>{{ $agent->created_at->format('M d, Y') }}</p>
                    </div>
                </div>
            </div>
        </div>
    </section>
</x-layouts.agent>