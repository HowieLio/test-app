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
    <table>
        XUI
    </table>
</x-app-layout>
<style>
    .topbar {
        position: relative;
        top: 0;
        left: 0;
        width: 100%;
        box-sizing: border-box;
        padding: 20px;
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
        }
    }
</style>
