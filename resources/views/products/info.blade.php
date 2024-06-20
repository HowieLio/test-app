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

<script src="{{ asset('js/infoModal.js') }}"></script>




