 <div id="myModal" class="modal">
    <div class="modal-content">
        <form id="add-block" class="add-block" action="{{ route('products.create') }}" method="POST">
            @csrf
            <span class="close" onclick="closeModal()">
                &times;
            </span>
            <h1 style="color: white; font-size: 20px; font-weight: 900; margin-bottom: 20px">
                Добавить продукт
            </h1>
            <div class="input-box">
                <label>
                    Артикул
                </label>
                <input id="article" name="article" type="text" required>
            </div>
            <div class="input-box">
                <label>
                    Название
                </label>
                <input id="name" name="name" type="text" required>
            </div>
            <div class="input-box">
                <label>
                    Статус
                </label>
                <select id="status" name="status">
                    <option value="available">Доступен</option>
                    <option value="unavailable">Недоступен</option>
                </select>
                <label style="font-weight: 900; margin-top: 10px">
                    Атрибуты
                </label>
            </div>
            <div id="attributesInputContainer"></div>
            <button type="button" onclick="generateInputs()" class="add-attribute">
                + Добавить атрибут
            </button>
            <button type="submit" class="save-button">
                Добавить
            </button>
        </form>
    </div>
 </div>
<style>
    .save-button {
        margin-top: 20px;
        margin-right: 20px;
        background-color: #0dc5fe;
        color: white;
        padding: 10px 80px;
        border-radius: 7px;
        display: block;
    }
    .add-block {
        background-color: #374050;
        box-sizing: border-box;
        padding: 20px;
        width: 100%;
        max-height: calc(100vh - 78px);
        overflow: auto;
        display: none;
    }
    .input-box {
        display: flex;
        flex-direction: column;
        gap: 5px;
        color: white;
        margin-top: 10px;
        input {
            border-radius: 10px;
            color: black;
        }
        select {
            /*-webkit-appearance: none;*/
            /*appearance: none;*/
            color: black;
            border-radius: 10px;
        }
        option {
            /*-webkit-appearance: none;*/
            /*appearance: none;*/
            background-color: #fff;
            color: #333;
            padding: 6px 12px;
            font-size: 14px;
        }
    }
    .add-attribute {
        color: #5FC6F1;
        text-decoration: underline dotted;
        cursor: pointer;
        background-color: transparent;
        border: none;
        outline: none;
    }
    .modal {
        display: none;
        position: fixed;
        z-index: 1;
        left: 0;
        top: 0;
        width: 100%;
        height: 100%;
        overflow: auto;
        background-color: rgba(0,0,0,0.4);
        box-sizing: border-box;
    }
    .modal-content {
        background-color: #374050;
        margin: 5% auto;
        padding: 20px;
        border: 1px solid #888;
        width: 50%;
        max-height: calc(100vh - 78px);
        overflow: auto;
        box-sizing: border-box;
        position: relative;
    }
    .close {
        color: #aaaaaa;
        float: right;
        font-size: 36px;
        font-weight: 100;
        cursor: pointer;
        position: absolute;
        top: 10px;
        right: 20px;
    }
    .close:hover,
    .close:focus {
        color: white;
        text-decoration: none;
    }

    .attributes {
        display: flex;
        align-items: center;
        gap: 10px;
        width: 100%;
    }
    .delete-attribute {
        width: 18px;
        height: 18px;
        background: url('/assets/icons/trash.svg') no-repeat center center;
        background-size: contain;
        border: none;
        cursor: pointer;
        position: relative;
        top: 50%;
        transform: translateY(100%);
    }
</style>

<script>
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
        var form = document.querySelector('.add-block');
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
    function handleAddButton() {
        var modal = document.getElementById('myModal');
        var addBlock = document.getElementById('add-block');
        modal.style.display = 'flex';
        addBlock.style.display = 'block';
    }
    function closeModal() {
        var modal = document.getElementById('myModal');
        var addBlock = document.getElementById('add-block');
        modal.style.display = 'none';
        addBlock.style.display = 'none';
    }
    window.onclick = function(event) {
        var modal = document.getElementById('myModal');
        var addBlock = document.getElementById('add-block');
        if (event.target === modal) {
            modal.style.display = 'none';
            addBlock.style.display = 'none';
        }
    }

</script>


