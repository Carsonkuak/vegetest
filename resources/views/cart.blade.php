<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Your Cart</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
    <div class="container mt-5">
        <h1 class="mb-4">Your Cart</h1>

        @if($cartItems->isEmpty())
            <p class="alert alert-info">Your cart is empty.</p>
        @else
            <form action="{{ route('cart.update') }}" method="POST">
                @csrf
                <table class="table table-bordered table-hover">
                    <thead class="table-dark">
                        <tr>
                            <th>
                                <input type="checkbox" id="selectAll" onclick="toggleSelectAll(this)">
                            </th>
                            <th>Product Name</th>
                            <th>Mass (kg)</th>
                            <th>Price ($)</th>
                            <th>Total ($)</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($cartItems as $item)
                        <tr>
                            <td>
                                <input type="checkbox" name="selected_items[]" value="{{ $item->id }}">
                            </td>
                            <td>{{ $item->product->name }}</td>
                            <td>
                                <input type="number" name="mass[{{ $item->id }}]" class="form-control" value="{{ $item->mass }}" min="1" step="0.1">
                            </td>
                            <td>{{ number_format($item->product->price, 2) }}</td>
                            <td>{{ number_format($item->price, 2) }}</td>
                            <td>
                                <form action="{{ route('cart.delete', $item->id) }}" method="POST" onsubmit="return confirm('Are you sure you want to remove this product from the cart?');">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-danger">Delete</button>
                                </form>
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
                {{-- <button type="submit" class="btn btn-warning">Update Cart</button> --}}
            </form>

            <form action="{{ route('cart.checkout') }}" method="POST" class="mt-3">
                @csrf
                <input type="hidden" name="selected_items_for_checkout" id="selectedItemsForCheckout">
                <button type="submit" class="btn btn-success">Proceed to Checkout</button>
            </form>
        @endif

        <button class="btn btn-primary mt-3">
            <a href="{{ route('home') }}" style="color: white; text-decoration: none;">Home</a>
        </button>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>

    <script>
        function toggleSelectAll(source) {
            const checkboxes = document.querySelectorAll('input[name="selected_items[]"]');
            checkboxes.forEach(checkbox => {
                checkbox.checked = source.checked;
            });
        }

        document.querySelector('form[action="{{ route('cart.checkout') }}"]').addEventListener('submit', function(e) {
            const selectedItems = [];
            document.querySelectorAll('input[name="selected_items[]"]:checked').forEach(item => {
                selectedItems.push(item.value);
            });
            document.getElementById('selectedItemsForCheckout').value = selectedItems.join(',');
        });
    </script>
</body>
</html>
