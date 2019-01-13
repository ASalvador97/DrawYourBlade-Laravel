<?php

use Illuminate\Database\Seeder;
use App\Post;

class PostsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
		$post = new Post;
        $post->title = 'Honed Void-Axe';
		$post->type = 'axe';
		$post->content = "The axe belonged to a collector of gems. He travelled the
		purple planets and sought the finest crystals. When he didn't feel like
		fighting he would masterfully use his other skill: haggle. Some years ago
		his journey ended, he disappeared and the axe was lost. The gem merchants,
		however, still fear him.";
		$post->description = "A weapon made from gems.";
		$post->creatorID = '1';
		$post->fileDir = 'userContent/1/posts/post11.png';
		$post->circledDir = 'userContent/1/posts/circled/post11.png';
		$post->pixelatedDir = 'userContent/1/posts/pixelated/post11.png';
        $post->save();
		
		$post = new Post;
        $post->title = 'Manol\'s Desire';
		$post->type = 'sabre';
		$post->content = "Captain Manol's speech before a raid would warm the hearts
		of his men like premium rum. His never ending supply of tricks and backup
		plans would make him hard to catch and more slippery than a greased baby fish.
		Such a persona rightfully deserves a pirate's sabre that is no less famous
		than he is. \r\n
		
		Many generic pirate captains like Manol seek the legendary blade, but no mortal
		has seen it. Does it even exist? Manol believes so, and is the one dreaming
		of finding it first and being its possessor.";
		$post->description = "More of treasure than a blade.";
		$post->creatorID = '1';
		$post->fileDir = 'userContent/1/posts/post12.png';
		$post->circledDir = 'userContent/1/posts/circled/post12.png';
		$post->pixelatedDir = 'userContent/1/posts/pixelated/post12.png';
        $post->save();
		
        $post = new Post;
        $post->title = 'Steel of Madness';
        $post->type = 'axe';
        $post->content = "An engineer for the eastern empires dedicated his life in
        designing and improving the weight distribution of weapons. There was no piece
        of metal or wood he could not reshape and rebalance. Then a rival of his gave
        him a gift: a new type of alloy called 'stormsteel'. The metal would not be
        tamed - it proved to be impossible to even calculate it center of mass.
        The engineer was driven mad and in his genius he made this axe. Sometimes it
        adapts to the battle, is unpredictable and brings victory, other times it
        makes the wielder stagger like a newborn deer.";
        $post->description = "A challenging metal.";
        $post->creatorID = '1';
        $post->fileDir = 'userContent/1/posts/colored_axe.jpg';
        $post->circledDir = 'userContent/1/posts/circled/colored_axe.jpg';
        $post->pixelatedDir = 'userContent/1/posts/pixelated/colored_axe.jpg';
        $post->save();

		$post = new Post;
        $post->title = 'Training hammer';
		$post->type = 'hammer';
		$post->content = "The young disciples of the paladin academy are given one of
		those hammers after passing their first year with more than 50 exam credits.";
		$post->description = "A simple weapon for a complex destiny.";
		$post->creatorID = '2';
		$post->fileDir = 'userContent/2/posts/post21.jpeg';
        $post->circledDir = 'userContent/2/posts/circled/post21.jpg';
        $post->pixelatedDir = 'userContent/2/posts/pixelated/post21.jpg';
        $post->save();

        $post = new Post;
        $post->title = 'The Silver Spiral';
        $post->type = 'hammer';
        $post->content = "Anyone can destroy. But using one's
        skills to create is considered noble in the dwarven city beyond the
        dam. This weapon was never used in battle and its owner is no warrior. But
        for some reason hammers are the most important part of a dwarf's attire.";
        $post->description = "A fancy trinket and not really a weapon.";
        $post->creatorID = '2';
        $post->fileDir = 'userContent/2/posts/post22.jpg';
		$post->circledDir = 'userContent/2/posts/circled/post22.jpg';
		$post->pixelatedDir = 'userContent/2/posts/pixelated/post22.jpg';
        $post->save();

        $post = new Post;
        $post->title = 'Cruel Ice';
        $post->type = 'sword';
        $post->content = "Whistling cold wind. Delicate and flawless snowflakes with many
        detailed shapes in them. The air is sharp and odourless because of the intense cold.
        This is the realm of the child queen of the frozen wastes. She might be a kid, but
        her lands are most fiercely defended. The royal guard's swords are made of the
        crystallized tears of her enemies. A blade as sharp as it is cruel.";
        $post->description = "A creation of nature and malice.";
        $post->creatorID = '2';
        $post->fileDir = 'userContent/2/posts/cruel_ice.jpg';
		$post->circledDir = 'userContent/2/posts/circled/cruel_ice.jpg';
		$post->pixelatedDir = 'userContent/2/posts/pixelated/cruel_ice.jpg';
        $post->save();

    }
}
