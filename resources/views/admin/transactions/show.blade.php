<x-layouts.admin>
    <section class="content">
        <div class="section-header">
            <h1>Transaction Details</h1>
            <a href="{{ route('admin.transactions') }}" class="action-link">
                ← Back to Transactions
            </a>
        </div>

        <div class="admin-card">
            <div class="card-header">
                <div>
                    <h3>Transaction #{{ $transaction->id }}</h3>
                    <span class="order-date">
                        {{ $transaction->created_at->format('M d, Y \a\t h:i A') }}
                    </span>
                </div>
                @php
                $badgeClass = match($transaction->status) {
                    'verified' => 'completed',
                    'rejected' => 'pending',
                    'pending' => 'in-progress',
                    default => 'pending',
                };
                @endphp
                <span class="badge {{ $badgeClass }}">
                    {{ ucfirst($transaction->status) }}
                </span>
            </div>
        </div>

        <div class="admin-card">
            <div class="card-header">
                <h3>Payment Information</h3>
            </div>
            <div class="card-body">
                <div class="detail-row">
                    <span class="label">Amount:</span>
                    <span class="price">₱{{ number_format($transaction->amount, 2) }}</span>
                </div>
                <div class="detail-row">
                    <span class="label">Payment Method:</span>
                    <strong style="text-transform: uppercase;">{{ $transaction->payment_method }}</strong>
                </div>
                <div class="detail-row">
                    <span class="label">Transaction Reference:</span>
                    <strong>{{ $transaction->transaction_reference ?? 'N/A' }}</strong>
                </div>
                <div class="detail-row">
                    <span class="label">Payment Date:</span>
                    <strong>{{ $transaction->paid_at?->format('M d, Y h:i A') ?? 'N/A' }}</strong>
                </div>
                <div class="detail-row">
                    <span class="label">Related Order:</span>
                    <a href="{{ route('admin.order.show', $transaction->order_id) }}" 
                       style="color: #667eea; text-decoration: underline;">
                        Order #{{ $transaction->order_id }}
                    </a>
                </div>
                <div class="detail-row">
                    <span class="label">Customer:</span>
                    <strong>{{ $transaction->user->name }}</strong>
                </div>
            </div>
        </div>

        @if($transaction->payment_proof)
        <div class="admin-card">
            <div class="card-header">
                <h3>Payment Proof</h3>
            </div>
            <div class="card-body">
                <img src="{{ asset('storage/' . $transaction->payment_proof) }}" 
                     alt="Payment Proof" 
                     style="max-width: 100%; border-radius: 10px; border: 2px solid #e0e0e0;">
                <div style="margin-top: 15px;">
                    <a href="{{ route('admin.transactions.download-proof', $transaction->id) }}" 
                       class="btn-secondary">
                        Download Proof
                    </a>
                </div>
            </div>
        </div>
        @endif

        @if($transaction->status === 'pending')
        <div class="admin-card">
            <div class="card-header">
                <h3>Verify Transaction</h3>
            </div>
            <div class="card-body">
                <form action="{{ route('admin.transactions.verify', $transaction->id) }}" method="POST">
                    @csrf
                    @method('PATCH')

                    <div class="form-group">
                        <label>Decision</label>
                        <select name="status" required class="search-input" style="width: 100%;">
                            <option value="">Select Action</option>
                            <option value="verified">Approve Payment</option>
                            <option value="rejected">Reject Payment</option>
                        </select>
                    </div>

                    <div class="form-group">
                        <label>Admin Notes (Optional)</label>
                        <textarea name="admin_notes" rows="3" class="search-input" 
                                  style="width: 100%; resize: vertical;"
                                  placeholder="Add any notes about this verification..."></textarea>
                    </div>

                    <div class="modal-actions">
                        <button type="submit" class="btn-primary">Submit Verification</button>
                    </div>
                </form>
            </div>
        </div>
        @else
        <div class="admin-card">
            <div class="card-header">
                <h3>Verification Details</h3>
            </div>
            <div class="card-body">
                <div class="detail-row">
                    <span class="label">Verified By:</span>
                    <strong>{{ $transaction->verifiedBy->name ?? 'N/A' }}</strong>
                </div>
                <div class="detail-row">
                    <span class="label">Verified At:</span>
                    <strong>{{ $transaction->verified_at?->format('M d, Y h:i A') ?? 'N/A' }}</strong>
                </div>
                @if($transaction->admin_notes)
                <div class="detail-row">
                    <span class="label">Admin Notes:</span>
                    <p style="margin-top: 5px; color: #666;">{{ $transaction->admin_notes }}</p>
                </div>
                @endif
            </div>
        </div>
        @endif
    </section>
</x-layouts.admin>