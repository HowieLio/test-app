<div id="editModal" class="modal">
    <div class="modal-content">
        <form id="edit-block" class="add-block" action="{{ route('products.edit') }}" method="POST" style="display: contents">
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
            <button type="button" onclick="generateInputs('editAttributesInputContainer')" class="add-attribute">+ Добавить атрибут</button>
            <button type="submit" class="save-button">Сохранить</button>
        </form>
    </div>
</div>
