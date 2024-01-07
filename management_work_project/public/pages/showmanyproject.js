function project_specific(id) {
    let currentLink = window.location.href;
    window.location.href = `${currentLink}/project/${id}`;
}
async function addProjectFetch(projectName, project){
    const response = await fetch(window.webURL+"api/project",{
        method: "POST", // or 'PUT'
        headers: {
            'X-Socket-ID': window.Echo.socketId(),
            'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content'),
            'Accept':'application/json',
            'Content-Type':'application/json',
        },
        body: JSON.stringify({
            name: projectName,
            workspace_ID: document.querySelector('meta[name="workspace_ID"]').getAttribute('content'),
        })
    });
    const result = await response.json();
    project.id = result.id;
    project.onclick = () => {
        project_specific(result.id);
    }
    console.log(result);

}
function addProjectBtn(){
    const btn = document.getElementById("addproject-btn");
    btn.addEventListener("click", () => {
        btn.style.display = "none";
        NewProjectForm();
        // get textarea
        const input = btn.previousElementSibling.firstElementChild;
        const project = btn.previousElementSibling;
        input.focus();
        input.onblur = () => {
            if (input.value == ""){
                btn.parentElement.removeChild(btn.previousElementSibling);
                btn.style.display = "block";
                console.log("Please write");
            } else {
                const title = document.createElement("span");
                title.class = "disable-select";
                title.title = title.innerHTML = input.value;
                input.parentElement.replaceChild(title, input);
                btn.style.display = "block";
                // fetch modify data
                addProjectFetch(title.title, project);
            }

        };
    });
}
function NewProjectForm(){
    const form = document.createElement("div");
    form.className = "item";
    const input = document.createElement("textarea");
    input.className = "project-name";
    input.autofocus = true;
    input.placeholder = "Project Name";
    form.appendChild(input);
    form
    form.innerHTML += `<div class="progress-bar" style="background: linear-gradient(90deg, #fdbd19 0%, #d9d9d9 0%);">
    </div>
    <div class="progress-percent">0.00%</div>`;
    const parent = document.querySelector('.project-list');
    parent.insertBefore(form, parent.lastElementChild);
}
addProjectBtn();