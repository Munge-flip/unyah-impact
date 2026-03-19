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

        <info-card>
            <template #header>
                <div>
                    <h3 style="margin: 0; font-size: 18px; color: #333;">Transaction #{{ $transaction->id }}</h3>
                    <span class="order-date">
                        {{ $transaction->created_at->format('M d, Y \a\t h:i A') }}
                    </span>
                </div>
            </template>
            <template #action>
                <status-badge status="{{ $transaction->status }}"></status-badge>
            </template>
        </info-card>

        <info-card title="Payment Information" :use-body="true">
            <detail-row label="Amount Paid" value="{{ $transaction->amount }}" :is-price="true"></detail-row>
            <detail-row label="Payment Method" value="{{ $transaction->payment_method }}" value-class="text-uppercase"></detail-row>
            <detail-row label="Transaction Reference" value="{{ $transaction->transaction_reference ?? 'Not provided' }}"></detail-row>
            <detail-row label="Payment Date" value="{{ $transaction->paid_at?->format('M d, Y h:i A') }}"></detail-row>
            <detail-row label="Related Order">
                <a href="{{ route('user.order.show', $transaction->order_id) }}" 
                   style="color: #667eea; text-decoration: underline;">
                    Order #{{ $transaction->order_id }} - {{ $transaction->order->game }}
                </a>
            </detail-row>
        </info-card>

        @if($transaction->payment_proof)
        <info-card title="Payment Proof" :use-body="true">
            <img src="{{ asset('storage/' . $transaction->payment_proof) }}" 
                 alt="Payment Proof" 
                 style="max-width: 100%; border-radius: 10px; border: 2px solid #e0e0e0; margin-top: 15px;">
        </info-card>
        @endif

        <info-card title="Status Information" :use-body="true">
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
                <div style="margin-top: 10px;">
                    <detail-row label="Verified At" value="{{ $transaction->verified_at->format('M d, Y h:i A') }}"></detail-row>
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
        </info-card>
    </section>
</x-layouts.app>