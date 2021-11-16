<?php

namespace App\Jobs;

use App\Notifications\ArticlePublished;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldBeUnique;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;

class SendingAlertForNewArticle implements ShouldQueue, ShouldBeUnique
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    public $article;

    /**
     * Create a new job instance.
     *
     * @return void
     */
    public function __construct($article)
    {
        $this->article = $article;
    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle()
    {
        foreach ($this->article->website->subscribers as $subscriber) {
            $subscriber->notify(new ArticlePublished([
                'subject' => $this->article->title,
                'message' => $this->article->content,
            ]));
        }
    }

    public function uniqueId()
    {
        return $this->article->id;
    }
}
