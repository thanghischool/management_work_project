import './bootstrap';
const workspaceElement = document.querySelector('meta[name="workspace_ID"]');
window.workspace_ID = workspaceElement.getAttribute('content');
workspaceElement.parentElement.removeChild(workspaceElement);
