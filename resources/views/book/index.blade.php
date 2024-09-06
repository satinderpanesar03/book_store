<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <title>Books</title>
    <style>
        .breadcrumb-container {
            display: flex;
            align-items: center;
            justify-content: space-between;
        }
        .breadcrumb {
            display: flex;
            flex-wrap: wrap;
            margin: 0;
        }
        .breadcrumb .btn {
            margin-left: auto;
        }
    </style>
</head>
<body>

<div class="container">
    <nav aria-label="breadcrumb">
        <div class="breadcrumb-container">
            <ol class="breadcrumb">
                <li><a href="#">Home</a></li>
                <li class="active">Books</li>
            </ol>
            @auth
                <form action="{{ route('logout') }}" method="POST" style="display: inline;">
                    @csrf
                    <button type="submit" class="btn btn-danger btn-sm">Logout</button>
                </form>
            @endauth
        </div>
    </nav>


    <div class="row">
        <div class="col-md-12">
            <table class="table table-striped text-center">
                <thead>
                <tr class="text-center">
                    <th scope="col">#</th>
                    <th scope="col">Title</th>
                    <th scope="col">Description</th>
                    <th scope="col">Price</th>
                    <th scope="col">Category</th>
                    <th scope="col">Authors</th>
                    <th scope="col">Action</th>
                </tr>
                </thead>
                <tbody>
                @foreach($books as $value => $book)
                    <tr>
                        <th scope="row">{{ $books->firstItem() + $value }}</th>
                        <td>{{ $book->title }}</td>
                        <td>{{ $book->description }}</td>
                        <td>${{ $book->price }}</td>
                        <td>{{ $book->category->name }}</td>
                        <td>
                            @foreach($book->authors as $author)
                                {{ $author->name }}@if(!$loop->last), @endif
                            @endforeach
                        </td>
                        <td class="text-success">
                            <a href="{{ route('books.show', $book->id) }}"><i class="fa fa-eye" aria-hidden="true"></i></a>
                        </td>
                    </tr>
                @endforeach
                </tbody>
            </table>
        </div>
        <div>
            {{ $books->links() }}
        </div>
    </div>
</div>

</body>
</html>
