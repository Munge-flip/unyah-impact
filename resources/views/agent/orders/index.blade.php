<x-layouts.agent>
    <section class="content">
        <div id="orders-section" class="content-section">
            <h1>Orders Handling</h1>

            <div class="orders-container">
                <!-- Order Card 1 -->
                <div class="order-card">
                    <div class="order-header">
                        <div class="order-id">
                            <strong>Order #1003</strong>
                            <span class="order-date">Oct 5</span>
                        </div>
                        <div class="status-dropdown">
                            <select class="status-select pending">
                                <option value="pending">Pending</option>
                                <option value="in-progress">In Progress</option>
                                <option value="completed">Completed</option>
                            </select>
                        </div>
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
                            <span class="label">Customer:</span>
                            <span>U***nh</span>
                        </div>
                    </div>
                    <div class="order-actions">
                        <a href=" {{ route('agent.order.show', ['id' => 1003]) }} " class="action-btn primary">View Details</a>
                        <button class="action-btn success mark-complete-btn">Mark Complete</button>
                        <button class="action-btn secondary">Chat with User</button>
                    </div>
                </div>

                <!-- Order Card 2 (with expanded details) -->
                <div class="order-card">
                    <div class="order-header">
                        <div class="order-id">
                            <strong>Order #1002</strong>
                            <span class="order-date">Oct 5</span>
                        </div>
                        <div class="status-dropdown">
                            <select class="status-select pending">
                                <option value="pending">Pending</option>
                                <option value="in-progress">In Progress</option>
                                <option value="completed">Completed</option>
                            </select>
                        </div>
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
                            <span class="label">Customer:</span>
                            <span>U***nh</span>
                        </div>
                    </div>
                    <div class="order-actions">
                        <a href=" {{ route('agent.order.show', ['id' => 1000]) }} " class="action-btn primary">View Details</a>
                        <button class="action-btn success mark-complete-btn">Mark Complete</button>
                        <button class="action-btn secondary">Chat with User</button>
                    </div>
                </div>

                <!-- Order Card 3 -->
                <div class="order-card">
                    <div class="order-header">
                        <div class="order-id">
                            <strong>Order #1001</strong>
                            <span class="order-date">Oct 4</span>
                        </div>
                        <div class="status-dropdown">
                            <select class="status-select in-progress">
                                <option value="pending">Pending</option>
                                <option value="in-progress" selected>In Progress</option>
                                <option value="completed">Completed</option>
                            </select>
                        </div>
                    </div>
                    <div class="order-details">
                        <div class="detail-row">
                            <span class="label">Game:</span>
                            <span>Honkai Star Rail</span>
                        </div>
                        <div class="detail-row">
                            <span class="label">Service:</span>
                            <span>Memory of Chaos</span>
                        </div>
                        <div class="detail-row">
                            <span class="label">Customer:</span>
                            <span>R***23</span>
                        </div>
                    </div>
                    <div class="order-actions">
                        <button class="action-btn primary">View Details</button>
                        <button class="action-btn success mark-complete-btn">Mark Complete</button>
                        <button class="action-btn secondary">Chat with User</button>
                    </div>
                </div>

                <!-- Order Card 4 - Completed -->
                <div class="order-card">
                    <div class="order-header">
                        <div class="order-id">
                            <strong>Order #1000</strong>
                            <span class="order-date">Oct 1</span>
                        </div>
                        <div class="status-dropdown">
                            <select class="status-select completed" disabled>
                                <option value="completed" selected>Completed</option>
                            </select>
                        </div>
                    </div>
                    <div class="order-details">
                        <div class="detail-row">
                            <span class="label">Game:</span>
                            <span>Zenless Zone Zero</span>
                        </div>
                        <div class="detail-row">
                            <span class="label">Service:</span>
                            <span>Shiyu Defense</span>
                        </div>
                        <div class="detail-row">
                            <span class="label">Customer:</span>
                            <span>J***xx</span>
                        </div>
                    </div>
                    <div class="order-actions">
                        <button class="action-btn primary">View Details</button>
                    </div>
                </div>
            </div>
        </div>
    </section>

</x-layouts.agent>
