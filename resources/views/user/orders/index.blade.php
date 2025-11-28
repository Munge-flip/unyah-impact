<x-layouts.app>
    <x-slot:sidebar>
        <x-user.sidebar />
    </x-slot:sidebar>
    <section class="content">
        <div id="orders-section" class="content-section">
            <h1>Order History</h1>

            <div class="orders-container">
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
                        <div class="detail-row">
                            <span class="label">Amount:</span>
                            <span>₱250.00</span>
                        </div>
                    </div>
                    <div class="order-actions">
                        <a href="{{ route('user.order.show', ['id' => 1023]) }}" class="action-btn primary">View</a>
                        <a href="{{ route('user.chat') }}" class="action-btn secondary">Chat with Agent</a>
                    </div>
                </div>

                <div class="order-card">
                    <div class="order-header">
                        <div class="order-id">
                            <strong>Order #1022</strong>
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
                        <div class="detail-row">
                            <span class="label">Amount:</span>
                            <span>₱250.00</span>
                        </div>
                    </div>
                    <div class="order-actions">
                        <a href="{{ route('user.order.show', ['id' => 1022]) }}" class="action-btn primary">View</a>
                        <a href="{{ route('user.chat') }}" class="action-btn secondary">Chat with Agent</a>
                    </div>
                </div>

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
                        <div class="detail-row">
                            <span class="label">Amount:</span>
                            <span>₱250.00</span>
                        </div>
                    </div>
                    <div class="order-actions">
                        <a href="{{ route('user.order.show', ['id' => 1021]) }}" class="action-btn primary">View</a>
                        <a href="{{ route('user.chat') }}" class="action-btn secondary">Chat with Agent</a>
                    </div>
                </div>

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
                        <div class="detail-row">
                            <span class="label">Amount:</span>
                            <span>₱250.00</span>
                        </div>
                    </div>
                    <div class="order-actions">
                        <a href="{{ route('user.order.show', ['id' => 1021]) }}" class="action-btn primary">View</a>
                        <a href="{{ route('user.chat') }}" class="action-btn secondary">Chat with Agent</a>
                    </div>
                </div>
            </div>
        </div>
    </section>
</x-layouts.app>
