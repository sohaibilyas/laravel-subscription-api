<?php

namespace App\Console\Commands;

use App\Jobs\SendingAlertForNewArticle;
use App\Models\Article;
use Illuminate\Console\Command;

class SendEmailToSubscribers extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'email:subscribers {article}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Send email to subscribers via article id';

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Execute the console command.
     *
     * @return int
     */
    public function handle()
    {
        $article = Article::find($this->argument('article'));

        if (!$article) {
            return $this->error('Article not found.');
        }

        $this->info('Sending emails to subscribers');
        
        SendingAlertForNewArticle::dispatch($article);
    }
}
