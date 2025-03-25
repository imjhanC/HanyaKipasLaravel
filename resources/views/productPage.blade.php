<!DOCTYPE html>
<html>
<head>
    <title>Product Page</title>
</head>
<body>
    <h1>Product List</h1>

    <table border="1">
        <thead>
            <tr>
                <th>ID</th>
                <th>Model</th>
                <th>Description</th>
                <th>Company ID</th>
                <th>Image</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($products as $product)
                <tr>
                    <td>{{ $product->product_id }}</td>
                    <td>{{ $product->model }}</td>
                    <td>{{ $product->p_desc }}</td>
                    <td>{{ $product->company_id }}</td>
                    <td>
                        <img src="data:image/png;base64,{{ $product->p_img }}" alt="Product Image" style="width:100px; height:auto;">
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
</body>
</html>
