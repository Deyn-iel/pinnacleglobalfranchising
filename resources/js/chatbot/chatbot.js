

document.addEventListener("DOMContentLoaded", function () {

  const dept = document.querySelector('meta[name="chat-department"]')?.getAttribute("content");


  // ✅ Prevent double-init (pag na-load app.js twice)
  if (window.__supportChatInited) return;
  window.__supportChatInited = true;

const chatButton = document.getElementById("chat-button");

// ✅ only run if exists (user side)
if (chatButton) {

  chatButton.addEventListener("click", () => {

    const open = chatBox.classList.contains("open");

    if(open){
      chatBox.style.display = "none";
      chatBox.classList.remove("open");
      chatBox.setAttribute("aria-hidden", "true");
      stopSupportChat();
      return;
    }

    unreadCount = 0;
    updateBadge();

    chatBox.style.display = "flex";
    chatBox.classList.add("open");
    chatBox.setAttribute("aria-hidden", "false");

    if(!currentTargetUserId){
      const metaUid = document.querySelector('meta[name="chat-target-user-id"]')?.getAttribute("content");
      if(metaUid) currentTargetUserId = Number(metaUid);
    }

    if(!currentTargetUserId){
      setInputState(false);
      return;
    }

    window.startAccountChat(currentTargetUserId, "Support Chat");
  });

}
  const chatBadge = document.getElementById("chatBadge");
let unreadCount = 0;

  function updateBadge(){
    console.log("UNREAD:", unreadCount);
  if(!chatBadge) return;

  if(unreadCount > 0){
    chatBadge.style.display = "inline-block";
    chatBadge.textContent = unreadCount > 9 ? "9+" : unreadCount;
  }else{
    chatBadge.style.display = "none";
  }
}
  const chatBox = document.getElementById("chatbox");
  const closeChat = document.getElementById("close-chat");
  const deleteChat = document.getElementById("delete-chat");
  const clearChat = document.getElementById("clear-chat");

  const ticketBox = document.getElementById("ticketChatBox");
  const ticketInput = document.getElementById("ticketChatInput");
  const ticketSend = document.getElementById("ticketChatSend");
  const ticketHint = document.getElementById("ticketChatHint");
  const typing = document.getElementById("ticketTyping");
  const uploadStatus = document.getElementById("uploadStatus");
  let selectedFile = null;

const previewContainer = document.getElementById("filePreviewContainer");
const fileInput = document.getElementById("fileInput");

// ✅ safe check (important)
if (fileInput && previewContainer) {




fileInput.addEventListener("change", function () {
    const file = this.files[0];
    if (!file) return;

    const maxSize = 10 * 1024 * 1024;

    // ✅ 1. SIZE CHECK
    if (file.size > maxSize) {
        alert("Max 10MB only!");
        this.value = "";
        selectedFile = null;

        ticketSend.disabled = ticketInput.value.trim() === "";
        return;
    }

    // ✅ 2. VIDEO BLOCK (IMPORTANT: BEFORE SETTING FILE)
    if (file.type.startsWith("video/")) {
        alert("Video is not allowed!");
        this.value = "";
        selectedFile = null;

        // 🔥 FIX: ibalik sa tamang state
        ticketSend.disabled = ticketInput.value.trim() === "";
        return;
    }

    // ✅ 3. VALID FILE NA → saka lang i-set
    selectedFile = file;

    previewContainer.innerHTML = "";
    const div = document.createElement("div");
    div.className = "file-preview";

    if (file.type.startsWith("image/")) {
        const img = document.createElement("img");
        img.src = URL.createObjectURL(file);
        div.appendChild(img);
    } else {
        div.textContent = file.name;
    }

    // REMOVE BUTTON
    const remove = document.createElement("div");
    remove.className = "file-remove";
    remove.textContent = "✕";

    remove.onclick = () => {
        selectedFile = null;
        previewContainer.innerHTML = "";
        fileInput.value = "";

        ticketSend.disabled = ticketInput.value.trim() === "";
    };

    div.appendChild(remove);
    previewContainer.appendChild(div);

    // ✅ 4. FINAL BUTTON STATE
    ticketSend.disabled = ticketInput.value.trim() === "" && !selectedFile;
});

}

  
  let lastId = 0;
  let lastRenderedMsg = null;
  let lastRenderedRow = null;

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

async function deleteConversation(){
  // guard target user
  if (!Number.isFinite(currentTargetUserId) || currentTargetUserId <= 0) {
    alert("No target user selected.");
    return;
  }

  const ok = confirm("Delete this conversation? This cannot be undone.");
  if(!ok) return;

  const token = document.querySelector('meta[name="csrf-token"]')?.getAttribute("content") || "";
  
  try{
    const res = await fetch("/support/chat", {
  method: "POST", // ✅ keep POST, spoof DELETE for Laravel
  credentials: "same-origin",
  headers: {
    "Accept": "application/json",
    "Content-Type": "application/json",
    "X-CSRF-TOKEN": token,
    "X-Requested-With": "XMLHttpRequest"
  },
  body: JSON.stringify({
    _method: "DELETE",
    target_user_id: currentTargetUserId
  })
});

    const ct = res.headers.get("content-type") || "";
    const raw = await res.text();

    if(!res.ok){
  console.log("DELETE STATUS:", res.status);
  console.log("DELETE CT:", ct);
  console.log("DELETE RAW:", raw.slice(0, 3000)); // preview
  alert(`Delete failed: ${res.status}. Check console + Network.`);
  return;
}

if(!ct.includes("application/json")){
  console.log("DELETE NON-JSON RAW:", raw.slice(0, 3000));
  alert("Delete returned non-JSON (possible redirect/CSRF). Check Network.");
  return;
}

    // ✅ reset UI after delete
    lastId = 0;
    lastRenderedMsg = null;
    lastRenderedRow = null;

    ticketBox.innerHTML = `
      <div class="ticket-empty">
        <div class="ticket-empty-title">Conversation deleted</div>
        <div class="ticket-empty-sub">Start a new chat by sending a message.</div>
      </div>
    `;

  }catch(err){
    console.log("DELETE EXCEPTION:", err);
    alert("Delete exception. Check console.");
  }
}

deleteChat?.addEventListener("click", deleteConversation);

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
    ticketSend.disabled = !enabled || (ticketInput.value.trim() === "" && !selectedFile);
  }

  ticketInput?.addEventListener("input", () => {
    if(ticketInput.disabled) return;
    ticketSend.disabled = ticketInput.value.trim() === "" && !selectedFile;
  });

  function getInitial(name){
  const s = String(name || "").trim();
  return s ? s.charAt(0).toUpperCase() : "?";
}

function setHeaderPeer(name){
  const peerNameEl = document.getElementById("chatPeerName");
  const peerAvatarEl = document.getElementById("chatPeerAvatar");

  const safeName = (name && String(name).trim()) ? String(name).trim() : "Support";
  if(peerNameEl) peerNameEl.textContent = safeName;
  if(peerAvatarEl) peerAvatarEl.textContent = getInitial(safeName);
}

function sameSender(a, b){
  if(!a || !b) return false;

  // mine group
  if(!!a.mine && !!b.mine) return true;

  // other group: same "name" (pwede mo palitan to user_id if meron kayo)
  if(!a.mine && !b.mine){
    return String(a.name || "").trim().toLowerCase() === String(b.name || "").trim().toLowerCase();
  }

  return false;
}

function downgradePrevAvatarToGhost(){
  if(!lastRenderedRow) return;
  const a = lastRenderedRow.querySelector(".msg-avatar");
  if(a){
    a.className = "msg-avatar-ghost";
    a.textContent = "";
  }
}

function renderMessages(messages){
  if(lastId === 0) ticketBox.innerHTML = "";

  for(let i = 0; i < messages.length; i++){
    if (Number(messages[i].id) <= lastId) continue;
    
    const m = messages[i];
    const next = messages[i + 1];

    // header name
    if(!m.mine && (m.name || m.role)){
      setHeaderPeer(m.name || "Support");
    }

    // ✅ IMPORTANT FIX:
    // if previous message exists and same sender (OTHER), previous should lose avatar
    if(lastRenderedMsg && sameSender(lastRenderedMsg, m) && !lastRenderedMsg.mine){
      downgradePrevAvatarToGhost();
    }

    const row = document.createElement("div");
    row.className = "ticket-row " + (m.mine ? "is-mine" : "is-other");

    // show avatar only if last in group (based on next in THIS batch)
    const isLastInGroup = !next || !sameSender(m, next);

    if(!m.mine){
      if(isLastInGroup){
        const avatar = document.createElement("div");
        avatar.className = "msg-avatar";
        avatar.textContent = getInitial(m.name || "Support");
        row.appendChild(avatar);
      }else{
        const ghost = document.createElement("div");
        ghost.className = "msg-avatar-ghost";
        row.appendChild(ghost);
      }
    }

    const bubbleWrap = document.createElement("div");
    bubbleWrap.className = "msg-wrap";

    const bubble = document.createElement("div");
    bubble.className = "ticket-bubble";

    const body = document.createElement("div");
    body.className = "ticket-text";
    body.innerHTML = "";

const text = m.text || "";

// ✅ check if may extension
const hasExtension = text.includes('.') && text.split('.').pop().length <= 5;

const fileUrl = hasExtension ? "/storage/" + text : null;
const fileName = hasExtension ? text.split('/').pop() : "";
const ext = hasExtension ? fileName.split('.').pop().toLowerCase() : "";

// 🔥 IMAGE
if (hasExtension && (m.type === "image" || ["jpg","jpeg","png","gif","webp"].includes(ext))) {

    const img = document.createElement("img");
    img.src = fileUrl;
    img.style.maxWidth = "200px";
    img.style.borderRadius = "10px";
    img.style.cursor = "pointer";
    img.onclick = () => window.open(fileUrl, "_blank");

    body.appendChild(img);

// 🔥 VIDEO
} else if (hasExtension && ["mp4","webm"].includes(ext)) {

    const link = document.createElement("a");
    link.href = fileUrl;
    link.target = "_blank";
    link.className = "file-bubble";

    link.innerHTML = `
        <div class="file-icon">🎬</div>
        <div class="file-info">
            <div class="file-name">${fileName}</div>
            <div class="file-action">Open video</div>
        </div>
    `;

    body.appendChild(link);

// 🔥 FILES
} else if (hasExtension) {

    let icon = "📄";
    if(ext === "docx") icon = '<i class="fas fa-file-word text-primary"></i>';
    else if(ext === "xlsx") icon = '<i class="fas fa-file-excel text-success"></i>';
    else if(ext === "pdf") icon = '<i class="fas fa-file-pdf text-danger"></i>';

    const link = document.createElement("a");
    link.href = fileUrl;
    link.target = "_blank";
    link.className = "file-bubble";

    link.innerHTML = `
        <div class="file-icon">${icon}</div>
        <div class="file-info">
            <div class="file-name">${fileName}</div>
            <div class="file-action">Click to open</div>
        </div>
    `;

    body.appendChild(link);

// 🔥 NORMAL TEXT (FIX NA FIX)
} else {

    body.textContent = text;
}

    const time = document.createElement("div");
    time.className = "msg-time";
    time.textContent = m.time ?? "";

    bubble.appendChild(body);
    bubbleWrap.appendChild(bubble);
    bubbleWrap.appendChild(time);

    row.appendChild(bubbleWrap);
    ticketBox.appendChild(row);

    // update trackers
    lastRenderedMsg = m;
    lastRenderedRow = row;

    lastId = Math.max(lastId, Number(m.id || 0));
  }

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

// 🔥 ADD THIS (IMPORTANT)
if (chatBox.classList.contains("open") && currentTargetUserId) {
  url.searchParams.set("mark_as_read", "1");
}

// ✅ kapag open chat → auto clear badge
if (chatBox.classList.contains("open")) {
  unreadCount = 0;
  updateBadge();
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

  const newMessages = data.messages.filter(m => Number(m.id) > lastId);

  if (newMessages.length > 0) {

  const isChatOpen = chatBox.classList.contains("open");

if (!isChatOpen) {

  // ❌ wag na mag manual add (nagkaka-duplicate)
  // unreadCount += newFromOthers.length;

  // ✅ always sync from server (REAL COUNT)
  fetch("/support/unread-count")
    .then(res => res.json())
    .then(data => {
      unreadCount = data.count;
      updateBadge();
    });

}

  renderMessages(newMessages);

  
}

  return; 
}

    // ✅ no messages — replace loading on first load
    if (lastId === 0) {
      ticketBox.innerHTML = `
        <div class="ticket-empty">
          <div class="ticket-empty-title">No messages yet</div>
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

  if (isSending) return;
isSending = true;

// ✅ UI: show sending state
ticketSend.disabled = true;
ticketSend.classList.add("sending");
ticketSend.dataset.original = ticketSend.innerHTML;
ticketSend.innerHTML = '<i class="fa-solid fa-spinner fa-spin"></i>';

  const msg = ticketInput.value.trim();

  if (!msg && !selectedFile) {
    isSending = false;
    return;
  }

  const token = document.querySelector('meta[name="csrf-token"]')?.getAttribute("content") || "";

  try {

    // ✅ IF MAY FILE → UPLOAD FIRST
    if (selectedFile) {

    // ✅ SHOW LOADING
    if(uploadStatus) uploadStatus.style.display = "block";

    ticketSend.disabled = true;

    const formData = new FormData();
formData.append("file", selectedFile);
formData.append("target_user_id", currentTargetUserId);
formData.append("department", dept); // ✅ ADD THIS

    try{
        const res = await fetch("/support/chat/upload", {
    method: "POST",
    credentials: "same-origin", // ✅ IMPORTANT
    headers: {
        "X-CSRF-TOKEN": token,
        "X-Requested-With": "XMLHttpRequest"
    },
    body: formData
});

const text = await res.text();
console.log("UPLOAD RESPONSE:", text);

if (!res.ok) {
    alert("Upload failed — check console");
}

    } catch(e){
        alert("Upload failed");
    }

    // ✅ RESET FILE
    selectedFile = null;
    previewContainer.innerHTML = "";
    document.getElementById("fileInput").value = "";

    // ✅ HIDE LOADING
    if(uploadStatus) uploadStatus.style.display = "none";
}

    // ✅ TEXT MESSAGE
    if (msg) {
        await fetch(`/support/chat`, {
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
    target_user_id: currentTargetUserId,
    department: dept
})
        });

        ticketInput.value = "";
    }

  } catch (err) {
    console.log(err);
  } finally {
  isSending = false;

  // ✅ restore button
  ticketSend.classList.remove("sending");
ticketSend.innerHTML = ticketSend.dataset.original || '<i class="fa-solid fa-paper-plane"></i>';

  ticketSend.disabled = ticketInput.value.trim() === "" && !selectedFile;
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
setHeaderPeer(label);

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
// chatButton?.addEventListener("click", () => {

//   const open = chatBox.classList.contains("open");

//   if(open){
//     chatBox.style.display = "none";
//     chatBox.classList.remove("open"); 
//     chatBox.setAttribute("aria-hidden", "true");
//     stopSupportChat();
//     return;
//   }

//   // 🔥 RESET BADGE PAG BINUKSAN
//   unreadCount = 0;
//   updateBadge();

//   chatBox.style.display = "flex";
//   chatBox.classList.add("open"); 
//   chatBox.setAttribute("aria-hidden", "false");

//   if(!currentTargetUserId){
//     const metaUid = document.querySelector('meta[name="chat-target-user-id"]')?.getAttribute("content");
//     if(metaUid) currentTargetUserId = Number(metaUid);
//   }

//   if(!currentTargetUserId){
//     if(ticketHint) ticketHint.textContent = "No target user selected";
//     setInputState(false);
//     return;
//   }

//   window.startAccountChat(currentTargetUserId, "Support Chat");
// });


  closeChat?.addEventListener("click", () => {
  chatBox.style.display = "none";
  chatBox.classList.remove("open"); // ✅ ADD THIS
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

  // 🔥 GLOBAL UNREAD POLLER (WORKS KAHIT SARADO CHAT)
setInterval(() => {

  // wag mag fetch kung open (kasi fetchMessages na bahala)
  if (chatBox.classList.contains("open")) return;

  fetch("/support/unread-count")
    .then(res => res.json())
    .then(data => {
      unreadCount = data.count;
      updateBadge();
    })
    .catch(() => {});

}, 1000);

});
