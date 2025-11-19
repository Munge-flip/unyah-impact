<x-layouts.admin>
    <section class="content">
        <div id="agents-section" class="content-section">
            <div class="section-header">
                <h1>Agents Management</h1>
                <button class="btn-primary" id="addAgentBtn">
                    <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                        <line x1="12" y1="5" x2="12" y2="19"></line>
                        <line x1="5" y1="12" x2="19" y2="12"></line>
                    </svg>
                    Add Agent
                </button>
            </div>

            <div class="agents-grid">
                <!-- Agent Card 1 -->
                <div class="agent-card">
                    <div class="agent-header">
                        <div class="agent-avatar">DB</div>
                        <div class="agent-info">
                            <h3>DarkBeam</h3>
                            <p class="agent-id">ID: #1234</p>
                        </div>
                        <div class="agent-stats">
                            <span class="stat-badge">3 active</span>
                        </div>
                    </div>
                    <div class="agent-details">
                        <div class="detail-item">
                            <span>Orders Handling:</span>
                            <strong>3</strong>
                        </div>
                        <div class="detail-item">
                            <span>Completion Rate:</span>
                            <strong>1/3</strong>
                        </div>
                        <div class="detail-item">
                            <span>Status:</span>
                            <span class="badge in-progress">Active</span>
                        </div>
                    </div>
                    <div class="agent-actions">
                        <button class="btn-secondary">View Orders</button>
                        <button class="btn-danger">Remove</button>
                    </div>
                </div>

                <!-- Agent Card 2 -->
                <div class="agent-card">
                    <div class="agent-header">
                        <div class="agent-avatar">CL</div>
                        <div class="agent-info">
                            <h3>Cola</h3>
                            <p class="agent-id">ID: #9813</p>
                        </div>
                        <div class="agent-stats">
                            <span class="stat-badge">1 active</span>
                        </div>
                    </div>
                    <div class="agent-details">
                        <div class="detail-item">
                            <span>Orders Handling:</span>
                            <strong>1</strong>
                        </div>
                        <div class="detail-item">
                            <span>Completion Rate:</span>
                            <strong>0/1</strong>
                        </div>
                        <div class="detail-item">
                            <span>Status:</span>
                            <span class="badge in-progress">Active</span>
                        </div>
                    </div>
                    <div class="agent-actions">
                        <button class="btn-secondary">View Orders</button>
                        <button class="btn-danger">Remove</button>
                    </div>
                </div>

                <!-- Agent Card 3 -->
                <div class="agent-card">
                    <div class="agent-header">
                        <div class="agent-avatar">JX</div>
                        <div class="agent-info">
                            <h3>Jinxx</h3>
                            <p class="agent-id">ID: #5412</p>
                        </div>
                        <div class="agent-stats">
                            <span class="stat-badge">2 active</span>
                        </div>
                    </div>
                    <div class="agent-details">
                        <div class="detail-item">
                            <span>Orders Handling:</span>
                            <strong>2</strong>
                        </div>
                        <div class="detail-item">
                            <span>Completion Rate:</span>
                            <strong>0/2</strong>
                        </div>
                        <div class="detail-item">
                            <span>Status:</span>
                            <span class="badge in-progress">Active</span>
                        </div>
                    </div>
                    <div class="agent-actions">
                        <button class="btn-secondary">View Orders</button>
                        <button class="btn-danger">Remove</button>
                    </div>
                </div>
            </div>
        </div>
    </section>
</x-layouts.admin>
