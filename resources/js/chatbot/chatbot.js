document.addEventListener("DOMContentLoaded", function () {

  


  // ✅ Prevent double-init (pag na-load app.js twice)
  if (window.__supportChatInited) return;
  window.__supportChatInited = true;

  const chatButton = document.getElementById("chat-button");
  const chatBox = document.getElementById("chatbox");
  const closeChat = document.getElementById("close-chat");
  const clearChat = document.getElementById("clear-chat");

  const ticketBox = document.getElementById("ticketChatBox");
  const ticketInput = document.getElementById("ticketChatInput");
  const ticketSend = document.getElementById("ticketChatSend");
  const ticketHint = document.getElementById("ticketChatHint");
  const typing = document.getElementById("ticketTyping");

  let lastId = 0;
  let poller = null;
  let currentTargetUserId = null;
  let isSending = false;
  // ✅ presence heartbeat every 10s (works kahit chat sarado)
let presenceTimer = null;

// ✅ Chat presence badge
const chatPresenceBadge = document.getElementById("chatPresenceBadge");
let presenceWatchTimer = null;

function setPresenceUI(isOnline){
  if(!chatPresenceBadge) return;

  if(isOnline){
    chatPresenceBadge.textContent = "Online";
    chatPresenceBadge.classList.add("is-online");
    chatPresenceBadge.classList.remove("is-offline");
  }else{
    chatPresenceBadge.textContent = "Offline";
    chatPresenceBadge.classList.add("is-offline");
    chatPresenceBadge.classList.remove("is-online");
  }
}

async function refreshChatPresence(){
  if (!Number.isFinite(currentTargetUserId) || currentTargetUserId <= 0) return;

  const url = new URL("/support/presence/status", window.location.origin);
  url.searchParams.set("user_id", String(currentTargetUserId));

  try{
    const res = await fetch(url.toString(), {
      method: "GET",
      credentials: "same-origin",
      headers: { "Accept": "application/json", "X-Requested-With": "XMLHttpRequest" }
    });
    if(!res.ok) return;

    const data = await res.json();
    const u = (data.users || [])[0];
    if(!u) return;

    setPresenceUI(!!u.online);
  }catch(e){}
}

async function pingPresence(){
  const token = document.querySelector('meta[name="csrf-token"]')?.getAttribute("content") || "";
  try{
    await fetch("/support/presence/ping", {
      method: "POST",
      credentials: "same-origin",
      headers: {
        "Accept": "application/json",
        "X-CSRF-TOKEN": token,
        "X-Requested-With": "XMLHttpRequest",
      },
    });
  }catch(e){}
}

// start heartbeat
pingPresence();
presenceTimer = setInterval(pingPresence, 10000);

// also ping when tab becomes active
document.addEventListener("visibilitychange", () => {
  if (!document.hidden) pingPresence();
});

  // ✅ then saka mo basahin meta
  const metaUid = document.querySelector('meta[name="chat-target-user-id"]')?.getAttribute("content");
  if (metaUid) currentTargetUserId = Number(metaUid);

  function escapeHtml(str){
    return String(str)
      .replaceAll('&','&amp;')
      .replaceAll('<','&lt;')
      .replaceAll('>','&gt;')
      .replaceAll('"','&quot;')
      .replaceAll("'","&#039;");
  }

  function setTyping(show){
    if(!typing) return;
    typing.style.display = show ? "block" : "none";
    if(show) ticketBox.scrollTop = ticketBox.scrollHeight;
  }

  function setInputState(enabled){
    ticketInput.disabled = !enabled;
    ticketSend.disabled = !enabled || ticketInput.value.trim() === "";
  }

  ticketInput?.addEventListener("input", () => {
    if(ticketInput.disabled) return;
    ticketSend.disabled = ticketInput.value.trim() === "";
  });

  function renderMessages(messages){
    if(lastId === 0) ticketBox.innerHTML = "";

    messages.forEach(m => {
      const row = document.createElement("div");
      row.className = "ticket-row " + (m.mine ? "is-mine" : "is-other");

      const bubble = document.createElement("div");
      bubble.className = "ticket-bubble";

      const head = document.createElement("div");
      head.className = "ticket-meta";
      head.innerHTML = `
        <span class="ticket-name">${escapeHtml(m.name ?? 'Unknown')}</span>
        <span class="ticket-role">(${escapeHtml(m.role ?? 'user')})</span>
      `;

      const body = document.createElement("div");
      body.className = "ticket-text";
      body.textContent = m.text ?? "";

      const time = document.createElement("div");
      time.className = "ticket-time";
      time.textContent = m.time ?? "";

      bubble.appendChild(head);
      bubble.appendChild(body);
      bubble.appendChild(time);

      row.appendChild(bubble);
      ticketBox.appendChild(row);

      lastId = Math.max(lastId, Number(m.id || 0));
    });

    ticketBox.scrollTop = ticketBox.scrollHeight;
  }

  async function fetchMessages() {
  try {
    const url = new URL("/support/chat", window.location.origin);
url.searchParams.set("after_id", String(lastId || 0));

// ✅ add target user id (owner ng conversation)
if (Number.isFinite(currentTargetUserId) && currentTargetUserId > 0) {
  url.searchParams.set("target_user_id", String(currentTargetUserId));
}



    const res = await fetch(url.toString(), {
      method: "GET",
      credentials: "same-origin",
      headers: {
        "Accept": "application/json",
        "X-Requested-With": "XMLHttpRequest",
      },
    });

    const ct = res.headers.get("content-type") || "";

    // ❌ not OK (500/404/302/etc)
    if (!res.ok) {
      const body = await res.text();
      console.log("SUPPORT CHAT FETCH ERROR:", res.status);
      console.log("SUPPORT CHAT FETCH BODY:", body);

      // show visible error on first load
      if (lastId === 0) {
        ticketBox.innerHTML = `
          <div class="ticket-empty">
            <div class="ticket-empty-title">Cannot load messages</div>
            <div class="ticket-empty-sub">Status: ${res.status}. Check Network → Response.</div>
          </div>
        `;
      }
      return;
    }

    // ❌ OK status but server returned HTML (usually redirect/login)
    if (!ct.includes("application/json")) {
      const body = await res.text();
      console.log("SUPPORT CHAT NON-JSON RESPONSE:", body);

      if (lastId === 0) {
        ticketBox.innerHTML = `
          <div class="ticket-empty">
            <div class="ticket-empty-title">Chat returned non-JSON</div>
            <div class="ticket-empty-sub">Possible redirect/session issue. Check Network → Response.</div>
          </div>
        `;
      }
      return;
    }

    const data = await res.json();
    console.log("SUPPORT CHAT DATA:", data);

    if (Array.isArray(data.messages) && data.messages.length > 0) {
      renderMessages(data.messages);
      return;
    }

    // ✅ no messages — replace loading on first load
    if (lastId === 0) {
      ticketBox.innerHTML = `
        <div class="ticket-empty">
          <div class="ticket-empty-title">No messages yet</div>
          <div class="ticket-empty-sub">Create a ticket to start the chat.</div>
        </div>
      `;
    }
  } catch (err) {
    console.log("SUPPORT CHAT FETCH EXCEPTION:", err);

    if (lastId === 0) {
      ticketBox.innerHTML = `
        <div class="ticket-empty">
          <div class="ticket-empty-title">Error loading chat</div>
          <div class="ticket-empty-sub">Check Console + Network.</div>
        </div>
      `;
    }
  }
}



  async function sendMessage() {

  // ✅ prevent double send
  if (isSending) return;
  isSending = true;

  const msg = ticketInput.value.trim();
  if (!msg) {
    isSending = false;
    return;
  }

  // ✅ guard target user
  if (!Number.isFinite(currentTargetUserId) || currentTargetUserId <= 0) {
    alert("No target user selected.");
    isSending = false;
    return;
  }

  const token = document
    .querySelector('meta[name="csrf-token"]')
    ?.getAttribute("content") || "";

  // disable button habang sending
  ticketSend.disabled = true;

  try {
    const res = await fetch(`/support/chat`, {
      method: "POST",
      credentials: "same-origin",
      headers: {
        "Accept": "application/json",
        "Content-Type": "application/json",
        "X-CSRF-TOKEN": token,
        "X-Requested-With": "XMLHttpRequest"
      },
      body: JSON.stringify({
        message: msg,
        target_user_id: currentTargetUserId
      })
    });

    const ct = res.headers.get("content-type") || "";
    const raw = await res.text();

    console.log("SEND STATUS:", res.status);
    console.log("SEND RAW:", raw);

    if (!res.ok) {
      alert(`Send failed: ${res.status}. Check Network → Response`);
      return;
    }

    if (ct.includes("application/json")) {
      const data = JSON.parse(raw);
      console.log("SEND JSON:", data);
    } else {
      alert("Send returned NON-JSON. Possible redirect/session issue.");
      return;
    }

    // ✅ clear input
    ticketInput.value = "";

    // ❌ HUWAG NA MAG fetchMessages() DITO
    // Hayaan si poller ang mag refresh
    // await fetchMessages();   ← DELETE THIS

  } catch (err) {
    console.log("SEND EXCEPTION:", err);
    alert("Send exception. Check console.");
  } finally {
    isSending = false;
    ticketSend.disabled = ticketInput.value.trim() === "";
  }
}



  function startSupportChat(){
    lastId = 0;

    // open chatbox
    chatBox.style.display = "flex";
    chatBox.setAttribute("aria-hidden", "false");

    // hint title
    if(ticketHint) ticketHint.textContent = "Support Chat";

    // enable inputs
    setInputState(true);

    // load + poll
    ticketBox.innerHTML = `
  <div class="ticket-loading">
    <div class="ticket-loading-top">
      <div class="ticket-loading-dot"></div>
      <div class="ticket-loading-dot"></div>
      <div class="ticket-loading-dot"></div>
      <div class="ticket-loading-text">Loading messages…</div>
    </div>

    <div class="ticket-skel ticket-skel-left">
      <div class="skel-line w-60"></div>
      <div class="skel-line w-40"></div>
    </div>

    <div class="ticket-skel ticket-skel-right">
      <div class="skel-line w-55"></div>
      <div class="skel-line w-35"></div>
    </div>

    <div class="ticket-skel ticket-skel-left">
      <div class="skel-line w-70"></div>
      <div class="skel-line w-45"></div>
    </div>
  </div>
`;

    fetchMessages();

    if(poller) clearInterval(poller);
    poller = setInterval(fetchMessages, 2000);
  }

  // ✅ call this from user dashboard + admin dashboard
window.startAccountChat = function(targetUserId, label = "Support Chat"){
  currentTargetUserId = Number(targetUserId || 0);

  // ✅ start watching target user's presence
refreshChatPresence();
if(presenceWatchTimer) clearInterval(presenceWatchTimer);
presenceWatchTimer = setInterval(refreshChatPresence, 5000);

  lastId = 0;

  // open chatbox
  chatBox.style.display = "flex";
  chatBox.setAttribute("aria-hidden", "false");

  // hint title
  if(ticketHint) ticketHint.textContent = label;

  // enable inputs
  setInputState(true);

  // load + poll
  ticketBox.innerHTML = `<div class="ticket-empty"><div class="ticket-empty-title">Loading…</div></div>`;
  fetchMessages();

  if(poller) clearInterval(poller);
  poller = setInterval(fetchMessages, 2000);

  // focus input
  ticketInput?.focus();
};


  function stopSupportChat(){
    if(poller) clearInterval(poller);
    poller = null;

    if(presenceWatchTimer) clearInterval(presenceWatchTimer);
presenceWatchTimer = null;
setPresenceUI(false); // optional: reset to Offline


    setInputState(false);
    if(ticketHint) ticketHint.textContent = "Support Chat";

    ticketBox.innerHTML = `
      <div class="ticket-empty">
        <div class="ticket-empty-title">Chat closed</div>
      </div>
    `;
  }

  // OPEN/CLOSE UI
  chatButton?.addEventListener("click", () => {
  const open = chatBox.style.display === "flex";

if(open){
  chatBox.style.display = "none";
  chatBox.setAttribute("aria-hidden", "true");
  stopSupportChat(); // ✅ IMPORTANT
  return;
}


  // ✅ if wala pang target user, default = sarili (for normal user pages)
  if(!currentTargetUserId){
    const metaUid = document.querySelector('meta[name="chat-target-user-id"]')?.getAttribute("content");
    if(metaUid) currentTargetUserId = Number(metaUid);
  }

  // fallback: kung wala pa rin, open but disabled send
  if(!currentTargetUserId){
    chatBox.style.display = "flex";
    chatBox.setAttribute("aria-hidden", "false");
    if(ticketHint) ticketHint.textContent = "No target user selected";
    setInputState(false);
    ticketBox.innerHTML = `
      <div class="ticket-empty">
        <div class="ticket-empty-title">No account selected</div>
        <div class="ticket-empty-sub">Admin: open a ticket first. User: set meta chat-target-user-id.</div>
      </div>
    `;
    return;
  }

  window.startAccountChat(currentTargetUserId, "Support Chat");
});


  closeChat?.addEventListener("click", () => {
    chatBox.style.display = "none";
    chatBox.setAttribute("aria-hidden", "true");
    stopSupportChat();
  });

  // SEND
  ticketSend?.addEventListener("click", sendMessage);
  ticketInput?.addEventListener("keydown", (e) => {
    if(e.key === "Enter"){
      e.preventDefault();
      sendMessage();
    }
  });

  // CLEAR (reload)
  clearChat?.addEventListener("click", async () => {
    ticketBox.innerHTML = `<div class="ticket-empty"><div class="ticket-empty-title">Reloading…</div></div>`;
    lastId = 0;
    await fetchMessages();
  });

});
