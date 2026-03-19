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

                        <status-badge status="{{ $order->status }}"></status-badge>
                    </div>

                    <div class="order-details">
                        <detail-row label="Game" value="{{ $order->game }}"></detail-row>
                        <detail-row label="Service" value="{{ $order->service_type }}"></detail-row>
                        <detail-row label="Amount" value="{{ $order->price }}" :is-price="true"></detail-row>
                    </div>

                    <div class="order-actions">
                        <a href="{{ route('user.order.show', $order->id) }}" class="action-btn primary">View</a>

                        <a href="{{ route('user.order.chat', $order->id) }}" class="action-btn secondary">
                            Chat with Agent
                        </a>
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
