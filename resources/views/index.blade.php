<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Product List</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
    <div class="container mt-5">
        <h1 class="mb-4">Product List</h1>

        <!-- Link to add a new product -->
        <a href="{{ route('create') }}" class="btn btn-primary mb-3">Add New Product</a>

        <!-- Success message alert -->
        @if(session('success'))
            <div class="alert alert-success">{{ session('success') }}</div>
        @endif

        <table class="table table-bordered table-hover">
            <thead class="table-dark">
                <tr>
                    <th>Name</th>
                    <th>Mass (kg)</th>
                    <th>Price</th>
                    <th>Quantity</th>
                </tr>
            </thead>
            <tbody id="product-table-body">
                <!-- Products will be loaded here via JavaScript -->
            </tbody>
        </table>
    </div>

    <!-- Include Bootstrap JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>

    <script>
        document.addEventListener('DOMContentLoaded', function() {
            fetch('/products/list')
                .then(response => response.json())
                .then(data => {
                    const tableBody = document.getElementById('product-table-body');
                    let rows = '';

                    data.forEach(product => {
                        let showRoute = `{{ route('show', ':id') }}`.replace(':id', product.id);

                        rows += `
                            <tr onclick="window.location.href='${showRoute}'" style="cursor: pointer;">
                                <td>${product.name}</td>
                                <td>${product.mass}</td>
                                <td>$${parseFloat(product.price).toFixed(2)}</td>
                                <td>${product.quantity}</td>
                            </tr>
                        `;
                    });

                    tableBody.innerHTML = rows;
                })
                .catch(error => console.error('Error fetching products:', error));
        });
    </script>

</body>
</html>
