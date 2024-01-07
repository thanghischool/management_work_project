function editProjectName(){
    const projectName  = document.getElementById('project-name');
    const project_ID = document.querySelector('meta[name="project_ID"]').getAttribute("content");
    projectName.contentEditable = true;
    let oldvalue = projectName.innerText;
    projectName.onblur = (e) => {
        if (projectName.innerText == "") {
            projectName.innerText = oldvalue;
        } else {
            // goi api doi ten project
            modifyProjectNameFetch(project_ID, projectName.innerText);
        }
    }
}
editProjectName();

function deleteProject(){
    deleteBtn = document.getElementById('deleteproject-btn');
    const project_ID = document.querySelector('meta[name="project_ID"]').getAttribute("content");
    deleteBtn.onclick = (e) => {
        deleteProjectFetch(project_ID);
    };
}
deleteProject();
async function modifyProjectNameFetch(id, newName){
    const response = await fetch(window.webURL+"api/project/"+id,{
        method: "PUT", // or 'PUT'
        headers: {
            'X-Socket-ID': window.Echo.socketId(),
            'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content'),
            'Accept':'application/json',
            'Content-Type':'application/json',
        },
        body: JSON.stringify({
            name: newName,
            workspace_ID: window.workspace_ID,
        })
    });
    const result = await response.json();
}
async function deleteProjectFetch(id){
    const response = await fetch(window.webURL+"api/project/"+id,{
        method: "delete", // or 'PUT'
        headers: {
            'X-Socket-ID': window.Echo.socketId(),
            'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content'),
            'Accept':'application/json',
            'Content-Type':'application/json',
        },
        body: JSON.stringify({
            workspace_ID: window.workspace_ID,
        })
    });
    const result = await response.json();
    window.location.href = window.location.protocol+'//'+window.location.host+"/workspace/"+window.workspace_ID;
}