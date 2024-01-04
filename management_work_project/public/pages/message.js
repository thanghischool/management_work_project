window.workspace_ID = document.querySelector('meta[name="workspace_ID"]').getAttribute('content');
function scrollEnd(chatboxSelector){
    const chatBox = document.querySelector(chatboxSelector);
    chatBox.scrollTop = chatBox.scrollHeight;
}
function displayTimeWhenHovering(messageSelector){
    const messageTime = document.createElement('div');
    Object.assign(messageTime, {
        className: 'message-time',
    });
    const messages = Array.from(document.querySelectorAll(messageSelector));
    messages.forEach(function(message){
        message.onmouseenter = (event) => {
            messageTime.innerHTML = event.target.getAttribute('message-time');
            event.target.appendChild(messageTime);
        };
        message.onmouseleave = (event) => {
            messageTime.parentElement.removeChild(messageTime);
        };
    });
}
function getHoursandMinutes(datetime){
    const date = new Date(datetime);
    let hours = date.getHours();
    let minutes = date.getMinutes();
    return `${hours}:${minutes}`;
}
function renderNewMessage(type, user, message){
    const chatBox = document.querySelector('.chatbox-body');
    if(chatBox.firstElementChild == null){
        let date = new Date(Date.now());
        const dateElement = document.createElement('div');
        dateElement.className = "date";
        dateElement.innerHTML = `${date.getDate()}/${date.getMonth() + 1}/${date.getFullYear()}`;
        chatBox.append(dateElement);
    }
    let content;
    if(type === "friend"){
        if (chatBox.lastElementChild.getAttribute("user_ID") == message.user_ID){
            const messageContainer = chatBox.lastElementChild.querySelector('.message-content');
            content = document.createElement('p');
            content.innerHTML = message.content;
            content.setAttribute('message-time', getHoursandMinutes(message.created_at));
            messageContainer.appendChild(content);
        } else {
            content = document.createElement('div');
            content.className = "friend-message message";
            content.setAttribute("user_ID", message.user_ID);
            content.innerHTML = `
            <img src="${user.avatar}" alt="" class="mini-avatar">
            <div class="message-content">
                <span class="friend-name">${user.name}</span>
                <p message-time="${getHoursandMinutes(message.created_at)}">${message.content}</p>
            </div>`;
            chatBox.appendChild(content);
        }
    } else {
        if (chatBox?.lastElementChild.classList.contains("your-message")){
            const messageContainer = chatBox.lastElementChild.querySelector('.message-content');
            content = document.createElement('p');
            content.innerHTML = message.content;
            content.setAttribute('message-time', getHoursandMinutes(message.created_at));
            messageContainer.appendChild(content);
        } else {
            content = document.createElement('div');
            content.className = "your-message message";
            content.innerHTML = `
            <div class="message-content">
                <p message-time="${getHoursandMinutes(message.created_at)}">${message.content}</p>
            </div>`;
            chatBox.appendChild(content);
        }
    }
    const messageTime = document.createElement('div');
    Object.assign(messageTime, {
        className: 'message-time',
    });
    content.onmouseenter = (event) => {
        messageTime.innerHTML = event.target.getAttribute('message-time');
        event.target.appendChild(messageTime);
    };
    content.onmouseleave = (event) => {
        messageTime.parentElement.removeChild(messageTime);
    };
}
// console.log(new Date("2023-12-31 00:00:00"));
function loadNewOldMessages(message){
    // nếu date element tồn tại ở đầu thì ta so sánh date message đó có bằng date của date element không
     // nếu có thì ta chèn vào sau cái date element kia
        // trường hợp mesage.user_ID == cái user_ID của message element sau đó thì ta insertBefore cái thẻ p đầu tiên
        // trường hợp ngược lại thì ta chèn trước cái message element đó 1 component message mới
     // nếu không bằng thì ta chèn vào trước cái date element đó 1 message và một date element mới (1 component mới)
    function checkIsNewDate(date1, date2){
        if((date1 && date2) && (date2.valueOf() >= date1.valueOf() + 24*3600*1000 || date2.valueOf() <= date1.valueOf() - 24*3600*1000)){
            return true;
        }
        return false;
    }
    const chatBox = document.querySelector('.chatbox-body');
    let dateElement;
    dateElement = chatBox.firstElementChild;
    let date = dateElement?.innerHTML.split('/');
    let date1;
    let date2;
    if(date){
        date1 = new Date(date[2], parseInt(date[1])-1, date[0], 0, 0 ,0);
        date2 = new Date(message.created_at.slice(0,10) + " 00:00:00");
    }
    const messageElement = dateElement?.nextElementSibling;
    if(!checkIsNewDate(date1, date2) && dateElement && messageElement){
        try{
            if(messageElement.getAttribute("user_ID") == null && window.user_ID == message.user_ID){
                const messageContainer = messageElement.querySelector('.message-content');
                const content = document.createElement('p');
                content.innerHTML = message.content;
                content.setAttribute('message-time', getHoursandMinutes(message.created_at));
                messageContainer.insertBefore(content, messageContainer.firstElementChild);
            }
            else if(messageElement.getAttribute("user_ID") != null && window.user_ID == message.user_ID){
                const content = document.createElement('div');
                content.className = "your-message message";
                content.innerHTML = `
                <div class="message-content">
                    <p message-time="${getHoursandMinutes(message.created_at)}">${message.content}</p>
                </div>`;
                chatBox.insertBefore(content, chatBox.firstElementChild.nextElementSibling);
            } else
            if(messageElement.getAttribute("user_ID") == message.user_ID){
                const messageContainer = messageElement.querySelector('.message-content');
                const content = document.createElement('p');
                content.innerHTML = message.content;
                content.setAttribute('message-time', getHoursandMinutes(message.created_at));
                messageContainer.insertBefore(content, messageContainer.firstElementChild.nextElementSibling);
            } else {
                const content = document.createElement('div');
                content.className = "friend-message message";
                content.setAttribute("user_ID", message.user_ID);
                content.innerHTML = `
                <img src="${message.avatar}" alt="" class="mini-avatar">
                <div class="message-content">
                    <span class="friend-name">${message.username}</span>
                    <p message-time="${getHoursandMinutes(message.created_at)}">${message.content}</p>
                </div>`;
                chatBox.insertBefore(content, chatBox.firstElementChild.nextElementSibling);
            }
        } catch(e) {
            console.log(e);
        }
    } else {
        let date = new Date(message.created_at.slice(0,10));
        const dateElement = document.createElement('div');
        dateElement.className = "date";
        dateElement.innerHTML = `${date.getDate()}/${date.getMonth() + 1}/${date.getFullYear()}`;
        chatBox.insertBefore(dateElement, chatBox.firstElementChild);
        if(message.user_ID == window.user_ID){
            const content = document.createElement('div');
            content.className = "your-message message";
            content.innerHTML = `
            <div class="message-content">
                <p message-time="${getHoursandMinutes(message.created_at)}">${message.content}</p>
            </div>`;
            chatBox.insertBefore(content, chatBox.firstElementChild.nextElementSibling);
        } else {
            const content = document.createElement('div');
            content.className = "friend-message message";
            content.setAttribute("user_ID", message.user_ID);
            content.innerHTML = `
            <img src="${message.avatar}" alt="" class="mini-avatar">
            <div class="message-content">
                <span class="friend-name">${message.username}</span>
                <p message-time="${getHoursandMinutes(message.created_at)}">${message.content}</p>
            </div>`;
            chatBox.insertBefore(content, chatBox.firstElementChild.nextElementSibling);
        }
    }
}

