<template>
  <div class="chat-container">
    <div class="chat-box">
      <!-- MESSAGES AREA -->
      <div class="chat-messages" id="chatMessages" ref="messageContainer">
        <div v-for="msg in messages" :key="msg.id" 
             :class="['message', msg.user_id === currentUserId ? 'sent' : 'received']"
             :style="getMessageStyle(msg.user_id)"
        >
          <p style="margin: 0;">{{ msg.message }}</p>
          <span class="message-data">{{ msg.created_at_human }}</span>
        </div>

        <!-- Empty State -->
        <div v-if="messages.length === 0 && !loading" class="chat-empty">
          <svg width="64" height="64" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5">
            <path d="M21 15a2 2 0 0 1-2 2H7l-4 4V5a2 2 0 0 1 2-2h14a2 2 0 0 1 2 2z"></path>
          </svg>
          <p>No messages yet</p>
          <span>Start the conversation!</span>
        </div>

        <div v-if="loading" class="text-center p-4">
          <p>Loading chat...</p>
        </div>
      </div>

      <!-- INPUT AREA -->
      <div class="chat-input-container">
        <form @submit.prevent="sendMessage" style="display: flex; width: 100%; gap: 10px;">
          <input 
            type="text" 
            v-model="newMessage" 
            placeholder="Type a message..." 
            class="chat-input" 
            :disabled="sending"
            required 
            autocomplete="off"
          >
          <button type="submit" class="send-btn" :disabled="sending || !newMessage.trim()">
            <svg v-if="!sending" width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
              <line x1="22" y1="2" x2="11" y2="13"></line>
              <polygon points="22 2 15 22 11 13 2 9 22 2"></polygon>
            </svg>
            <span v-else>...</span>
          </button>
        </form>
      </div>
    </div>
  </div>
</template>

<script setup>
import { ref, onMounted, onUnmounted, nextTick } from 'vue';
import axios from 'axios';

const props = defineProps({
  orderId: { type: [Number, String], required: true },
  currentUserId: { type: Number, required: true },
  apiUrl: { type: String, required: true }
});

const messages = ref([]);
const newMessage = ref('');
const loading = ref(true);
const sending = ref(false);
const messageContainer = ref(null);
let pollInterval = null;

async function fetchMessages() {
  try {
    const response = await axios.get(`${props.apiUrl}/messages`);
    if (response.data.success) {
      const oldLength = messages.value.length;
      messages.value = response.data.messages;
      
      // Only scroll to bottom if new messages arrived
      if (messages.value.length > oldLength) {
        await nextTick();
        scrollToBottom();
      }
    }
  } catch (error) {
    console.error('Failed to fetch messages:', error);
  } finally {
    loading.value = false;
  }
}

async function sendMessage() {
  if (!newMessage.value.trim() || sending.value) return;
  
  sending.value = true;
  const text = newMessage.value;
  newMessage.value = ''; // Clear immediately for better UX

  try {
    const response = await axios.post(`${props.apiUrl}/messages`, {
      message: text
    });
    
    if (response.data.success) {
      messages.value.push(response.data.message);
      await nextTick();
      scrollToBottom();
    }
  } catch (error) {
    console.error('Failed to send message:', error);
    alert('Failed to send message. Please try again.');
    newMessage.value = text; // Restore text on failure
  } finally {
    sending.value = false;
  }
}

function scrollToBottom() {
  if (messageContainer.value) {
    messageContainer.value.scrollTop = messageContainer.value.scrollHeight;
  }
}

function getMessageStyle(userId) {
  const isMe = userId === props.currentUserId;
  return {
    maxWidth: '70%', 
    padding: '10px 15px', 
    borderRadius: '15px', 
    alignSelf: isMe ? 'flex-end' : 'flex-start',
    background: isMe ? '#667eea' : '#f1f1f1',
    color: isMe ? '#fff' : '#333'
  };
}

onMounted(() => {
  fetchMessages();
  // Poll for new messages every 3 seconds to make it "Live"
  pollInterval = setInterval(fetchMessages, 3000);
});

onUnmounted(() => {
  if (pollInterval) clearInterval(pollInterval);
});
</script>

<style scoped>
.chat-messages {
  display: flex;
  flex-direction: column;
  gap: 15px;
  overflow-y: auto;
  max-height: 500px;
}
.message-data {
  font-size: 11px; 
  opacity: 0.7; 
  display: block; 
  text-align: right; 
  margin-top: 5px;
}
.send-btn:disabled {
  opacity: 0.5;
  cursor: not-allowed;
}
</style>