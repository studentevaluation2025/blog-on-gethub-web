<?php

namespace App\Console\Commands;

use App\Models\Post;
use Illuminate\Console\Command;

class PublishScheduledPosts extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'posts:publish';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Publish scheduled posts whose publish_at time has arrived.';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        Post::where('publish_at', '<=', now())
            ->where('status', 0)
            ->update(['status' => 1]);

        $this->info('Scheduled posts published successfully.');
    }
}
