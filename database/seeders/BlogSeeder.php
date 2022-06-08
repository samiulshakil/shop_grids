<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Blog;

class BlogSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Blog::create([
            'title' => 'This is title',
            'sub_title' => 'Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt.',
            'description' => 'We denounce with righteous indige nation and dislike men who are so beguiled and demo realized by the charms of pleasure of the moment, so blinded by desire, that they cannot foresee the pain and trouble that are bound to ensue; and equal blame belongs to those who fail in their duty through weakness of will, which is the same as saying through shrinking from toil and pain. These cases are perfectly simple and easy to distinguish. In a free hour, when our power of choice is untrammelled and when nothing prevents our being able to do what we like best, every pleasure is to be welcomed and every pain avoided.
                For those of you who are serious about having more.
                There are a million distractions in every facet of our lives.
                The sad thing is the majority of people have no clue about what they truly want.
                Once you have a clear understanding of what you want
                Focus is having the unwavering attention to complete what you set out to do.
                Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia.

                "Dont demand that things happen as you wish, but wish that they happen as they do happen, and you will go on well."
                - Epictetus, The Enchiridion
                Setting the mood with incense
                Remove aversion, then, from all things that are not in our control, and transfer it to things contrary to the nature of what is in our control. But, for the present, totally suppress desire: for, if you desire any of the things which are not in your own control, you must necessarily be disappointed; and of those which are, and which it would be laudable to desire, nothing is yet in your possession. Use only the appropriate actions of pursuit and avoidance; and even these lightly, and with gentleness and reservation.

                Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit.',
            'minute_read' => 4,
            'image' => 'https://via.placeholder.com/340x197',
            'category_id' => 1,
            'author' => 'Admin',
            'tags' => 'tag',
            'hash_tags' => '#blog, #shakil',
        ]);
    }
}
