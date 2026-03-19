<x-layouts.admin>
    <section class="content">
        <div id="orders-section" class="content-section">
            <div class="section-header">
                <h1>Orders Management</h1>
                <input type="text" placeholder="Search orders..." class="search-input">
            </div>

            <div class="table-container">
                <table class="data-table">
                    <thead>
                        <tr>
                            <th>Order ID</th>
                            <th>Game</th>
                            <th>Service</th>
                            <th>Customer</th>
                            <th>Agent</th>
                            <th>Payment</th>
                            <th>Status</th>
                            <th>Price</th>
                            <th>Date</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse ($orders as $order)
                        <tr>
                            <td>#{{ $order->id }}</td>
                            <td>{{ $order->game }}</td>
                            <td>{{ $order->service_type }}</td>
                            <td>{{ $order->user->name ?? 'Unknown User' }}</td>

                            <td class="{{ !$order->agent ? 'text-unassigned' : '' }}">
                                {{ $order->agent->name ?? 'Unassigned' }}
                            </td>

                            <td>
                                <status-badge status="{{ $order->payment_status }}" type="payment"></status-badge>
                                <div class="payment-meta">
                                    {{ $order->payment_method }}
                                </div>
                                @if($order->transaction)
                                <a href="{{ route('admin.transactions.show', $order->transaction->id) }}" style="font-size: 11px; color: #667eea; text-decoration: underline; display: block; margin-top: 3px;">
                                    View Transaction
                                </a>
                                @endif
                            </td>

                            <td>
                                <status-badge status="{{ $order->status }}"></status-badge>
                            </td>

                            <td>₱{{ number_format($order->price, 2) }}</td>
                            <td>{{ $order->created_at->format('M d, Y') }}</td>

                            <td>
                                <a href="{{ route('admin.order.show', $order->id) }}" class="action-link">View</a>
                                <form action="{{ route('admin.order.delete', $order->id) }}" method="POST" class="delete-form">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="action-link delete" onclick="return confirm('Are you sure?')">Delete</button>
                                </form>
                            </td>
                        </tr>
                        @empty
                        <tr class="empty-state-row">
                            <td colspan="10">
                                No orders found.
                            </td>
                        </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>

            <div class="pagination-wrapper">
                {{ $orders->links() }}
            </div>
        </div>
    </section>
</x-layouts.admin>
