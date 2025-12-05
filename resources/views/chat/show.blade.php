@php
    $layout = auth()->user()->role === 'agent' ? 'layouts.agent' : 'layouts.app';

    $sidebarComponent = auth()->user()->role === 'agent' ? 'x-agent.sidebar' : 'x-user.sidebar';
@endphp

<x-dynamic-component :component="$layout">
    
    <x-slot:sidebar>
        @if(auth()->user()->role === 'agent')
            <x-agent.sidebar />
        @else
            <x-user.sidebar />
        @endif
    </x-slot:sidebar>

    <section class="content">
        <div id="chat-section" class="content-section full-height">
            
            <div class="section-header" style="margin-bottom: 15px;">
                <h1>Chat: Order #{{ $order->id }} - {{ $order->game }}</h1>
                
                @if(auth()->user()->role === 'agent')
                    <a href="{{ route('agent.order.show', $order->id) }}" class="btn-secondary">Back to Order</a>
                @else
                    <a href="{{ route('user.order.show', $order->id) }}" class="btn-secondary">Back to Order</a>
                @endif
            </div>

            <div class="chat-container">
                <div class="chat-box">
                    
                    <div class="chat-messages" id="chatMessages" style="display: flex; flex-direction: column; gap: 15px;">
                        
                        @forelse($order->messages as $message)
                            @php
                                $isMe = $message->user_id === auth()->id();
                            @endphp

                            <div class="message {{ $isMe ? 'sent' : 'received' }}" 
                                 style="
                                    max-width: 70%; 
                                    padding: 10px 15px; 
                                    border-radius: 15px; 
                                    align-self: {{ $isMe ? 'flex-end' : 'flex-start' }};
                                    background: {{ $isMe ? '#667eea' : '#f1f1f1' }};
                                    color: {{ $isMe ? '#fff' : '#333' }};
                                 ">
                                <p style="margin: 0;">{{ $message->message }}</p>
                                <span class="message-data">
                                    {{ $message->created_at->format('h:i A') }}
                                </span>
                            </div>
                        @empty
                            <div class="chat-empty">
                                <svg width="64" height="64" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5">
                                    <path d="M21 15a2 2 0 0 1-2 2H7l-4 4V5a2 2 0 0 1 2-2h14a2 2 0 0 1 2 2z"></path>
                                </svg>
                                <p>No messages yet</p>
                                <span>Start the conversation!</span>
                            </div>
                        @endforelse

                    </div>

                    <div class="chat-input-container">
                        <form action="{{ route(auth()->user()->role . '.chat.store', $order->id) }}" method="POST" style="display: flex; width: 100%; gap: 10px;">
                            @csrf
                            <input type="text" name="message" placeholder="Type a message..." class="chat-input" required autocomplete="off">
                            <button type="submit" class="send-btn">
                                <svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                                    <line x1="22" y1="2" x2="11" y2="13"></line>
                                    <polygon points="22 2 15 22 11 13 2 9 22 2"></polygon>
                                </svg>
                            </button>
                        </form>
                    </div>

                </div>
            </div>
        </div>
    </section>

    <script>
        const messageContainer = document.getElementById('chatMessages');
        if(messageContainer) {
            messageContainer.scrollTop = messageContainer.scrollHeight;
        }
    </script>

</x-dynamic-component>