<aside class="sidebar">
    <div class="sidebar-menu">
        <a href=" {{ url('/agent') }} " @class(['menu-btn', 'active'=>request()->is('agent')])>
            <svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                <path d="M20 21v-2a4 4 0 0 0-4-4H8a4 4 0 0 0-4 4v2"></path>
                <circle cx="12" cy="7" r="4"></circle>
            </svg>
            My Account
        </a>
        <a href=" {{ url('/agent/order') }} " @class(['menu-btn', 'active'=>request()->is('agent/order')])>
            <svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                <path d="M9 3H5a2 2 0 0 0-2 2v4m6-6h10a2 2 0 0 1 2 2v4M9 3v18m0 0h10a2 2 0 0 0 2-2V9M9 21H5a2 2 0 0 1-2-2V9m0 0h18"></path>
            </svg>
            Orders Handling
        </a>
        <a href=" {{ url('/agent/chat') }} " @class(['menu-btn', 'active'=>request()->is('agent/chat')])>
            <svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                <path d="M21 15a2 2 0 0 1-2 2H7l-4 4V5a2 2 0 0 1 2-2h14a2 2 0 0 1 2 2z"></path>
            </svg>
            Live Chat
        </a>
    </div>
</aside>
