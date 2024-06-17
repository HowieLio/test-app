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
    <button class="add-button">
        Добавить
    </button>

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
        width: 70%;
        border-collapse: collapse;
        margin-top: 20px;
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
        background-color: #0dc5fe;
        position: absolute;
        right: 20px;
        top: 100px;
        color: white;
        padding: 5px 40px;
        border-radius: 10px;
    }
</style>
