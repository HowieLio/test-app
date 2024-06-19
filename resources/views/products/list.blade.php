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
            <tbody>
            @foreach($products as $product)
                <tr class="tr-body"
                    data-product="{{ $product }}"
                    data-product-id="{{ $product->id }}"
                    data-product-article="{{ $product->article }}"
                    data-product-name="{{ $product->name }}"
                    data-product-status="{{ $product->status }}"
                    data-product-attributes="{{ json_encode(json_decode($product->data, true)) }}">
                    <td>{{ $product->article }}</td>
                    <td>{{ $product->name }}</td>
                    <td>{{ $product->status === 'available' ? 'Доступен' : 'Не доступен' }}</td>
                    <td>
                        @foreach(json_decode($product->data, true) as $key => $value)
                            <span>{{ $key }}: {{ $value }}</span><br>
                        @endforeach
                    </td>
                </tr>
            @endforeach
            </tbody>
        </table>
        <button id="add-button" onclick="handleAddButton()" class="add-button">
            Добавить продукт
        </button>
        @include('products.modal')
    </div>
    <div id="infoModal" class="modal">
        <div class="modal-content">
            <span class="close" onclick="closeInfoModal()">&times;</span>
            <h1 style="color: white; font-size: 20px; font-weight: 900; margin-bottom: 20px">
                Информация о продукте:
            </h1>
            <div class="input-box">
                <label style="color:#FFFFFFB2">Артикул:</label>
                <div id="infoArticle"></div>
            </div>
            <div class="input-box">
                <label style="color:#FFFFFFB2">Название:</label>
                <div id="infoName"></div>
            </div>
            <div class="input-box">
                <label style="color:#FFFFFFB2">Статус:</label>
                <div id="infoStatus"></div>
            </div>
            <div class="input-box">
                <label style="color:#FFFFFFB2">Атрибуты:</label>
                <div id="infoAttributes"></div>
            </div>
        </div>
        <button id="edit-button" onclick="handleEditButton()" class="edit-button">
        </button>
        <button id="delete-button" onclick="handleDeleteButton()" class="delete-button">
        </button>
    </div>
    @include('products.edit')
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
        cursor: pointer;
    }
    .add-button {
        margin-top: 20px;
        margin-right: 20px;
        background-color: #0dc5fe;
        color: white;
        padding: 5px 40px;
        border-radius: 7px;
    }
    .table-content {
        display: flex;
        align-items: flex-start;
        justify-content: space-between;
        gap: 20px;
        width: 100%;
        max-height: calc(100vh - 78px);
        overflow: auto;
    }
    .edit-button {
        width: 20px;
        height: 20px;
        background: url('/assets/icons/edit.svg') no-repeat center center;
        background-size: contain;
        border: none;
        cursor: pointer;
        position: relative;
        top: 82px;
        right: 433px;
        transform: translateY(100%);
    }
    .delete-button {
        width: 20px;
        height: 20px;
        background: url('/assets/icons/trash2.svg') no-repeat center center;
        background-size: contain;
        border: none;
        cursor: pointer;
        position: relative;
        top: 82px;
        right: 430px;
        transform: translateY(100%);
    }
</style>

<script>
    let editProductId = null;

    document.addEventListener('DOMContentLoaded', function() {
        const rows = document.querySelectorAll('.tr-body');
        rows.forEach(row => {
            row.addEventListener('click', () => {
                editProductId = row.getAttribute('data-product-id');
                const productArticle = row.getAttribute('data-product-article');
                const productName = row.getAttribute('data-product-name');
                const productStatus = row.getAttribute('data-product-status');
                const productAttributes = JSON.parse(row.getAttribute('data-product-attributes'));

                document.getElementById('infoArticle').textContent = productArticle;
                document.getElementById('infoName').textContent = productName;
                document.getElementById('infoStatus').textContent = productStatus;

                const editNameInput = document.getElementById('editName');
                const editArticleInput = document.getElementById('editArticle');
                const editStatusInput = document.getElementById('editStatus');
                editNameInput.value = productName;
                editArticleInput.value = productArticle;
                editStatusInput.value = productStatus;
                document.getElementById('editAttributesInputContainer').innerHTML = '';
                for (let key in productAttributes) {
                    if (productAttributes.hasOwnProperty(key)) {
                        generateEditAttributes(key, productAttributes[key]);
                    }
                }
                const attributesContainer = document.getElementById('infoAttributes');
                attributesContainer.innerHTML = '';

                for (const [key, value] of Object.entries(productAttributes)) {
                    const attributeElement = document.createElement('p');
                    attributeElement.textContent = `${key}: ${value}`;
                    attributesContainer.appendChild(attributeElement);
                }

                document.getElementById('infoModal').style.display = 'flex';
            });
        });
    });

    function closeInfoModal() {
        document.getElementById('infoModal').style.display = 'none';
    }

    function handleEditButton() {
        closeInfoModal();
        var editModal = document.getElementById('editModal');
        editModal.style.display = 'flex';
    }

    function closeEditModal() {
        document.getElementById('editModal').style.display = 'none';
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
        inputName.name = `attributes[${countRows}][name]`;
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
            return countRows--;
        };
        countRows++;
        rowDiv.appendChild(inputBoxName);
        rowDiv.appendChild(inputBoxValue);
        rowDiv.appendChild(deleteButton);

        container.appendChild(rowDiv);
    }

    window.onclick = function(event) {
        var modals = ['myModal', 'infoModal', 'editModal'];
        modals.forEach(function(modalId) {
            var modal = document.getElementById(modalId);
            if (event.target === modal) {
                modal.style.display = 'none';
            }
        });
    }


</script>
