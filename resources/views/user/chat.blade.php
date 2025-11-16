<x-layouts.app>

    <section class="content">
            <div id="chat-section">
                <h1>Live Chat</h1>
                
                <div class="chat-container">
                    <div class="chat-box">
                        <div class="chat-messages" id="chatMessages">
                            <div class="chat-empty">
                                <svg width="64" height="64" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5">
                                    <path d="M21 15a2 2 0 0 1-2 2H7l-4 4V5a2 2 0 0 1 2-2h14a2 2 0 0 1 2 2z"></path>
                                </svg>
                                <p>No messages yet</p>
                                <span>Start a conversation with our support team</span>
                            </div>
                        </div>
                        <div class="chat-input-container">
                            <input type="text" id="chatInput" placeholder="Message Live Agent" class="chat-input">
                            <button class="send-btn" id="sendBtn">
                                <svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                                    <line x1="22" y1="2" x2="11" y2="13"></line>
                                    <polygon points="22 2 15 22 11 13 2 9 22 2"></polygon>
                                </svg>
                            </button>
                        </div>
                    </div>
                </div>
            </div>
    </section>

</x-layouts.app>
