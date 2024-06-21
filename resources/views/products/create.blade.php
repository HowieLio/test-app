 <div id="myModal" class="modal">
    <div class="modal-content">
        <form id="add-block" class="add-block" action="{{ route('products.create') }}" method="POST">
            @csrf
            <span class="close" onclick="closeAddModal()">
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
            <button type="button" onclick="generateInputs('attributesInputContainer')" class="add-attribute">
                + Добавить атрибут
            </button>
            <button type="submit" class="save-button">
                Добавить
            </button>
        </form>
    </div>
 </div>

{{-- <script src="{{ asset('js/generating.js') }}"></script>--}}
