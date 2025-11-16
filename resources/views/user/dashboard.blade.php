<x-layouts.app>

    <x-slot name="main-content">

    </x-slot>

    <section class="content">
        <!-- My Account Section -->
        <div id="account-section" class="content-section active">
            <h1>My Account</h1>

            <!-- Profile Card -->
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

            <!-- Personal Information -->
            <div class="info-card">
                <div class="card-header">
                    <h3>Personal Information</h3>
                    <button class="edit-btn">Manage →</button>
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

            <!-- Security -->
            <div class="info-card">
                <div class="card-header">
                    <h3>Password and Security</h3>
                    <button class="edit-btn">Manage →</button>
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

        <!-- Order History Section -->
        <div id="orders-section" class="content-section">
            <h1>Order History</h1>

            <div class="orders-container">
                <!-- Order Card 1 -->
                <div class="order-card">
                    <div class="order-header">
                        <div class="order-id">
                            <strong>Order #1023</strong>
                            <span class="order-date">Oct 5</span>
                        </div>
                        <span class="status-badge pending">Pending</span>
                    </div>
                    <div class="order-details">
                        <div class="detail-row">
                            <span class="label">Game:</span>
                            <span>Genshin Impact</span>
                        </div>
                        <div class="detail-row">
                            <span class="label">Service:</span>
                            <span>Exploration</span>
                        </div>
                    </div>
                    <div class="order-actions">
                        <button class="action-btn primary">View</button>
                        <button class="action-btn secondary">Chat with Agent</button>
                    </div>
                </div>

                <!-- Order Card 2 -->
                <div class="order-card">
                    <div class="order-header">
                        <div class="order-id">
                            <strong>Order #1023</strong>
                            <span class="order-date">Oct 5</span>
                        </div>
                        <span class="status-badge pending">Pending</span>
                    </div>
                    <div class="order-details">
                        <div class="detail-row">
                            <span class="label">Game:</span>
                            <span>Genshin Impact</span>
                        </div>
                        <div class="detail-row">
                            <span class="label">Service:</span>
                            <span>100% Fontaine</span>
                        </div>
                    </div>
                    <div class="order-actions">
                        <button class="action-btn primary">View</button>
                        <button class="action-btn secondary">Chat with Agent</button>
                    </div>
                </div>

                <!-- Order Card 3 -->
                <div class="order-card">
                    <div class="order-header">
                        <div class="order-id">
                            <strong>Order #1022</strong>
                            <span class="order-date">Oct 4</span>
                        </div>
                        <span class="status-badge in-progress">In Progress</span>
                    </div>
                    <div class="order-details">
                        <div class="detail-row">
                            <span class="label">Game:</span>
                            <span>Honkai Star Rail</span>
                        </div>
                        <div class="detail-row">
                            <span class="label">Service:</span>
                            <span>MoC</span>
                        </div>
                    </div>
                    <div class="order-actions">
                        <button class="action-btn primary">View</button>
                        <button class="action-btn secondary">Chat with Agent</button>
                    </div>
                </div>

                <!-- Order Card 4 -->
                <div class="order-card">
                    <div class="order-header">
                        <div class="order-id">
                            <strong>Order #1021</strong>
                            <span class="order-date">Oct 3</span>
                        </div>
                        <span class="status-badge completed">Completed</span>
                    </div>
                    <div class="order-details">
                        <div class="detail-row">
                            <span class="label">Game:</span>
                            <span>Zenless Zone Zero</span>
                        </div>
                        <div class="detail-row">
                            <span class="label">Service:</span>
                            <span>Events</span>
                        </div>
                    </div>
                    <div class="order-actions">
                        <button class="action-btn primary">View</button>
                        <button class="action-btn secondary">Chat with Agent</button>
                    </div>
                </div>
            </div>
        </div>

        <!-- Live Chat Section -->
        <div id="chat-section" class="content-section">
            <h1>Live Chat</h1>

            <div class="chat-container">
                <div class="chat-box">
                    <div class="chat-messages" id="chatMessages">
                        <div class="chat-empty">
                            <svg width="64" height="64" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5">
                                <path d="M21 15a2 2 0 0 1-2 2H7l-4 4V5a2 2 0 0 1 2-2h14a2 2 0 0 1 2 2z"></path>
                            </svg>
                            <p>No messages yet</p>
                            <span>Start a conversation with our support team</span>
                        </div>
                    </div>
                    <div class="chat-input-container">
                        <input type="text" id="chatInput" placeholder="Message Live Agent" class="chat-input">
                        <button class="send-btn" id="sendBtn">
                            <svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                                <line x1="22" y1="2" x2="11" y2="13"></line>
                                <polygon points="22 2 15 22 11 13 2 9 22 2"></polygon>
                            </svg>
                        </button>
                    </div>
                </div>
            </div>
        </div>
    </section>

</x-layouts.app>
