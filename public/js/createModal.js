let countRows = 0;
function generateInputs() {
    var container = document.getElementById('attributesInputContainer');

    var rowDiv = document.createElement('div');
    rowDiv.classList.add('attributes');

    var inputBoxName = document.createElement('div');
    inputBoxName.classList.add('input-box');

    var labelName = document.createElement('label');
    labelName.textContent = 'Название';

    var inputName = document.createElement('input');
    inputName.type = 'text';
    inputName.name = `attributes[${countRows}][name]`;

    inputBoxName.appendChild(labelName);
    inputBoxName.appendChild(inputName);

    var inputBoxValue = document.createElement('div');
    inputBoxValue.classList.add('input-box');

    var labelValue = document.createElement('label');
    labelValue.textContent = 'Значение';

    var inputValue = document.createElement('input');
    inputValue.type = 'text';
    inputValue.name = `attributes[${countRows}][value]`;

    inputBoxValue.appendChild(labelValue);
    inputBoxValue.appendChild(inputValue);

    var deleteButton = document.createElement('button');
    deleteButton.classList.add('delete-attribute');
    deleteButton.type = 'button';
    deleteButton.onclick = function() {
        container.removeChild(rowDiv);
        return countRows--;
    };
    countRows++;
    rowDiv.appendChild(inputBoxName);
    rowDiv.appendChild(inputBoxValue);
    rowDiv.appendChild(deleteButton);

    container.appendChild(rowDiv);
}
function sendData() {
    var form = document.querySelector('#add-block');
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
