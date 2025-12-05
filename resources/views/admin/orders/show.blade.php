<x-layouts.admin>
    <x-slot:sidebar>
        <x-admin.sidebar />
    </x-slot:sidebar>

    <section class="content">

        <div class="section-header">
            <h1>Order Details</h1>
            <a href="{{ route('admin.order') }}" class="action-link">
                ← Back to Orders
            </a>
        </div>

        <div class="admin-card">
            <div class="card-header">
                <div>
                    <h3>Order #{{ $order->id }}</h3>
                    <span class="order-date">
                        {{ $order->created_at->format('M d, Y \a\t h:i A') }}
                    </span>
                </div>

                @php
                $statusClass = match($order->status) {
                'completed' => 'completed',
                'in-progress' => 'in-progress',
                default => 'pending',
                };
                @endphp
                <span class="badge {{ $statusClass }}">
                    {{ ucfirst($order->status) }}
                </span>
            </div>
        </div>

        <div class="admin-card">
            <div class="card-header">
                <h3>Service Details</h3>
            </div>
            <div class="card-body">
                <div class="detail-row">
                    <span class="label">Game:</span>
                    <strong>{{ $order->game }}</strong>
                </div>
                <div class="detail-row">
                    <span class="label">Category:</span>
                    <strong>{{ ucfirst($order->service_category) }}</strong>
                </div>
                <div class="detail-row">
                    <span class="label">Service Type:</span>
                    <strong>{{ $order->service_type }}</strong>
                </div>
                <div class="detail-row">
                    <span class="label">Customer:</span>
                    <strong>
                        {{ $order->user->name ?? 'Unknown User' }}
                        <span class="user-id-sub">(ID: #{{ $order->user_id }})</span>
                    </strong>
                </div>
                <div class="detail-row">
                    <span class="label">Amount Paid:</span>
                    <span class="price">₱{{ number_format($order->price, 2) }}</span>
                </div>
            </div>
        </div>

        <div class="admin-card">
            <div class="card-header">
                <h3>Timeline</h3>
            </div>
            <div class="card-body">
                <div class="detail-row">
                    <span class="label">Order Placed:</span>
                    <strong>{{ $order->created_at->format('M d, Y') }}</strong>
                </div>
                @if($order->status === 'completed')
                <div class="detail-row">
                    <span class="label">Completed On:</span>
                    <strong>{{ $order->updated_at->format('M d, Y') }}</strong>
                </div>
                @else
                <div class="detail-row">
                    <span class="label">Status:</span>
                    <strong class="status-text-pending">In Progress...</strong>
                </div>
                @endif
            </div>
        </div>

        <div class="admin-card">
            <div class="card-header">
                <h3>Assignment</h3>
            </div>
            <div class="card-body">
                <div class="detail-row">
                    <span class="label">Current Agent:</span>
                    <strong>{{ $order->agent->name ?? 'Unassigned' }}</strong>
                </div>

                <form action="{{ route('admin.order.assign', $order->id) }}" method="POST" class="assignment-section">
                    @csrf
                    @method('PATCH')

                    <div class="form-group">
                        <label>Assign to Agent:</label>
                        <div class="assignment-row">
                            <select name="agent_id" class="search-input assignment-select">
                                <option value="" disabled selected>Select an Agent</option>
                                @foreach($agents as $agent)
                                <option value="{{ $agent->id }}" {{ $order->agent_id == $agent->id ? 'selected' : '' }}>
                                    {{ $agent->name }}
                                </option>
                                @endforeach
                            </select>

                            <button type="submit" class="btn-primary">
                                Assign
                            </button>
                        </div>
                    </div>
                </form>

                @if($order->status !== 'completed')
                <div class="mt-15">
                    <button class="action-btn success w-100">Mark as Complete</button>
                </div>
                @endif
            </div>
        </div>

    </section>
</x-layouts.admin>