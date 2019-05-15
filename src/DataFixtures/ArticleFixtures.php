<?php

namespace App\DataFixtures;

use App\Entity\Article;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\Persistence\ObjectManager;

class ArticleFixtures extends Fixture
{
    public function load(ObjectManager $manager)
    {
        for($x=0;$x<100;$x++){
            $article = new Article();
            $article->setTitle("Lorem ipsum " . $x);
            $article->setContent("## Hello world 
![](https://images.weserv.nl/?url=www.google.com/images/branding/googlelogo/2x/googlelogo_color_272x92dp.png&w=200)
I wouldn't have a second's hesitation of blowing your head off in front of them. Now, that's power you can't buy. That's the power of fear.
How can you move faster than possible, fight longer than possible, without the most powerful impulse of the spirit? The fear of death.
I had a vision of a world without Batman. The Mob ground out a little profit and the police tried to shut them down one block at a time. And it was so boring. I've had a change of heart. I don't want Mr Reese spoiling everything but why should I have all the fun? Let's give someone else a chance. If Coleman Reese isn't dead in 60 minutes then I blow up a hospital.
Never underestimate Gotham City. People get mugged coming home from work every day of the week. Sometimes things just go bad.");
            $manager->persist($article);
        }

        $manager->flush();
    }
}
