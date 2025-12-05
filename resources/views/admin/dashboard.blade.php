<x-layouts.admin>
    <section class="content">
        <div id="overview-section" class="content-section active">
            <h1>Dashboard Overview</h1>

            <div class="stats-grid">
                <div class="stat-card">
                    <div class="stat-icon orders-icon"><svg>...</svg></div>
                    <div class="stat-info">
                        <h3>Total Orders</h3>
                        <p class="stat-number">{{ $totalOrders }}</p>
                        <span class="stat-trend up">All time</span>
                    </div>
                </div>
                <div class="stat-card">
                    <div class="stat-icon agents-icon"><svg>...</svg></div>
                    <div class="stat-info">
                        <h3>Active Agents</h3>
                        <p class="stat-number">{{ $activeAgents }}</p>
                        <span class="stat-trend">Registered agents</span>
                    </div>
                </div>
                <div class="stat-card">
                    <div class="stat-icon users-icon"><svg>...</svg></div>
                    <div class="stat-info">
                        <h3>Total Users</h3>
                        <p class="stat-number">{{ $totalUsers }}</p>
                        <span class="stat-trend up">Registered customers</span>
                    </div>
                </div>
                <div class="stat-card">
                    <div class="stat-icon revenue-icon"><svg>...</svg></div>
                    <div class="stat-info">
                        <h3>Revenue</h3>
                        <p class="stat-number">₱{{ number_format($revenue, 2) }}</p>
                        <span class="stat-trend up">Total earnings</span>
                    </div>
                </div>
            </div>

            <div class="activity-section">
                <h2>Recent Activity</h2>
                <div class="activity-list">
                    
                    @forelse($recentOrders as $order)
                        <div class="activity-item">
                            <div class="activity-icon">📦</div>
                            <div class="activity-content">
                                <p>
                                    <strong>New order #{{ $order->id }}</strong> 
                                    - {{ $order->game }} ({{ $order->service_type }})
                                    <br>
                                    <small>by {{ $order->user->name ?? 'Unknown' }}</small>
                                </p>
                                <span class="activity-time">{{ $order->created_at->diffForHumans() }}</span>
                            </div>
                        </div>
                    @empty
                        <p class="empty-activity">No recent activity.</p>
                    @endforelse

                </div>
            </div>
        </div>
    </section>
</x-layouts.admin>