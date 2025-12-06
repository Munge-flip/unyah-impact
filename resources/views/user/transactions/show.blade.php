<x-layouts.app>
    <x-slot:sidebar>
        <x-user.sidebar />
    </x-slot:sidebar>

    <section class="content">
        <div class="section-header">
            <h1>Transaction Details</h1>
            <a href="{{ route('user.transactions') }}" class="btn-secondary">
                ← Back to Transactions
            </a>
        </div>

        <div class="info-card">
            <div class="card-header">
                <div>
                    <h3>Transaction #{{ $transaction->id }}</h3>
                    <span class="order-date">
                        {{ $transaction->created_at->format('M d, Y \a\t h:i A') }}
                    </span>
                </div>
                @php
                $statusClass = match($transaction->status) {
                    'verified' => 'completed',
                    'rejected' => 'pending',
                    'pending' => 'in-progress',
                    default => 'pending',
                };
                @endphp
                <span class="status-badge {{ $statusClass }}">
                    {{ ucfirst($transaction->status) }}
                </span>
            </div>
        </div>

        <div class="info-card">
            <h3>Payment Information</h3>
            <div class="detail-row">
                <span class="label">Amount Paid:</span>
                <span class="price">₱{{ number_format($transaction->amount, 2) }}</span>
            </div>
            <div class="detail-row">
                <span class="label">Payment Method:</span>
                <strong style="text-transform: uppercase;">{{ $transaction->payment_method }}</strong>
            </div>
            <div class="detail-row">
                <span class="label">Transaction Reference:</span>
                <strong>{{ $transaction->transaction_reference ?? 'Not provided' }}</strong>
            </div>
            <div class="detail-row">
                <span class="label">Payment Date:</span>
                <strong>{{ $transaction->paid_at?->format('M d, Y h:i A') }}</strong>
            </div>
            <div class="detail-row">
                <span class="label">Related Order:</span>
                <a href="{{ route('user.order.show', $transaction->order_id) }}" 
                   style="color: #667eea; text-decoration: underline;">
                    Order #{{ $transaction->order_id }} - {{ $transaction->order->game }}
                </a>
            </div>
        </div>

        @if($transaction->payment_proof)
        <div class="info-card">
            <h3>Payment Proof</h3>
            <img src="{{ asset('storage/' . $transaction->payment_proof) }}" 
                 alt="Payment Proof" 
                 style="max-width: 100%; border-radius: 10px; border: 2px solid #e0e0e0; margin-top: 15px;">
        </div>
        @endif

        <div class="info-card">
            <h3>Status Information</h3>
            @if($transaction->status === 'pending')
                <p style="color: #f39c12; font-weight: 600;">
                    ⏳ Your payment is pending verification by our admin team.
                </p>
                <p style="color: #666; margin-top: 10px;">
                    We'll notify you once your payment has been verified. This usually takes 1-24 hours.
                </p>
            @elseif($transaction->status === 'verified')
                <p style="color: #27ae60; font-weight: 600;">
                    ✅ Your payment has been verified!
                </p>
                @if($transaction->verified_at)
                <div class="detail-row" style="margin-top: 10px;">
                    <span class="label">Verified At:</span>
                    <strong>{{ $transaction->verified_at->format('M d, Y h:i A') }}</strong>
                </div>
                @endif
            @elseif($transaction->status === 'rejected')
                <p style="color: #e74c3c; font-weight: 600;">
                    ❌ Your payment was not verified.
                </p>
                @if($transaction->admin_notes)
                <div style="margin-top: 10px;">
                    <strong>Reason:</strong>
                    <p style="color: #666; margin-top: 5px;">{{ $transaction->admin_notes }}</p>
                </div>
                @endif
                <p style="color: #666; margin-top: 10px;">
                    Please contact support or submit a new payment with the correct details.
                </p>
            @endif
        </div>
    </section>
</x-layouts.app>