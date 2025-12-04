<x-layouts.agent>
    <section class="content">
        <div id="orders-section" class="content-section">
            <h1>Orders Handling</h1>

            <div class="orders-container">

                {{-- LOOP START --}}
                @forelse ($orders as $order)
                <div class="order-card">
                    <div class="order-header">
                        <div class="order-id">
                            <strong>Order #{{ $order->id }}</strong>
                            <span class="order-date">{{ $order->created_at->format('M d') }}</span>
                        </div>

                        {{-- Status Badge --}}
                        @php
                        $statusClass = match($order->status) {
                        'completed' => 'completed',
                        'in-progress' => 'in-progress',
                        default => 'pending',
                        };
                        @endphp
                        <span class="status-badge {{ $statusClass }}">
                            {{ ucfirst($order->status) }}
                        </span>
                    </div>

                    <div class="order-details">
                        <div class="detail-row">
                            <span class="label">Game:</span>
                            <span>{{ $order->game }}</span>
                        </div>
                        <div class="detail-row">
                            <span class="label">Service:</span>
                            <span>{{ $order->service_type }}</span>
                        </div>
                        <div class="detail-row">
                            <span class="label">Customer:</span>
                            {{-- Show Customer Name --}}
                            <span>{{ $order->user->name ?? 'Unknown' }}</span>
                        </div>
                    </div>

                    <div class="order-actions">
                        {{-- View Details --}}
                        <a href="{{ route('agent.order.show', $order->id) }}" class="action-btn primary">View Details</a>

                        {{-- Mark Complete (Only if not completed) --}}
                        @if($order->status !== 'completed')
                        <form action="{{ route('agent.order.complete', $order->id) }}" method="POST">
                            @csrf
                            @method('PATCH')
                            <button type="submit" class="action-btn success mark-complete-btn" onclick="return confirm('Complete this order?')">
                                Mark Complete
                            </button>
                        </form>
                        @endif

                        {{-- Chat --}}
                        <a href="{{ route('user.order.chat', $order->id) }}" class="action-btn secondary">
                            Chat with User
                        </a>
                    </div>
                </div>
                @empty
                <div class="order-card" style="text-align: center; padding: 30px; color: #888;">
                    <p>No orders assigned to you yet.</p>
                </div>
                @endforelse

                {{-- Pagination --}}
                <div style="padding: 20px;">
                    {{ $orders->links() }}
                </div>

            </div>
        </div>
    </section>
</x-layouts.agent>
