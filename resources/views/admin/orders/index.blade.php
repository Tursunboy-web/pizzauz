@extends('layouts.app') {{-- Если у вас admin.layout — оставьте его, но он должен расширять layouts.app --}}

@section('title', 'Список заказов')

@section('content')
<div class="container-fluid">
    <h1 class="mb-4">📦 Все заказы</h1>

    <div class="table-responsive">
        <table class="table table-bordered table-hover align-middle">
            <thead class="table-dark">
                <tr>
                    <th>ID</th>
                    <th>Имя</th>
                    <th>Телефон</th>
                    <th>Адрес</th>
                    <th>Пицца</th>
                    <th>Дата</th>
                    <th>Статус</th>
                    <th>Действия</th>
                </tr>
            </thead>
            <tbody>
                @forelse ($orders as $order)
                    <tr>
                        <td>{{ $order->id }}</td>
                        <td>{{ $order->name }}</td>
                        <td>{{ $order->phone }}</td>
                        <td>{{ $order->address }}</td>
                        <td>{{ $order->pizza->name ?? '-' }}</td>
                        <td>{{ $order->created_at->format('d.m.Y H:i') }}</td>
                        <td>
                            <span class="badge
                                {{ $order->status === 'доставлен' ? 'bg-success' :
                                   ($order->status === 'готовится' ? 'bg-warning text-dark' : 'bg-secondary') }}">
                                {{ ucfirst($order->status) }}
                            </span>
                        </td>
                        <td>
                       <a href="{{ route('admin.orders.edit', $order->id) }}">Редактировать</a>


                            <form action="{{ route('admin.orders.destroy', $order->id) }}" method="POST" style="display:inline;">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-sm btn-outline-danger" onclick="return confirm('Удалить заказ?')" title="Удалить">
                                    🗑️
                                </button>
                            </form>
                        </td>
                    </tr>
                @empty
                    <tr><td colspan="8" class="text-center">Нет заказов</td></tr>
                @endforelse
            </tbody>
        </table>
    </div>

    {{-- Пагинация, если используется --}}
    <div class="d-flex justify-content-center mt-4">
        {{ $orders->links() }}
    </div>
</div>
@endsection
