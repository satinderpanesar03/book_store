<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css">
    <title>Book Details</title>
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
                <li class="breadcrumb-item"><a href="#">Home</a></li>
                <li class="breadcrumb-item"><a href="{{ route('books.index') }}">Books</a></li>
                <li class="breadcrumb-item active" aria-current="page">{{ $book->title }}</li>
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
        <div class="col-md-8 col-md-offset-2">
            <h2>
                {{ $book->title }}
                &nbsp;
               <button class="btn btn-sm btn-primary" title="Rating">{{ $averageRating }}</button>
            </h2>
            <p><strong>Description:</strong> {{ $book->description }}</p>
            <p><strong>Price:</strong> ${{ $book->price }}</p>
            <p><strong>Category:</strong> {{ $book->category->name }}</p>
            <p><strong>Authors:</strong>
                @foreach($book->authors as $author)
                    {{ $author->name }}@if(!$loop->last), @endif
                @endforeach
            </p>

            <h3>Reviews</h3>
            <ul class="list-unstyled">
                @foreach($book->reviews as $item)
                    <li>
                        <strong>User:</strong> {{ $item->user->name }} <br>
                        <strong>Rating:</strong> {{ $item->rating }} <br>
                        <strong>Review:</strong> {{ $item->review }} <br>
                        <hr>
                    </li>
                @endforeach
            </ul>

            @auth
                <h3>Submit a Review</h3>
                <form action="{{ route('review.store') }}" method="POST">
                    @csrf
                    <input type="hidden" name="book_id" value="{{ $book->id }}">
                    <div class="form-group">
                        <label for="rating">Rating:</label>
                        <select id="rating" name="rating" class="form-control" required>
                            <option value="1">1 Star</option>
                            <option value="2">2 Stars</option>
                            <option value="3">3 Stars</option>
                            <option value="4">4 Stars</option>
                            <option value="5">5 Stars</option>
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="review">Review:</label>
                        <textarea id="review" name="review" class="form-control" rows="4" required></textarea>
                    </div>
                    <button type="submit" class="btn btn-primary">Submit Review</button>
                </form>
            @else
                <p><a href="{{ route('login.form') }}" class="btn btn-warning">Login to Submit a Review</a></p>
            @endauth

        </div>
    </div>
</div>

</body>
</html>
