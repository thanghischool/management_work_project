function applyEditableTitleToList(listQuery, titleQuery, blockwallQuery){
    lists = Array.from(document.querySelectorAll(listQuery));
    const span = document.createElement('span');
    span.style.setProperty('display','inline-block');
    span.id = "heightExpanded";
    span.style.setProperty('word-break','break-all');
    span.style.setProperty('font-size',2 + "rem");
    span.style.setProperty('font-weight', 'bold');  
    span.style.setProperty('font-family', 'monospace');
    span.style.setProperty('width', document.querySelector(titleQuery).offsetWidth + "px");
    span.style.setProperty('visibility', "hidden");
    span.style.setProperty('position', "absolute");
    document.body.appendChild(span);
    lists.forEach(list => {
        const title = list.querySelector(titleQuery);
        const blockwall = list.querySelector(blockwallQuery);
        span.textContent = title.value;
        title.style.height = span.offsetHeight + 'px';
        blockwall.style.height = title.style.height;
        blockwall.onclick = (e) => {
            blockwall.style.visibility = "hidden";
            title.focus();
            title.select();
            const oldValue = title.value;
            title.onblur = (e1) => {
                blockwall.style.visibility = "visible";
                if(title.value === "" || title.value === oldValue) title.value = oldValue;
                else modifyListTitle(list.id, title.value);
            };
        }
        title.addEventListener('input', (e) =>{
            // console.log(title.scrollHeight);
            // title.style.height = title.scrollHeight - 4 + 'px';
            // blockwall.style.height = title.style.height + 'px';
            span.textContent = title.value;
            blockwall.style.height = title.style.height;
            if(title.value !== "") title.style.height = span.offsetHeight + 'px';
        })
    });
}
async function modifyListTitle(id, title){
    const response = await fetch("http://127.0.0.1:8000/api/lists/title/"+id,{
        method: "PUT", // or 'PUT'
        headers: {
            'X-Socket-ID': window.Echo.socketId(),
            'Accept':'application/json',
            'Content-Type':'application/json',
        },
        body: JSON.stringify({
            title: title,
        })
    });
    const result = await response.json();
    console.log(result);
}
