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

<script src="{{ asset('js/infoModal.js') }}"></script>




