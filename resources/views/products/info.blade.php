<div id="infoModal" class="modal">
    <div class="modal-content">
        <div class="modal-header">
            <h2 class="product-info">Информация о продукте:</h2>
            <div class="modal-buttons">
                <button id="edit-button" onclick="handleEditButton()" class="edit-button">
                </button>
                @if(isset($product))
                    <form method="POST" action="{{ route('products.delete', $product->id) }}">
                        @csrf
                        @method('DELETE')
                        <button id="delete-button" type="submit" class="delete-button"></button>
                    </form>
                @endif
                <div class="modal-close" onclick="closeInfoModal()">&times;</div>
            </div>
        </div>
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
</div>

<script src="{{ asset('js/infoModal.js') }}"></script>
