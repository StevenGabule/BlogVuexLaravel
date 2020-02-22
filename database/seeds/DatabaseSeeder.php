<?php

use Illuminate\Database\Seeder;

use App\User;
use App\Model\Category;
use App\Model\Question;
use App\Model\Reply;
use App\Model\Like;


class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        factory(User::class, 100)->create();
        factory(Category::class, 100)->create();
        factory(Question::class, 1000)->create();
        factory(Reply::class, 100)->create()->each(function($reply) {
            return $reply->like()->saveMany(factory(Like::class, 100)->make());
        });
    }
}
