<td>
  <span style="color: {{ $order->status == 'доставлен' ? 'green' : ($order->status == 'готовится' ? 'orange' : 'gray') }}">
    {{ ucfirst($order->status) }}
  </span>
</td>
<td>
  <a href="{{ route('orders.edit', $order->id) }}" style="color: blue;">✏️</a>
  <form action="{{ route('orders.destroy', $order->id) }}" method="POST" style="display:inline;">
      @csrf @method('DELETE')
      <button onclick="return confirm('Удалить заказ?')" style="color:red;">🗑️</button>
  </form>
  <th>Статус</th>
<th>Действия</th>

</td>