let url;
let flag;
function initChatbox(){
    url = "http://127.0.0.1:8000/api/workspace/1/chatbox";
    flag = true;
    let target = document.querySelector(".chatbox-body");
    const result = getOldMessageFetch(url);
    result.then((response) => {
        if (response.data) {
            let messages = response.data;
            messages.forEach(function(message){
                loadNewOldMessages(message);
            });
            scrollEnd(".chatbox-body");
            displayTimeWhenHovering(".message-content p");
        }
        if(response.next_cursor != null){
            url = response.next_page_url;
        } else flag = false;
    });
}
initChatbox();
document.querySelector('.chatbox-body').addEventListener("scroll", (e) => {
    if(e.target.scrollTop == 0 && flag){
        let dateElementHeight = e.target.firstElementChild.offsetHeight;
        let oldPositionElement = e.target.firstElementChild.nextElementSibling.querySelector('p');
        const result = getOldMessageFetch(url);
        result.then((response) => {
            if (response.data) {
                let messages = response.data;
                messages.forEach(function(message){
                    loadNewOldMessages(message);
                });
                scrollEnd(".chatbox-body");
                displayTimeWhenHovering(".message-content p");
            }
            setTimeout( () => {e.target.scrollTop = oldPositionElement.offsetTop - dateElementHeight*2-30}, 0);
            if(response.next_cursor != null){
                url = response.next_page_url;
            } else flag = false;
        });
        
    }
});
function applyEventSendMessage(){
    const input = document.getElementById('message');
    const button = document.getElementById('submit-message');
    button.addEventListener('click',(e) => {
        if(input.value != ""){
            sendMessage(input.value);
            input.value = "";
        } else {
            input.focus();
        }
    });
    input.addEventListener('keypress', function (e) {
        if (e.key === 'Enter' && input.value != "") {
            sendMessage(input.value);
            input.value = "";
        }
    });
}
applyEventSendMessage();
window.Echo.private(`workspace.${window.workspace_ID}`)
.listen('MessageCreated', (e) => {
    console.log(e);
    const user = e.user;
    const message = e.message;
    if(user.id == window.user_ID) renderNewMessage("Me", user, message);
    else renderNewMessage("friend", user, message)
    scrollEnd(".chatbox-body");
});
async function sendMessage(content){
    const response = await fetch("http://127.0.0.1:8000/api/messages",{
        method: "POST", // or 'PUT'
        headers: {
            'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content'),
            'Accept':'application/json',
            'Content-Type':'application/json',
        },
        body: JSON.stringify({
            workspace_ID: window.workspace_ID,
            content
        })
    });
    const result = await response.json();
    return result;
}
async function getOldMessageFetch(url){
    if (url.includes('cursor')) url += `&workspace_ID=${window.workspace_ID}`;
    else url +=`?workspace_ID=${window.workspace_ID}`;
    const response = await fetch(url,{
        method: "GET", // or 'PUT'
        headers: {
            'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content'),
            'Accept':'application/json',
            'Content-Type':'application/json',
        },
    });
    const result = await response.json();
    return result;
}
// renderNewMessage(
//     "friend", 
//     {
//         id: "1",
//         name: "Quoc",
//         avatar: "https://lh3.googleusercontent.com/a/ACg8ocKLkdSunWMttLVCd_4fkdjq_mKVSkJkm9fKibAUuvIOrg=s96-c",
//     },
//     {
//         user_ID: "1",
//         created_at: "October 13, 2014 11:13:00",
//         content: "Quoc dep trai"
//     });
// renderNewMessage(
//     "You", 
//     {
//         id: "1",
//         name: "Quoc",
//         avatar: "https://lh3.googleusercontent.com/a/ACg8ocKLkdSunWMttLVCd_4fkdjq_mKVSkJkm9fKibAUuvIOrg=s96-c",
//     },
//     {
//         user_ID: "1",
//         created_at: "October 13, 2014 11:13:00",
//         content: "Quoc dep trai"
//     });
// loadNewOldMessages(
//     {
//         id: "2",
//         name: "Quoc",
//         avatar: "https://lh3.googleusercontent.com/a/ACg8ocKLkdSunWMttLVCd_4fkdjq_mKVSkJkm9fKibAUuvIOrg=s96-c",
//     },
//     {
//         user_ID: "2",
//         created_at: "2023-12-31 15:40:00",
//         content: "Test load old messages"
//     });
// loadNewOldMessages(
//     {
//         id: "1",
//         name: "Quoc",
//         avatar: "https://lh3.googleusercontent.com/a/ACg8ocKLkdSunWMttLVCd_4fkdjq_mKVSkJkm9fKibAUuvIOrg=s96-c",
//     },
//     {
//         user_ID: "1",
//         created_at: "2024-12-31 15:40:00",
//         content: "Test load old messages"
//     });
// loadNewOldMessages(
//     {
//         id: "1",
//         name: "Quoc",
//         avatar: "https://lh3.googleusercontent.com/a/ACg8ocKLkdSunWMttLVCd_4fkdjq_mKVSkJkm9fKibAUuvIOrg=s96-c",
//     },
//     {
//         user_ID: "1",
//         created_at: "2024-12-31 15:40:00",
//         content: "Test load old messages"
//     });
// loadNewOldMessages(
//     {
//         id: "2",
//         name: "Hoang Quoc",
//         avatar: "https://lh3.googleusercontent.com/a/ACg8ocKLkdSunWMttLVCd_4fkdjq_mKVSkJkm9fKibAUuvIOrg=s96-c",
//     },
//     {
//         user_ID: "2",
//         created_at: "2024-12-31 15:40:00",
//         content: "Test load old messages"
//     });
// loadNewOldMessages(
//     {
//         id: "2",
//         name: "Hoang Quoc",
//         avatar: "https://lh3.googleusercontent.com/a/ACg8ocKLkdSunWMttLVCd_4fkdjq_mKVSkJkm9fKibAUuvIOrg=s96-c",
//     },
//     {
//         user_ID: "2",
//         created_at: "2024-12-31 15:40:00",
//         content: "Test load old messages"
//     });
// loadNewOldMessages(
//     {
//         id: "3",
//         name: "Quoc",
//         avatar: "https://lh3.googleusercontent.com/a/ACg8ocKLkdSunWMttLVCd_4fkdjq_mKVSkJkm9fKibAUuvIOrg=s96-c",
//     },
//     {
//         user_ID: "3",
//         created_at: "2024-12-31 15:40:00",
//         content: "Test load old messages"
//     });
// loadNewOldMessages(
//     {
//         id: "3",
//         name: "Quoc",
//         avatar: "https://lh3.googleusercontent.com/a/ACg8ocKLkdSunWMttLVCd_4fkdjq_mKVSkJkm9fKibAUuvIOrg=s96-c",
//     },
//     {
//         user_ID: "3",
//         created_at: "2024-12-31 15:40:00",
//         content: "Test load old messages"
//     });
// loadNewOldMessages(
//     {
//         id: "1",
//         name: "Quoc",
//         avatar: "https://lh3.googleusercontent.com/a/ACg8ocKLkdSunWMttLVCd_4fkdjq_mKVSkJkm9fKibAUuvIOrg=s96-c",
//     },
//     {
//         user_ID: "1",
//         created_at: "2024-12-31 15:40:00",
//         content: "Test load old messages"
//     });
// loadNewOldMessages(
//     {
//         id: "1",
//         name: "Quoc",
//         avatar: "https://lh3.googleusercontent.com/a/ACg8ocKLkdSunWMttLVCd_4fkdjq_mKVSkJkm9fKibAUuvIOrg=s96-c",
//         },
//         {
//             user_ID: "1",
//             created_at: "2024-12-31 15:40:00",
//             content: "Test load old messages"
//         });
