<div id="editModal" class="modal">
    <div class="modal-content">
        <form id="edit-block" class="add-block" action="{{ route('products.edit') }}" onsubmit="sendEditData()" method="POST" style="display: contents">
            @csrf
            <input type="hidden" name="product_id" id="editProductId">
            <span class="close" onclick="closeEditModal()">
                &times;
            </span>
            <h1 style="color: white; font-size: 20px; font-weight: 900; margin-bottom: 20px">
                Редактировать продукт
            </h1>
            <div class="input-box">
                <label>Артикул</label>
                <input id="editArticle" name="article" type="text" required>
            </div>
            <div class="input-box">
                <label>Название</label>
                <input id="editName" name="name" type="text" required>
            </div>
            <div class="input-box">
                <label>Статус</label>
                <select id="editStatus" name="status">
                    <option value="available">Доступен</option>
                    <option value="unavailable">Недоступен</option>
                </select>
                <label style="font-weight: 900; margin-top: 10px">Атрибуты</label>
            </div>
            <div id="editAttributesInputContainer"></div>
            <button type="button" onclick="generateEditAttributes()" class="add-attribute">+ Добавить атрибут</button>
            <button type="submit" class="save-button">Сохранить</button>
        </form>
    </div>
</div>
<script>
    function sendEditData() {
        var form = document.querySelector('#edit-block');
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
    let countEditRows = 0;

    function generateEditAttributes(name = null, value = null) {
        var container = document.getElementById('editAttributesInputContainer');

        var rowDiv = document.createElement('div');
        rowDiv.classList.add('attributes');

        var inputBoxName = document.createElement('div');
        inputBoxName.classList.add('input-box');

        var labelName = document.createElement('label');
        labelName.textContent = 'Название';

        var inputName = document.createElement('input');
        inputName.type = 'text';
        inputName.name = `attributes[${countEditRows}][name]`;
        inputName.value = name;

        inputBoxName.appendChild(labelName);
        inputBoxName.appendChild(inputName);

        var inputBoxValue = document.createElement('div');
        inputBoxValue.classList.add('input-box');

        var labelValue = document.createElement('label');
        labelValue.textContent = 'Значение';

        var inputValue = document.createElement('input');
        inputValue.type = 'text';
        inputValue.name = `attributes[${countEditRows}][value]`;
        inputValue.value = value;

        inputBoxValue.appendChild(labelValue);
        inputBoxValue.appendChild(inputValue);

        var deleteButton = document.createElement('button');
        deleteButton.classList.add('delete-attribute');
        deleteButton.type = 'button';
        deleteButton.onclick = function() {
            container.removeChild(rowDiv);
            return countEditRows--;
        };
        countEditRows++;
        rowDiv.appendChild(inputBoxName);
        rowDiv.appendChild(inputBoxValue);
        rowDiv.appendChild(deleteButton);

        container.appendChild(rowDiv);
    }
</script>
