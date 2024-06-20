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
        @include('products.create')
    </div>
    @include('products.info')
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

<script src="{{ asset('js/modalFunctions.js') }}"></script>

