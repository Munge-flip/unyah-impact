<x-layouts.admin>
    <section class="content">
        <div id="agents-section" class="content-section">
            <div class="section-header">
                <h1>Agents Management</h1>
                <a href="{{ route('admin.agent.create') }}" class="btn-primary">
                    + Add Agent
                </a>
            </div>

            <div class="agents-grid">
                @forelse ($agents as $agent)
                    <div class="agent-card">
                        <div class="agent-header">
                            <div class="agent-avatar">
                                {{ strtoupper(substr($agent->name, 0, 2)) }}
                            </div>
                            <div class="agent-info">
                                <h3>{{ $agent->name }}</h3>
                                <p class="agent-id">ID: #{{ $agent->id }}</p>
                            </div>
                            <div class="agent-stats">
                                <span class="stat-badge">{{ $agent->tasks_count }} Active Orders</span>
                            </div>
                        </div>

                        <div class="agent-details">
                            <div class="detail-item">
                                <span>Orders Handling:</span>
                                <strong>{{ $agent->tasks_count }}</strong>
                            </div>
                            <div class="detail-item">
                                <span>Status:</span>
                                <span class="badge in-progress">Active</span>
                            </div>
                        </div>

                        <div class="agent-actions">
                            <a href="{{ route('admin.order', ['agent_id' => $agent->id]) }}" class="btn-secondary">
                                View Orders
                            </a>
                            
                            <a href="{{ route('admin.user.edit', $agent->id) }}" class="btn-danger">
                                Manage
                            </a>
                        </div>
                    </div>
                @empty
                    <p>No agents found.</p>
                @endforelse
            </div>
        </div>
    </section>
</x-layouts.admin>