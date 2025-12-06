<x-layouts.admin>
    <section class="content">
        <div id="overview-section" class="content-section active">
            <h1>Dashboard Overview</h1>

            <div class="stats-grid">
                <div class="stat-card">
                    <div class="stat-icon orders-icon">
                        <svg width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                            <path d="M9 3H5a2 2 0 0 0-2 2v4m6-6h10a2 2 0 0 1 2 2v4M9 3v18m0 0h10a2 2 0 0 0 2-2V9M9 21H5a2 2 0 0 1-2-2V9m0 0h18"></path>
                        </svg>
                    </div>
                    <div class="stat-info">
                        <h3>Total Orders</h3>
                        <p class="stat-number">{{ $totalOrders }}</p>
                        <span class="stat-trend up">All time</span>
                    </div>
                </div>

                <div class="stat-card">
                    <div class="stat-icon agents-icon">
                        <svg width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                            <path d="M17 21v-2a4 4 0 0 0-4-4H5a4 4 0 0 0-4 4v2"></path>
                            <circle cx="9" cy="7" r="4"></circle>
                            <path d="M23 21v-2a4 4 0 0 0-3-3.87"></path>
                            <path d="M16 3.13a4 4 0 0 1 0 7.75"></path>
                        </svg>
                    </div>
                    <div class="stat-info">
                        <h3>Active Agents</h3>
                        <p class="stat-number">{{ $activeAgents }}</p>
                        <span class="stat-trend">Registered agents</span>
                    </div>
                </div>

                <div class="stat-card">
                    <div class="stat-icon users-icon">
                        <svg width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                            <path d="M20 21v-2a4 4 0 0 0-4-4H8a4 4 0 0 0-4 4v2"></path>
                            <circle cx="12" cy="7" r="4"></circle>
                        </svg>
                    </div>
                    <div class="stat-info">
                        <h3>Total Users</h3>
                        <p class="stat-number">{{ $totalUsers }}</p>
                        <span class="stat-trend up">Registered customers</span>
                    </div>
                </div>

                <div class="stat-card">
                    <div class="stat-icon revenue-icon">
                        <svg width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                            <line x1="12" y1="1" x2="12" y2="23"></line>
                            <path d="M17 5H9.5a3.5 3.5 0 0 0 0 7h5a3.5 3.5 0 0 1 0 7H6"></path>
                        </svg>
                    </div>
                    <div class="stat-info">
                        <h3>Revenue</h3>
                        <p class="stat-number">₱{{ number_format($revenue, 2) }}</p>
                        <span class="stat-trend up">Total earnings</span>
                    </div>
                </div>
            </div>

            {{-- NEW: Transaction Stats --}}
            <div class="stats-grid" style="margin-top: 20px;">
                <div class="stat-card">
                    <div class="stat-icon" style="background: linear-gradient(135deg, #f39c12 0%, #e67e22 100%);">
                        <svg width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                            <circle cx="12" cy="12" r="10"></circle>
                            <polyline points="12 6 12 12 16 14"></polyline>
                        </svg>
                    </div>
                    <div class="stat-info">
                        <h3>Pending Verifications</h3>
                        <p class="stat-number">{{ $pendingTransactions }}</p>
                        <span class="stat-trend">Awaiting review</span>
                    </div>
                </div>

                <div class="stat-card">
                    <div class="stat-icon" style="background: linear-gradient(135deg, #27ae60 0%, #2ecc71 100%);">
                        <svg width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                            <path d="M22 11.08V12a10 10 0 1 1-5.93-9.14"></path>
                            <polyline points="22 4 12 14.01 9 11.01"></polyline>
                        </svg>
                    </div>
                    <div class="stat-info">
                        <h3>Verified Transactions</h3>
                        <p class="stat-number">{{ $verifiedTransactions }}</p>
                        <span class="stat-trend up">Approved payments</span>
                    </div>
                </div>

                <div class="stat-card">
                    <div class="stat-icon" style="background: linear-gradient(135deg, #9b59b6 0%, #8e44ad 100%);">
                        <svg width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                            <rect x="2" y="5" width="20" height="14" rx="2"></rect>
                            <line x1="2" y1="10" x2="22" y2="10"></line>
                        </svg>
                    </div>
                    <div class="stat-info">
                        <h3>Total Transactions</h3>
                        <p class="stat-number">{{ $totalTransactions }}</p>
                        <span class="stat-trend">All time</span>
                    </div>
                </div>
            </div>

            {{-- Quick Actions --}}
            @if($pendingTransactions > 0)
            <div style="margin-top: 30px; padding: 20px; background: #fff3cd; border-left: 4px solid #f39c12; border-radius: 8px;">
                <div style="display: flex; justify-content: space-between; align-items: center;">
                    <div>
                        <h3 style="margin: 0; color: #856404;">⚠️ Pending Payment Verifications</h3>
                        <p style="margin: 5px 0 0 0; color: #856404;">
                            You have {{ $pendingTransactions }} transaction(s) waiting for verification.
                        </p>
                    </div>
                    <a href="{{ route('admin.transactions') }}" class="btn-primary">
                        Review Now
                    </a>
                </div>
            </div>
            @endif

            {{-- Recent Activity Tabs --}}
            <div style="margin-top: 30px;">
                <div style="display: flex; gap: 10px; border-bottom: 2px solid #e0e0e0; margin-bottom: 20px;">
                    <button class="tab-btn active" data-tab="orders" 
                            style="padding: 10px 20px; border: none; background: none; font-weight: 600; cursor: pointer; border-bottom: 2px solid #667eea; margin-bottom: -2px;">
                        Recent Orders
                    </button>
                    <button class="tab-btn" data-tab="transactions"
                            style="padding: 10px 20px; border: none; background: none; font-weight: 600; cursor: pointer; color: #888;">
                        Recent Transactions
                    </button>
                </div>

                {{-- Recent Orders Tab --}}
                <div class="tab-content active" id="orders-tab">
                    <div class="activity-section">
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

                {{-- Recent Transactions Tab --}}
                <div class="tab-content" id="transactions-tab" style="display: none;">
                    <div class="activity-section">
                        <div class="activity-list">
                            @forelse($recentTransactions as $transaction)
                                <div class="activity-item">
                                    <div class="activity-icon">💳</div>
                                    <div class="activity-content">
                                        <p>
                                            <strong>Transaction #{{ $transaction->id }}</strong>
                                            - ₱{{ number_format($transaction->amount, 2) }}
                                            <span class="badge {{ $transaction->status === 'verified' ? 'completed' : 'in-progress' }}" 
                                                  style="margin-left: 10px; font-size: 11px;">
                                                {{ ucfirst($transaction->status) }}
                                            </span>
                                            <br>
                                            <small>{{ $transaction->user->name }} - Order #{{ $transaction->order_id }}</small>
                                        </p>
                                        <span class="activity-time">{{ $transaction->created_at->diffForHumans() }}</span>
                                    </div>
                                </div>
                            @empty
                                <p class="empty-activity">No recent transactions.</p>
                            @endforelse
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

</x-layouts.admin>