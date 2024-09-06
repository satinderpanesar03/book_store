<!DOCTYPE html>
<html>
<head>
    <title>New Review has been submitted</title>
</head>
<body>
<h1>New Review for Your Book!</h1>
<p>{{ $review->book->title }}</p>
<p><strong>Review:</strong></p>
<blockquote>
    {{ $review->review }}
</blockquote>
<p>Thank you for your contributions!</p>
</body>
</html>
