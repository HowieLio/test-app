<div id="infoModal" class="modal">
    <div class="modal-content">
        <div class="modal-header">
            <h2 class="product-info-label">Информация о продукте:</h2>
            <div class="modal-buttons">
                <button id="edit-button" onclick="handleEditButton()" class="edit-button">
                </button>
                @if(isset($product))
                    <form id="delete-block" method="POST">
                        @csrf
                        @method('DELETE')
                        <button id="delete-button" type="submit" class="delete-button"></button>
                    </form>
                @endif
                <div class="modal-close" onclick="closeInfoModal()">&times;</div>
            </div>
        </div>
        <div class="product-info">
            <label>Артикул:</label>
            <div id="infoArticle"></div>
        </div>
        <div class="product-info">
            <label>Название:</label>
            <div id="infoName"></div>
        </div>
        <div class="product-info">
            <label>Статус:</label>
            <div id="infoStatus"></div>
        </div>
        <div class="product-info">
            <label>Атрибуты:</label>
            <div id="infoAttributes"></div>
        </div>
    </div>
</div>

<script src="{{ asset('js/infoModal.js') }}"></script>
