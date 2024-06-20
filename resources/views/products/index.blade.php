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

<script src="{{ asset('js/modalFunctions.js') }}"></script>

