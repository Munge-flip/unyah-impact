<x-layouts.agent>
    <section class="content">
        <div id="orders-section" class="content-section">
            <h1>Orders Handling</h1>

            <div class="orders-container">

                @forelse ($orders as $order)
                <div class="order-card">
                    <div class="order-header">
                        <div class="order-id">
                            <strong>Order #{{ $order->id }}</strong>
                            <span class="order-date">{{ $order->created_at->format('M d') }}</span>
                        </div>

                        <status-badge status="{{ $order->status }}"></status-badge>
                    </div>

                    <div class="order-details">
                        <detail-row label="Game" value="{{ $order->game }}"></detail-row>
                        <detail-row label="Service" value="{{ $order->service_type }}"></detail-row>
                        <detail-row label="Customer" value="{{ $order->user->name ?? 'Unknown' }}"></detail-row>
                    </div>

                    <div class="order-actions">
                        <a href="{{ route('agent.order.show', $order->id) }}" class="action-btn primary">View Details</a>

                        @if($order->status !== 'completed')
                        <form action="{{ route('agent.order.complete', $order->id) }}" method="POST" class="flex-1">
                            @csrf
                            @method('PATCH')
                            <button type="submit" class="action-btn success w-100" onclick="return confirm('Complete this order?')">
                                Mark Complete
                            </button>
                        </form>
                        @endif

                        <a href="{{ route('user.order.chat', $order->id) }}" class="action-btn secondary">
                            Chat with User
                        </a>
                    </div>
                </div>
                @empty
                <div class="order-card empty-card">
                    <p>No orders assigned to you yet.</p>
                </div>
                @endforelse

                <div class="pagination-wrapper">
                    {{ $orders->links() }}
                </div>

            </div>
        </div>
    </section>
</x-layouts.agent>