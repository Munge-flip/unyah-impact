<x-layouts.agent>
    <section class="content">
        
        <div class="section-header">
            <h1>Order Details</h1>
            <a href="{{ route('agent.order') }}" class="btn-secondary">
                ← Back to My Tasks
            </a>
        </div>

        <div class="info-card">
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

        <div class="info-card">
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
                    <strong>{{ $order->user->name ?? 'Unknown User' }}</strong>
                </div>
                <div class="detail-row">
                    <span class="label">Amount Paid:</span>
                    <span class="price">₱{{ number_format($order->price, 2) }}</span>
                </div>
            </div>
        </div>

        <div class="info-card">
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
                        <strong class="status-text-pending">
                            Work in progress...
                        </strong>
                    </div>
                @endif
            </div>
        </div>

        <div class="info-card">
            <div class="card-header">
                <h3>Actions</h3>
            </div>
            <div class="card-body">
                <div class="agent-actions mt-20">
                    
                    <a href="{{ route('agent.order') }}" class="action-btn secondary">
                        Chat with Customer
                    </a>

                    @if($order->status !== 'completed')
                        <form action="{{ route('agent.order.complete', $order->id) }}" method="POST" class="flex-1">
                            @csrf
                            @method('PATCH')
                            <button type="submit" class="action-btn success w-100" onclick="return confirm('Are you sure you want to mark this order as complete?')">
                                Mark as Complete
                            </button>
                        </form>
                    @else
                        <button class="btn-disabled">
                            Order Completed
                        </button>
                    @endif

                </div>
            </div>
        </div>

    </section>
</x-layouts.agent>