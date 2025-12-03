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
                                
                                <td style="{{ !$order->agent ? 'color: #e74c3c; font-style: italic;' : '' }}">
                                    {{ $order->agent->name ?? 'Unassigned' }}
                                </td>

                                <td>
                                    @php
                                        $badgeClass = match($order->status) {
                                            'completed' => 'completed',
                                            'in-progress' => 'in-progress',
                                            default => 'pending',
                                        };
                                    @endphp
                                    <span class="badge {{ $badgeClass }}">
                                        {{ ucfirst($order->status) }}
                                    </span>
                                </td>

                                <td>₱{{ number_format($order->price, 2) }}</td>
                                <td>{{ $order->created_at->format('M d, Y') }}</td>
                                
                                <td>
                                    <a href="{{ route('admin.order.show', $order->id) }}" class="action-link">View</a>
                                    
                                    <button class="action-link delete">Delete</button>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="9" style="text-align: center; padding: 30px; color: #888;">
                                    No orders found.
                                </td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>

            <div style="padding: 20px;">
                {{ $orders->links() }}
            </div>
        </div>
    </section>
</x-layouts.admin>