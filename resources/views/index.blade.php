<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Product List</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        /* Custom styles for button group */
        .button-group {
            display: flex;
            gap: 10px; /* Space between buttons */
        }
    </style>
</head>
<body>
    <div class="container mt-5">
        <div class="d-flex justify-content-between align-items-center mb-4">
            <h1>Product List</h1>
            <div class="button-group">
                <button class="btn btn-success" onclick="window.location.href='{{ route('cart.view', ['user_id' => Auth::id()]) }}'">
                    View Cart
                </button>
                <button class="btn btn-info" onclick="window.location.href='{{ route('checkoutlist', ['user_id' => Auth::id()]) }}'">
                    View Checkout List
                </button>
            </div>
        </div>

        @if(session('success'))
            <div class="alert alert-success">{{ session('success') }}</div>
        @endif

        <table class="table table-bordered table-hover">
            <thead class="table-dark">
                <tr>
                    <th>Name</th>
                    <th>Mass (kg)</th>
                    <th>Price</th>
                </tr>
            </thead>
            <tbody id="product-table-body">

            </tbody>
        </table>
    </div>

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
