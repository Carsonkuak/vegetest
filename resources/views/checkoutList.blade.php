<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Checkout List</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
    <div class="container mt-5">
        <h1 class="mb-4">Checkout List</h1>

        @if($checkoutItems->isEmpty())
            <p class="alert alert-info">No checkout records found.</p>
        @else
            <table class="table table-bordered table-hover">
                <thead class="table-dark">
                    <tr>
                        <th>Username</th>
                        <th>Product Name</th>
                        <th>Mass (kg)</th>
                        <th>Total Price ($)</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($checkoutItems as $item)
                    <tr>
                        <td>{{ $item->user->name }}</td>
                        <td>{{ $item->product->name }}</td>
                        <td>{{ $item->mass }}</td>
                        <td>${{ number_format($item->price, 2) }}</td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        @endif

        <button class="btn btn-primary mt-3">
            <a href="{{ Route('home') }}" style="color: white; text-decoration: none;">Home</a>
        </button>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
