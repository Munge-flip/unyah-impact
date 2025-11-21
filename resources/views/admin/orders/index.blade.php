<x-layouts.admin>
    <section class="content">
        <div id="orders-section" class="content-section">
            <div class="section-header">
                <h1>All Orders</h1>
                <input type="text" placeholder="Search orders..." class="search-input">
            </div>

            <div class="table-container">
                <table class="data-table">
                    <thead>
                        <tr>
                            <th>Order ID</th>
                            <th>Game</th>
                            <th>Service</th>
                            <th>User</th>
                            <th>Agent</th>
                            <th>Status</th>
                            <th>Date</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td>#1234</td>
                            <td>Genshin Impact</td>
                            <td>Exploration</td>
                            <td>U***nh</td>
                            <td>DarkBeam</td>
                            <td><span class="badge in-progress">In Progress</span></td>
                            <td>Oct 5</td>
                            <td>
                                <a href="{{ route('admin.order.show', ['id' => 1234]) }}" class="action-link">View</a>
                                <button class="action-link delete">Delete</button>
                            </td>
                        </tr>
                        <tr>
                            <td>#1233</td>
                            <td>Honkai Star Rail</td>
                            <td>Memory of Chaos</td>
                            <td>U***nh</td>
                            <td>DarkBeam</td>
                            <td><span class="badge in-progress">In Progress</span></td>
                            <td>Oct 4</td>
                            <td>
                                <a href="{{ route('admin.order.show', ['id' => 1232]) }}" class="action-link">View</a>
                                <button class="action-link delete">Delete</button>
                            </td>
                        </tr>
                        <tr>
                            <td>#1232</td>
                            <td>Zenless Zone Zero</td>
                            <td>Events</td>
                            <td>R***23</td>
                            <td>Unassigned</td>
                            <td><span class="badge pending">Pending</span></td>
                            <td>Oct 3</td>
                            <td>
                                <a href="{{ route('admin.order.show', ['id' => 1232]) }}" class="action-link">View</a>
                                <button class="action-link delete">Delete</button>
                            </td>
                        </tr>
                        <tr>
                            <td>#1021</td>
                            <td>Honkai Star Rail</td>
                            <td>Memory of Chaos</td>
                            <td>J***xx</td>
                            <td>Jinxx</td>
                            <td><span class="badge completed">Completed</span></td>
                            <td>Oct 1</td>
                            <td>
                                <a href="{{ route('admin.order.show', ['id' => 1021]) }}" class="action-link">View</a>
                                <button class="action-link delete">Delete</button>
                            </td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>
    </section>
</x-layouts.admin>
