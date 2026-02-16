
<button id="chat-button" class="chat-fab" type="button" aria-label="Open chat">
  <span class="chat-icon" aria-hidden="true">
    <svg xmlns="http://www.w3.org/2000/svg" width="18" height="18" fill="currentColor" viewBox="0 0 16 16">
      <path d="M11.176 14.429c-2.665 0-4.826-1.8-4.826-4.018 0-2.22 2.159-4.02 4.824-4.02S16 8.191 16 10.411c0 1.21-.65 2.301-1.666 3.036a.32.32 0 0 0-.12.366l.218.81a.6.6 0 0 1 .029.117.166.166 0 0 1-.162.162.2.2 0 0 1-.092-.03l-1.057-.61a.5.5 0 0 0-.256-.074.5.5 0 0 0-.142.021 5.7 5.7 0 0 1-1.576.22"/>
      <path d="M0 6.826c0 1.455.781 2.765 2.001 3.656a.385.385 0 0 1 .143.439l-.161.6-.1.373a.5.5 0 0 0-.032.14.19.19 0 0 0 .193.193q.06 0 .111-.029l1.268-.733a.6.6 0 0 1 .308-.088q.088 0 .171.025a6.8 6.8 0 0 0 1.625.26 4.5 4.5 0 0 1-.177-1.251c0-2.936 2.785-5.02 5.824-5.02l.15.002C10.587 3.429 8.392 2 5.796 2 2.596 2 0 4.16 0 6.826"/>
    </svg>
  </span>
  <span class="chat-label">Chat</span>
</button>

<section id="chatbox" class="ticket-chatbox" aria-hidden="true" aria-label="Support chat">
  <header class="chat-header">
    <div class="chat-header-left">
  <div class="chat-title-row">
    <div class="chat-title">Support Chat</div>
    <span id="chatPresenceBadge" class="presence-badge is-offline">Offline</span>
  </div>

  <div id="ticketChatHint" class="chat-subtitle">Support Chat</div>
  
</div>


    <div class="chat-header-actions">
      <button id="close-chat" class="chat-btn ghost" type="button" aria-label="Close chat">✕</button>
    </div>
  </header>

  <div id="ticketChatBox" class="ticket-messages">
    <div class="ticket-empty">
      <div class="ticket-empty-title">No messages yet</div>
      <div class="ticket-empty-sub">Type a message to start.</div>
    </div>
  </div>

  <footer class="ticket-inputbar">
    <input id="ticketChatInput" class="ticket-input" placeholder="Type your message..." disabled />
    <button id="ticketChatSend" class="ticket-send" type="button" disabled>Send</button>
  </footer>
</section>
