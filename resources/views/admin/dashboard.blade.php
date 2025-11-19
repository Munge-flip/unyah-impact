<x-layouts.admin>
    <section class="content">
        <div id="overview-section" class="content-section active">
            <h1>Dashboard Overview</h1>

            <!-- Stats Cards -->
            <div class="stats-grid">
                <div class="stat-card">
                    <div class="stat-icon orders-icon">
                        <svg width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                            <path d="M9 3H5a2 2 0 0 0-2 2v4m6-6h10a2 2 0 0 1 2 2v4M9 3v18m0 0h10a2 2 0 0 0 2-2V9M9 21H5a2 2 0 0 1-2-2V9m0 0h18"></path>
                        </svg>
                    </div>
                    <div class="stat-info">
                        <h3>Total Orders</h3>
                        <p class="stat-number">47</p>
                        <span class="stat-trend up">+12% from last month</span>
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
                        <p class="stat-number">3</p>
                        <span class="stat-trend">6 orders in progress</span>
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
                        <p class="stat-number">124</p>
                        <span class="stat-trend up">+8 this week</span>
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
                        <p class="stat-number">₱18,450</p>
                        <span class="stat-trend up">+24% from last month</span>
                    </div>
                </div>
            </div>

            <!-- Recent Activity -->
            <div class="activity-section">
                <h2>Recent Activity</h2>
                <div class="activity-list">
                    <div class="activity-item">
                        <div class="activity-icon">📦</div>
                        <div class="activity-content">
                            <p><strong>New order #1234</strong> - Genshin Impact Exploration</p>
                            <span class="activity-time">5 minutes ago</span>
                        </div>
                    </div>
                    <div class="activity-item">
                        <div class="activity-icon">✅</div>
                        <div class="activity-content">
                            <p><strong>Order #1021 completed</strong> by Agent 1</p>
                            <span class="activity-time">1 hour ago</span>
                        </div>
                    </div>
                    <div class="activity-item">
                        <div class="activity-icon">👤</div>
                        <div class="activity-content">
                            <p><strong>New user registered</strong> - reyeah23</p>
                            <span class="activity-time">3 hours ago</span>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
</x-layouts.admin>
