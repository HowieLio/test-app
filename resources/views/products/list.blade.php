<x-app-layout>
    <div class="topbar">
        <div class="sections">
            <div class="section">
                <a href="{{ route('products.list') }}" class="active">Продукты</a>
            </div>
            <a href="{{ route('profile.edit') }}">
               {{ $user->name }}
            </a>
        </div>
    </div>
    <div class="table-content">
        <table>
            <thead>
            <tr>
                <th>Артикул</th>
                <th>Название</th>
                <th>Статус</th>
                <th>Атрибуты</th>
            </tr>
            </thead>
            <tbody>
            @foreach($products as $product)
                <tr class="tr-body">
                    <th>{{ $product->article }}</th>
                    <th>{{ $product->name }}</th>
                    <th>{{ $product->status === 'available' ? 'Доступен' : 'Не доступен' }}</th>
                    <th>
                        @foreach(json_decode($product->data, true) as $key => $value)
                            <span>
                            {{ $key }}:
                        </span>
                            <span>
                            {{ $value }}
                        </span>
                            <br>
                        @endforeach
                    </th>
                </tr>
            @endforeach
            </tbody>
        </table>
        <button id="add-button" onclick="handleAddButton()" class="add-button">
            Добавить продукт
        </button>
        <form id='add-block' class="add-block" action="{{ route('products.create') }}" method="POST">
            @csrf
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

            <button type="submit">Сохранить</button>
        </form>
    </div>
</x-app-layout>
<style>
    .topbar {
        position: relative;
        top: 0;
        left: 0;
        width: 100%;
        box-sizing: border-box;
        padding: 0 20px;
        background-color: white;
    }
    .sections {
        align-items: center;
        display: flex;
        justify-content: space-between;
        gap: 20px;
        .section {
            display: flex;
            align-items: center;
            gap: 20px;
            a {
                padding: 25px 0;
                text-transform: uppercase;
            }
            a.active {
                color: #ED1C24;
                border-bottom: 4px solid #ED1C24;
            }
        }
    }
    table {
        border-collapse: collapse;
        margin-top: 20px;
        width: 50vw;
        min-width: 50vw;
    }
    th, td {
        padding: 8px;
        text-align: left;
        font-weight: 400;
        color: #6E6E6F;
        border-bottom: 1px solid #C4C4C4;
    }
    tr.tr-body {
        box-sizing: border-box;
        padding: 10px;
        background-color: white;
    }
    .add-button {
        margin-top: 20px;
        margin-right: 20px;
        background-color: #0dc5fe;
        color: white;
        padding: 5px 40px;
        border-radius: 10px;
    }
    .table-content {
        display: flex;
        align-items: flex-start;
        justify-content: space-between;
        gap: 20px;
        width: 100%;
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
        var addButton = document.getElementById('add-button');
        var addBlock = document.getElementById('add-block');

        // Скрыть кнопку
        addButton.style.display = 'none';

        // Показать блок добавления продукта
        addBlock.style.display = 'block';
    }

</script>


