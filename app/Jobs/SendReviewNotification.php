<?php

namespace App\Jobs;

use App\Mail\ReviewNotification;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Foundation\Queue\Queueable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\Mail;

class SendReviewNotification implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    protected $review;
    public function __construct($review)
    {
        $this->review = $review;
    }

    /**
     * Execute the job.
     */
    public function handle(): void
    {
        $book = $this->review->book;
        $authors = $book->authors;

        foreach ($authors as $author) {
//            Mail::to($author)->send(new ReviewNotification($this->review));
            Mail::to('satinderpanesar03@gmail.com')->send(new ReviewNotification($this->review));
        }
    }
}
