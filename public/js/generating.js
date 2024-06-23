let countRows = 0
function generateInputs(containerId, name = '', value = '') {
    const container = document.getElementById(containerId);

    const rowDiv = document.createElement('div');
    rowDiv.classList.add('attributes');

    rowDiv.innerHTML = `
        <div class="input-box">
            <label>Название</label>
            <input type="text" name="attributes[${countRows}][name]" value="${name}">
        </div>
        <div class="input-box">
            <label>Значение</label>
            <input type="text" name="attributes[${countRows}][value]" value="${value}">
        </div>
        <button type="button" class="delete-attribute" onclick="this.parentNode.remove(); countRows--;"></button>
    `;

    countRows++;
    container.appendChild(rowDiv);
}
function sendData(event, form_id) {
    event.preventDefault();
    const form = document.querySelector(form_id);
    let formData = new FormData(form);

    axios.post(form.action, formData)
        .then(function (response) {
            console.log('Success:', response.data);
            window.location.reload();
        })
        .catch(function (error) {
            console.error('Error:', error.response.data);
            alert(error.response.data.message)
        });
}
