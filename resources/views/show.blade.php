<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Product Details</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        .btn-primary a {
            color: white;
            text-decoration: none;
        }

        .btn-primary a:hover {
            color: white;
            text-decoration: none;
        }
    </style>
</head>
<body>
    <div class="container mt-5">
        <h1 class="mb-4">Product Details</h1>

        @if(session('success'))
            <div class="alert alert-success">{{ session('success') }}</div>
        @endif

        <form action="{{ route('cart.add') }}" method="POST">
            @csrf
            <input type="hidden" name="product_id" value="{{ $product->id }}">

            <div class="mb-3">
                <label for="name" class="form-label">Product Name</label>
                <input type="text" id="name" name="name" class="form-control" value="{{ $product->name }}" readonly>
            </div>

            <div class="mb-3">
                <label for="price" class="form-label">Price ($)</label>
                <input type="text" id="price" name="price" class="form-control" value="{{ number_format($product->price, 2) }}" readonly>
            </div>

            <div class="mb-3">
                <label for="mass" class="form-label">Mass (kg)</label>
                <input type="number" id="mass" name="mass" class="form-control" value="{{ $product->mass }}">
            </div>

            <button type="submit" class="btn btn-success">Add to Cart</button>
        </form>

        <button class="btn btn-primary mt-3">
            <a href="{{ Route('home') }}">Home</a>
        </button>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
