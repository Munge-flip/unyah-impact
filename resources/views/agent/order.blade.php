<x-layouts.agent>
<section class="content">
            <div id="orders-section" class="content-section">
                <h1>Orders Handling</h1>

                <div class="orders-container">
                    <!-- Order Card 1 -->
                    <div class="order-card">
                        <div class="order-header">
                            <div class="order-id">
                                <strong>Order #1234</strong>
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
                            <button class="action-btn primary">View Details</button>
                            <button class="action-btn secondary">Chat with User</button>
                        </div>
                    </div>

                    <!-- Order Card 2 (with expanded details) -->
                    <div class="order-card expanded">
                        <div class="order-header">
                            <div class="order-id">
                                <strong>Order #1234</strong>
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
                                <span>100% Fontaine Area</span>
                            </div>
                            <div class="detail-row">
                                <span class="label">Customer:</span>
                                <span>U***nh</span>
                            </div>
                        </div>

                        <!-- Expanded Details -->
                        <div class="expanded-details">
                            <h4>Service Details</h4>
                            <div class="detail-list">
                                <div class="detail-item">
                                    <span>Region:</span>
                                    <strong>Fontaine</strong>
                                </div>
                                <div class="detail-item">
                                    <span>Completion Target:</span>
                                    <strong>100%</strong>
                                </div>
                                <div class="detail-item">
                                    <span>Payment:</span>
                                    <strong>₱500 - Paid</strong>
                                </div>
                                <div class="detail-item">
                                    <span>Login Credentials:</span>
                                    <strong>Provided</strong>
                                </div>
                            </div>
                            <div class="customer-notes">
                                <h5>Customer Notes:</h5>
                                <p>Please complete all waypoints and open all chests. Focus on exploration percentage first.</p>
                            </div>
                        </div>

                        <div class="order-actions">
                            <button class="action-btn success">Mark Complete</button>
                            <button class="action-btn secondary">Chat with User</button>
                        </div>
                    </div>

                    <!-- Order Card 3 -->
                    <div class="order-card">
                        <div class="order-header">
                            <div class="order-id">
                                <strong>Order #1233</strong>
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
                            <button class="action-btn secondary">Chat with User</button>
                        </div>
                    </div>

                    <!-- Order Card 4 - Completed -->
                    <div class="order-card">
                        <div class="order-header">
                            <div class="order-id">
                                <strong>Order #1232</strong>
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