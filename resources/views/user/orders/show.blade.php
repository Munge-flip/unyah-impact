<x-layouts.app>

    <x-slot:sidebar>
        <x-user.sidebar />
    </x-slot:sidebar>

    <section class="content">

        <div class="section-header">
            <h1>Order Details</h1>
            <a href="{{ route('user.order') }}" class="btn-secondary" style="text-decoration: none; display: inline-flex; align-items: center; gap: 8px;">
                ← Back to Orders
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
                <span class="status-badge {{ $statusClass }}">
                    {{ ucfirst($order->status) }}
                </span>
            </div>
        </div>

        <div class="info-card">
            <h3>Service Details</h3>

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

            <div class="detail-row" style="align-items: center;">
                <span class="label">Amount Paid:</span>
                <div style="display: flex; align-items: center; gap: 10px;">
                    <span class="price">₱{{ number_format($order->price, 2) }}</span>

                    <span class="badge {{ $order->payment_status === 'paid' ? 'completed' : 'pending' }}" style="background: {{ $order->payment_status === 'paid' ? '#d1e7dd' : '#f8d7da' }}; 
                                 color: {{ $order->payment_status === 'paid' ? '#0f5132' : '#721c24' }}; padding: 5px 10px; font-size: 12px;">
                        {{ ucfirst($order->payment_status) }}
                    </span>

                    @if($order->payment_status === 'unpaid')
                    <button type="button" id="btnPayNow" class="btn-primary" style="padding: 5px 15px; font-size: 12px;">
                        Pay Now
                    </button>
                    @endif
                </div>
            </div>

            <div class="detail-row">
                <span class="label">Payment Method:</span>
                <strong style="text-transform: uppercase;">
                    {{ $order->payment_method ?? 'N/A' }}
                </strong>
            </div>
        </div>

        <div class="info-card">
            <h3>Timeline</h3>
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
                <strong style="color: #888; font-style: italic;">Waiting for completion...</strong>
            </div>
            @endif
        </div>

        <div class="info-card">
            <h3>Assigned Pilot</h3>
            <div class="detail-row">
                <span class="label">Pilot ID:</span>
                @if($order->agent)
                <strong>{{ $order->agent->name }}</strong>
                @else
                <span style="color: #e74c3c; font-style: italic; font-weight: 600;">Finding a pilot...</span>
                @endif
            </div>
        </div>

    </section>

    @if($order->payment_status === 'unpaid')
    <form id="payNowForm" action="{{ route('user.order.pay', $order->id) }}" method="POST" style="display: none;">
        @csrf
        @method('PATCH')
    </form>
    @endif

    <div id="payModal" class="modal" style="display: none;">
        <div class="modal-content" style="text-align: center;">
            <div class="modal-header">
                <h2>Scan to Pay</h2>
                <span class="close-modal" style="cursor: pointer; font-size: 28px;">&times;</span>
            </div>
            <div class="modal-body" style="padding: 30px;">
                <p style="margin-bottom: 20px;">
                    Please scan this QR code to pay
                    <strong>₱{{ number_format($order->price, 2) }}</strong>
                    via <strong>{{ strtoupper($order->payment_method) }}</strong>
                </p>

                <img src="https://api.qrserver.com/v1/create-qr-code/?size=200x200&data=PayOrder{{ $order->id }}" alt="Payment QR" style="border: 5px solid #f0f0f0; border-radius: 10px; margin-bottom: 20px;">

                <div>
                    <button type="button" id="btnConfirmPayment" class="btn-primary" style="width: 100%;">
                        I have completed payment
                    </button>
                </div>
            </div>
        </div>
    </div>

    <script src="{{ asset('js/order-show.js') }}"></script>

</x-layouts.app>
