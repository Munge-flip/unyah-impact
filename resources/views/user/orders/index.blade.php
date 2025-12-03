<x-layouts.app>
    <x-slot:sidebar>
        <x-user.sidebar />
    </x-slot:sidebar>

    <section class="content">
        <div id="orders-section" class="content-section">
            <h1>Order History</h1>

            <div class="orders-container">
                
                @forelse ($orders as $order)
                    <div class="order-card">
                        <div class="order-header">
                            <div class="order-id">
                                <strong>Order #{{ $order->id }}</strong>
                                <span class="order-date">{{ $order->created_at->format('M d') }}</span>
                            </div>
                            
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
                                <span class="label">Amount:</span>
                                <span>₱{{ number_format($order->price, 2) }}</span>
                            </div>
                        </div>

                        <div class="order-actions">
                            <a href="{{ route('user.order.show', $order->id) }}" class="action-btn primary">View</a>
                            
                            <a href="{{ route('user.chat') }}" class="action-btn secondary">Chat with Agent</a>
                        </div>
                    </div>
                @empty
                    <div class="order-card" style="text-align: center; color: #888;">
                        <p>No orders found. <a href="{{ route('public.index') }}" style="color: #667eea;">Book a service now!</a></p>
                    </div>
                @endforelse

                <div style="margin-top: 20px;">
                    {{ $orders->links() }}
                </div>

            </div>
        </div>
    </section>
</x-layouts.app>