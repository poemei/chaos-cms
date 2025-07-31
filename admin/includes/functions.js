// admin.js — Shared Admin JS

function showSpinner(button) {
    button.disabled = true;
    const spinner = document.createElement('span');
    spinner.className = 'spinner-border spinner-border-sm ms-2';
    spinner.setAttribute('role', 'status');
    spinner.setAttribute('aria-hidden', 'true');
    button.appendChild(spinner);
}

function restoreButton(button, originalText) {
    button.disabled = false;
    button.innerHTML = originalText;
}

function sendPost(url, data, callback) {
    const xhr = new XMLHttpRequest();
    xhr.open('POST', url);
    xhr.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");
    xhr.onload = () => {
        callback(xhr.responseText);
    };
    xhr.send(new URLSearchParams(data).toString());
}