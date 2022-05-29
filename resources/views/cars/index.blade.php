<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <title>MVC Assignment | SW2</title>
        <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" >
    </head>
    <body>
        <div class="container mt-2">
        <div class="row">
            <div class="col-lg-12 margin-tb">
            <div class="pull-left">
            <h2>MVC Assignment</h2>
            </div>
            <div class="pull-right mb-2">
            <a class="btn btn-success" href="{{ route('cars.create') }}">Create New Car</a>
            </div>
            </div>
        </div>
        @if ($message = Session::get('success'))
        <div class="alert alert-success">
             <p>{{ $message }}</p>
        </div>
        @endif
        <table class="table table-bordered">
            <tr>
                <th>#ID</th>
                <th>Car Model</th>
                <th>Car Brand</th>
                <th>Car Price</th>
                <th width="280px">Action</th>
            </tr>
            @foreach ($cars as $car)
        <tr>
            <td>{{ $car->id }}</td>
            <td>{{ $car->model }}</td>
            <td>{{ $car->brand }}</td>
            <td>{{ $car->price }}</td>
            <td>
                <form action="{{ route('cars.destroy',$car->id) }}" method="Post">
                    <a class="btn btn-primary" href="{{ route('cars.edit',$car->id) }}">Edit</a>
                    @csrf
                    @method('DELETE')
                    <button type="submit" class="btn btn-danger">Delete</button>
                </form>
            </td>
        </tr>
        @endforeach
        </table>
        {!! $cars->links() !!}
    </body>
</html>