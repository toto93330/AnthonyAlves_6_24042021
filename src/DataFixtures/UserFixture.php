<?php

namespace App\DataFixtures;

use App\Entity\User;
use App\Entity\Trick;
use App\Entity\Category;
use App\Entity\Page;
use Doctrine\Persistence\ObjectManager;
use Doctrine\ORM\EntityManagerInterface;
use Doctrine\Bundle\FixturesBundle\Fixture;

class UserFixture extends Fixture
{


    private $entityManager;


    /**
     * @param EntityManagerInterface $entityManager
     */
    public function __construct(EntityManagerInterface $entityManager)
    {
        $this->entityManager = $entityManager;
    }

    /**
     * LOAD FIXTURE
     *
     * @param ObjectManager $manager
     * @return void
     */
    public function load(ObjectManager $manager)
    {
        // USER FIXTURE

        $user = [
            1 => [
                'email' => 'contact@snowtricks.com',
                'role' => 'ROLE_ADMIN',
                'password' => '$argon2id$v=19$m=65536,t=4,p=1$Vi5KZ0JXdTJza3ljcHBxZg$8K790TZkhXQgKEMw6tbuEhAMNrj0piptF2xrFwZcPlg',
                'avatar' => '28129ac0ba395d0d88c713c6abaff9d6.jpg',
                'firstname' => 'John',
                'lastname' => 'Doe',
                'validate' => '1',
            ]
        ];

        foreach ($user as $value) {
            $user = new User();
            $today = new \DateTime('NOW');
            $user->setEmail($value['email']);
            $user->setRoles(array($value['role']));
            $user->setPassword($value['password']);
            $user->setAvatar($value['avatar']);
            $user->setRegisterAt($today);
            $user->setFirstname($value['firstname']);
            $user->setLastname($value['lastname']);
            $user->setValidate($value['validate']);
            $manager->persist($user);
        }

        $manager->flush();

        // CATEGORY FIXTURE
        $category = [
            1 => [
                'name' => 'Rotation'
            ],
            2 => [
                'name' => 'Flip'
            ],
            3 => [
                'name' => 'Slide'
            ],
            4 => [
                'name' => 'Old school'
            ],
            5 => [
                'name' => 'Jump'
            ],
        ];

        foreach ($category as $key => $value) {
            $category = new Category();
            $category->setName($value['name']);
            $manager->persist($category);
        }

        $manager->flush();

        // TRICKS FIXTURE
        $trick = [
            1 => [
                'category_id' => '1',
                'author_id' => '1',
                'title' => 'Stalefish',
                'image_card' => 'b6320a22798e145f84925fa3631826e730a86497.jpg',
                'content' => 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Phasellus est diam, tincidunt ac lorem sed, vehicula lobortis ligula. Nullam id scelerisque magna, et cursus arcu. Proin eleifend lacus sit amet bibendum imperdiet. Fusce a iaculis ex, eu euismod nisl. Proin ut fringilla nunc, ac suscipit magna. Curabitur mollis in ipsum vitae ullamcorper. In quis diam ut eros faucibus accumsan in ut est. In nec finibus ex. Etiam vulputate aliquet tortor ac consectetur. Etiam ac tortor aliquet, aliquam lacus efficitur, blandit nisl. Vestibulum in orci ut massa semper ultrices ut et nibh. Sed laoreet cursus libero eget maximus. Integer non lacus cursus tellus porttitor placerat ut sit amet magna. Pellentesque sagittis fringilla massa eget bibendum. Etiam vestibulum pretium risus, in sollicitudin nisl mollis nec. Integer quis turpis vulputate, volutpat ligula nec, dignissim dolor. Suspendisse potenti. Sed eget nunc vitae urna sodales euismod. Vestibulum mollis, metus at gravida malesuada, enim leo pharetra eros, at volutpat sem odio a lacus. Donec rutrum nisl in metus vehicula, in bibendum sapien vestibulum. Donec porttitor nisi risus, ut dignissim sem iaculis eget. Suspendisse condimentum congue ex, sed placerat nibh vehicula vel. Vestibulum aliquam lobortis dapibus. Donec pharetra posuere sapien a fermentum. Duis turpis nibh, viverra vel risus vel, varius blandit dolor. Praesent fringilla, lectus malesuada dapibus pharetra, risus lorem interdum turpis, id efficitur elit quam a eros. Class aptent taciti sociosqu ad litora torquent per conubia nostra, per inceptos himenaeos. Integer eu convallis libero. Aliquam sed enim lorem. Nunc ullamcorper bibendum mauris molestie ullamcorper. In euismod egestas felis. Vivamus interdum iaculis eros eget pretium. Pellentesque habitant morbi tristique senectus et netus et malesuada fames ac turpis egestas. Fusce non metus non urna hendrerit bibendum. Phasellus et viverra ex, ut maximus urna. Sed non justo id dolor mattis placerat eget commodo velit. Donec ut metus lacus. Proin eget eros eget elit bibendum blandit. Cras volutpat accumsan nunc in molestie. Nunc ultrices nibh ut ornare vulputate. Morbi sed efficitur sem.',
                'slug' => 'stalefish',
                'edited' => '0',
            ],
            2 => [
                'category_id' => '1',
                'author_id' => '1',
                'title' => 'FS 720',
                'image_card' => '9bdad0ced3c3d245e22f76fb24e93b119ab2bc44.jpg',
                'content' => 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Phasellus est diam, tincidunt ac lorem sed, vehicula lobortis ligula. Nullam id scelerisque magna, et cursus arcu. Proin eleifend lacus sit amet bibendum imperdiet. Fusce a iaculis ex, eu euismod nisl. Proin ut fringilla nunc, ac suscipit magna. Curabitur mollis in ipsum vitae ullamcorper. In quis diam ut eros faucibus accumsan in ut est. In nec finibus ex. Etiam vulputate aliquet tortor ac consectetur. Etiam ac tortor aliquet, aliquam lacus efficitur, blandit nisl. Vestibulum in orci ut massa semper ultrices ut et nibh. Sed laoreet cursus libero eget maximus. Integer non lacus cursus tellus porttitor placerat ut sit amet magna. Pellentesque sagittis fringilla massa eget bibendum. Etiam vestibulum pretium risus, in sollicitudin nisl mollis nec. Integer quis turpis vulputate, volutpat ligula nec, dignissim dolor. Suspendisse potenti. Sed eget nunc vitae urna sodales euismod. Vestibulum mollis, metus at gravida malesuada, enim leo pharetra eros, at volutpat sem odio a lacus. Donec rutrum nisl in metus vehicula, in bibendum sapien vestibulum. Donec porttitor nisi risus, ut dignissim sem iaculis eget. Suspendisse condimentum congue ex, sed placerat nibh vehicula vel. Vestibulum aliquam lobortis dapibus. Donec pharetra posuere sapien a fermentum. Duis turpis nibh, viverra vel risus vel, varius blandit dolor. Praesent fringilla, lectus malesuada dapibus pharetra, risus lorem interdum turpis, id efficitur elit quam a eros. Class aptent taciti sociosqu ad litora torquent per conubia nostra, per inceptos himenaeos. Integer eu convallis libero. Aliquam sed enim lorem. Nunc ullamcorper bibendum mauris molestie ullamcorper. In euismod egestas felis. Vivamus interdum iaculis eros eget pretium. Pellentesque habitant morbi tristique senectus et netus et malesuada fames ac turpis egestas. Fusce non metus non urna hendrerit bibendum. Phasellus et viverra ex, ut maximus urna. Sed non justo id dolor mattis placerat eget commodo velit. Donec ut metus lacus. Proin eget eros eget elit bibendum blandit. Cras volutpat accumsan nunc in molestie. Nunc ultrices nibh ut ornare vulputate. Morbi sed efficitur sem.',
                'slug' => 'FS-720',
                'edited' => '0',
            ],
            3 => [
                'category_id' => '1',
                'author_id' => '1',
                'title' => 'Back side rodeo 1080',
                'image_card' => '6a9af7456209a695f266a9b184a0fe9fb584d468.jpg',
                'content' => 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Phasellus est diam, tincidunt ac lorem sed, vehicula lobortis ligula. Nullam id scelerisque magna, et cursus arcu. Proin eleifend lacus sit amet bibendum imperdiet. Fusce a iaculis ex, eu euismod nisl. Proin ut fringilla nunc, ac suscipit magna. Curabitur mollis in ipsum vitae ullamcorper. In quis diam ut eros faucibus accumsan in ut est. In nec finibus ex. Etiam vulputate aliquet tortor ac consectetur. Etiam ac tortor aliquet, aliquam lacus efficitur, blandit nisl. Vestibulum in orci ut massa semper ultrices ut et nibh. Sed laoreet cursus libero eget maximus. Integer non lacus cursus tellus porttitor placerat ut sit amet magna. Pellentesque sagittis fringilla massa eget bibendum. Etiam vestibulum pretium risus, in sollicitudin nisl mollis nec. Integer quis turpis vulputate, volutpat ligula nec, dignissim dolor. Suspendisse potenti. Sed eget nunc vitae urna sodales euismod. Vestibulum mollis, metus at gravida malesuada, enim leo pharetra eros, at volutpat sem odio a lacus. Donec rutrum nisl in metus vehicula, in bibendum sapien vestibulum. Donec porttitor nisi risus, ut dignissim sem iaculis eget. Suspendisse condimentum congue ex, sed placerat nibh vehicula vel. Vestibulum aliquam lobortis dapibus. Donec pharetra posuere sapien a fermentum. Duis turpis nibh, viverra vel risus vel, varius blandit dolor. Praesent fringilla, lectus malesuada dapibus pharetra, risus lorem interdum turpis, id efficitur elit quam a eros. Class aptent taciti sociosqu ad litora torquent per conubia nostra, per inceptos himenaeos. Integer eu convallis libero. Aliquam sed enim lorem. Nunc ullamcorper bibendum mauris molestie ullamcorper. In euismod egestas felis. Vivamus interdum iaculis eros eget pretium. Pellentesque habitant morbi tristique senectus et netus et malesuada fames ac turpis egestas. Fusce non metus non urna hendrerit bibendum. Phasellus et viverra ex, ut maximus urna. Sed non justo id dolor mattis placerat eget commodo velit. Donec ut metus lacus. Proin eget eros eget elit bibendum blandit. Cras volutpat accumsan nunc in molestie. Nunc ultrices nibh ut ornare vulputate. Morbi sed efficitur sem.',
                'slug' => 'back-side-rodeo-1080',
                'edited' => '0',
            ],
            4 => [
                'category_id' => '1',
                'author_id' => '1',
                'title' => 'Frontflip',
                'image_card' => '11cc4b35aa5a125319e58e8aff102b856c8be5ef.jpg',
                'content' => 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Phasellus est diam, tincidunt ac lorem sed, vehicula lobortis ligula. Nullam id scelerisque magna, et cursus arcu. Proin eleifend lacus sit amet bibendum imperdiet. Fusce a iaculis ex, eu euismod nisl. Proin ut fringilla nunc, ac suscipit magna. Curabitur mollis in ipsum vitae ullamcorper. In quis diam ut eros faucibus accumsan in ut est. In nec finibus ex. Etiam vulputate aliquet tortor ac consectetur. Etiam ac tortor aliquet, aliquam lacus efficitur, blandit nisl. Vestibulum in orci ut massa semper ultrices ut et nibh. Sed laoreet cursus libero eget maximus. Integer non lacus cursus tellus porttitor placerat ut sit amet magna. Pellentesque sagittis fringilla massa eget bibendum. Etiam vestibulum pretium risus, in sollicitudin nisl mollis nec. Integer quis turpis vulputate, volutpat ligula nec, dignissim dolor. Suspendisse potenti. Sed eget nunc vitae urna sodales euismod. Vestibulum mollis, metus at gravida malesuada, enim leo pharetra eros, at volutpat sem odio a lacus. Donec rutrum nisl in metus vehicula, in bibendum sapien vestibulum. Donec porttitor nisi risus, ut dignissim sem iaculis eget. Suspendisse condimentum congue ex, sed placerat nibh vehicula vel. Vestibulum aliquam lobortis dapibus. Donec pharetra posuere sapien a fermentum. Duis turpis nibh, viverra vel risus vel, varius blandit dolor. Praesent fringilla, lectus malesuada dapibus pharetra, risus lorem interdum turpis, id efficitur elit quam a eros. Class aptent taciti sociosqu ad litora torquent per conubia nostra, per inceptos himenaeos. Integer eu convallis libero. Aliquam sed enim lorem. Nunc ullamcorper bibendum mauris molestie ullamcorper. In euismod egestas felis. Vivamus interdum iaculis eros eget pretium. Pellentesque habitant morbi tristique senectus et netus et malesuada fames ac turpis egestas. Fusce non metus non urna hendrerit bibendum. Phasellus et viverra ex, ut maximus urna. Sed non justo id dolor mattis placerat eget commodo velit. Donec ut metus lacus. Proin eget eros eget elit bibendum blandit. Cras volutpat accumsan nunc in molestie. Nunc ultrices nibh ut ornare vulputate. Morbi sed efficitur sem.',
                'slug' => 'frontflip',
                'edited' => '0',
            ],
            5 => [
                'category_id' => '1',
                'author_id' => '1',
                'title' => 'Backflip',
                'image_card' => '7f4a41913165ae233e10aebc2877ba982054faf4.jpg',
                'content' => 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Phasellus est diam, tincidunt ac lorem sed, vehicula lobortis ligula. Nullam id scelerisque magna, et cursus arcu. Proin eleifend lacus sit amet bibendum imperdiet. Fusce a iaculis ex, eu euismod nisl. Proin ut fringilla nunc, ac suscipit magna. Curabitur mollis in ipsum vitae ullamcorper. In quis diam ut eros faucibus accumsan in ut est. In nec finibus ex. Etiam vulputate aliquet tortor ac consectetur. Etiam ac tortor aliquet, aliquam lacus efficitur, blandit nisl. Vestibulum in orci ut massa semper ultrices ut et nibh. Sed laoreet cursus libero eget maximus. Integer non lacus cursus tellus porttitor placerat ut sit amet magna. Pellentesque sagittis fringilla massa eget bibendum. Etiam vestibulum pretium risus, in sollicitudin nisl mollis nec. Integer quis turpis vulputate, volutpat ligula nec, dignissim dolor. Suspendisse potenti. Sed eget nunc vitae urna sodales euismod. Vestibulum mollis, metus at gravida malesuada, enim leo pharetra eros, at volutpat sem odio a lacus. Donec rutrum nisl in metus vehicula, in bibendum sapien vestibulum. Donec porttitor nisi risus, ut dignissim sem iaculis eget. Suspendisse condimentum congue ex, sed placerat nibh vehicula vel. Vestibulum aliquam lobortis dapibus. Donec pharetra posuere sapien a fermentum. Duis turpis nibh, viverra vel risus vel, varius blandit dolor. Praesent fringilla, lectus malesuada dapibus pharetra, risus lorem interdum turpis, id efficitur elit quam a eros. Class aptent taciti sociosqu ad litora torquent per conubia nostra, per inceptos himenaeos. Integer eu convallis libero. Aliquam sed enim lorem. Nunc ullamcorper bibendum mauris molestie ullamcorper. In euismod egestas felis. Vivamus interdum iaculis eros eget pretium. Pellentesque habitant morbi tristique senectus et netus et malesuada fames ac turpis egestas. Fusce non metus non urna hendrerit bibendum. Phasellus et viverra ex, ut maximus urna. Sed non justo id dolor mattis placerat eget commodo velit. Donec ut metus lacus. Proin eget eros eget elit bibendum blandit. Cras volutpat accumsan nunc in molestie. Nunc ultrices nibh ut ornare vulputate. Morbi sed efficitur sem.',
                'slug' => 'backflip',
                'edited' => '0',
            ],
            6 => [
                'category_id' => '1',
                'author_id' => '1',
                'title' => 'Cork',
                'image_card' => '36fcf2d9efe1fd8d6f7fb9b617fcb854728bb670.jpg',
                'content' => 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Phasellus est diam, tincidunt ac lorem sed, vehicula lobortis ligula. Nullam id scelerisque magna, et cursus arcu. Proin eleifend lacus sit amet bibendum imperdiet. Fusce a iaculis ex, eu euismod nisl. Proin ut fringilla nunc, ac suscipit magna. Curabitur mollis in ipsum vitae ullamcorper. In quis diam ut eros faucibus accumsan in ut est. In nec finibus ex. Etiam vulputate aliquet tortor ac consectetur. Etiam ac tortor aliquet, aliquam lacus efficitur, blandit nisl. Vestibulum in orci ut massa semper ultrices ut et nibh. Sed laoreet cursus libero eget maximus. Integer non lacus cursus tellus porttitor placerat ut sit amet magna. Pellentesque sagittis fringilla massa eget bibendum. Etiam vestibulum pretium risus, in sollicitudin nisl mollis nec. Integer quis turpis vulputate, volutpat ligula nec, dignissim dolor. Suspendisse potenti. Sed eget nunc vitae urna sodales euismod. Vestibulum mollis, metus at gravida malesuada, enim leo pharetra eros, at volutpat sem odio a lacus. Donec rutrum nisl in metus vehicula, in bibendum sapien vestibulum. Donec porttitor nisi risus, ut dignissim sem iaculis eget. Suspendisse condimentum congue ex, sed placerat nibh vehicula vel. Vestibulum aliquam lobortis dapibus. Donec pharetra posuere sapien a fermentum. Duis turpis nibh, viverra vel risus vel, varius blandit dolor. Praesent fringilla, lectus malesuada dapibus pharetra, risus lorem interdum turpis, id efficitur elit quam a eros. Class aptent taciti sociosqu ad litora torquent per conubia nostra, per inceptos himenaeos. Integer eu convallis libero. Aliquam sed enim lorem. Nunc ullamcorper bibendum mauris molestie ullamcorper. In euismod egestas felis. Vivamus interdum iaculis eros eget pretium. Pellentesque habitant morbi tristique senectus et netus et malesuada fames ac turpis egestas. Fusce non metus non urna hendrerit bibendum. Phasellus et viverra ex, ut maximus urna. Sed non justo id dolor mattis placerat eget commodo velit. Donec ut metus lacus. Proin eget eros eget elit bibendum blandit. Cras volutpat accumsan nunc in molestie. Nunc ultrices nibh ut ornare vulputate. Morbi sed efficitur sem.',
                'slug' => 'cork',
                'edited' => '0',
            ],
            7 => [
                'category_id' => '1',
                'author_id' => '1',
                'title' => 'Rodeo',
                'image_card' => 'b1e2648f6f42c70bd18137ca43fe05f914cf0396.jpg',
                'content' => 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Phasellus est diam, tincidunt ac lorem sed, vehicula lobortis ligula. Nullam id scelerisque magna, et cursus arcu. Proin eleifend lacus sit amet bibendum imperdiet. Fusce a iaculis ex, eu euismod nisl. Proin ut fringilla nunc, ac suscipit magna. Curabitur mollis in ipsum vitae ullamcorper. In quis diam ut eros faucibus accumsan in ut est. In nec finibus ex. Etiam vulputate aliquet tortor ac consectetur. Etiam ac tortor aliquet, aliquam lacus efficitur, blandit nisl. Vestibulum in orci ut massa semper ultrices ut et nibh. Sed laoreet cursus libero eget maximus. Integer non lacus cursus tellus porttitor placerat ut sit amet magna. Pellentesque sagittis fringilla massa eget bibendum. Etiam vestibulum pretium risus, in sollicitudin nisl mollis nec. Integer quis turpis vulputate, volutpat ligula nec, dignissim dolor. Suspendisse potenti. Sed eget nunc vitae urna sodales euismod. Vestibulum mollis, metus at gravida malesuada, enim leo pharetra eros, at volutpat sem odio a lacus. Donec rutrum nisl in metus vehicula, in bibendum sapien vestibulum. Donec porttitor nisi risus, ut dignissim sem iaculis eget. Suspendisse condimentum congue ex, sed placerat nibh vehicula vel. Vestibulum aliquam lobortis dapibus. Donec pharetra posuere sapien a fermentum. Duis turpis nibh, viverra vel risus vel, varius blandit dolor. Praesent fringilla, lectus malesuada dapibus pharetra, risus lorem interdum turpis, id efficitur elit quam a eros. Class aptent taciti sociosqu ad litora torquent per conubia nostra, per inceptos himenaeos. Integer eu convallis libero. Aliquam sed enim lorem. Nunc ullamcorper bibendum mauris molestie ullamcorper. In euismod egestas felis. Vivamus interdum iaculis eros eget pretium. Pellentesque habitant morbi tristique senectus et netus et malesuada fames ac turpis egestas. Fusce non metus non urna hendrerit bibendum. Phasellus et viverra ex, ut maximus urna. Sed non justo id dolor mattis placerat eget commodo velit. Donec ut metus lacus. Proin eget eros eget elit bibendum blandit. Cras volutpat accumsan nunc in molestie. Nunc ultrices nibh ut ornare vulputate. Morbi sed efficitur sem.',
                'slug' => 'rodeo',
                'edited' => '0',
            ],
            8 => [
                'category_id' => '1',
                'author_id' => '1',
                'title' => 'Tail slide',
                'image_card' => '41f3fc7b9a39b0501d223a743ef42d79fa73f1cb.jpg',
                'content' => 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Phasellus est diam, tincidunt ac lorem sed, vehicula lobortis ligula. Nullam id scelerisque magna, et cursus arcu. Proin eleifend lacus sit amet bibendum imperdiet. Fusce a iaculis ex, eu euismod nisl. Proin ut fringilla nunc, ac suscipit magna. Curabitur mollis in ipsum vitae ullamcorper. In quis diam ut eros faucibus accumsan in ut est. In nec finibus ex. Etiam vulputate aliquet tortor ac consectetur. Etiam ac tortor aliquet, aliquam lacus efficitur, blandit nisl. Vestibulum in orci ut massa semper ultrices ut et nibh. Sed laoreet cursus libero eget maximus. Integer non lacus cursus tellus porttitor placerat ut sit amet magna. Pellentesque sagittis fringilla massa eget bibendum. Etiam vestibulum pretium risus, in sollicitudin nisl mollis nec. Integer quis turpis vulputate, volutpat ligula nec, dignissim dolor. Suspendisse potenti. Sed eget nunc vitae urna sodales euismod. Vestibulum mollis, metus at gravida malesuada, enim leo pharetra eros, at volutpat sem odio a lacus. Donec rutrum nisl in metus vehicula, in bibendum sapien vestibulum. Donec porttitor nisi risus, ut dignissim sem iaculis eget. Suspendisse condimentum congue ex, sed placerat nibh vehicula vel. Vestibulum aliquam lobortis dapibus. Donec pharetra posuere sapien a fermentum. Duis turpis nibh, viverra vel risus vel, varius blandit dolor. Praesent fringilla, lectus malesuada dapibus pharetra, risus lorem interdum turpis, id efficitur elit quam a eros. Class aptent taciti sociosqu ad litora torquent per conubia nostra, per inceptos himenaeos. Integer eu convallis libero. Aliquam sed enim lorem. Nunc ullamcorper bibendum mauris molestie ullamcorper. In euismod egestas felis. Vivamus interdum iaculis eros eget pretium. Pellentesque habitant morbi tristique senectus et netus et malesuada fames ac turpis egestas. Fusce non metus non urna hendrerit bibendum. Phasellus et viverra ex, ut maximus urna. Sed non justo id dolor mattis placerat eget commodo velit. Donec ut metus lacus. Proin eget eros eget elit bibendum blandit. Cras volutpat accumsan nunc in molestie. Nunc ultrices nibh ut ornare vulputate. Morbi sed efficitur sem.',
                'slug' => 'tail-slide',
                'edited' => '0',
            ],
            9 => [
                'category_id' => '1',
                'author_id' => '1',
                'title' => 'Ollie',
                'image_card' => '66575aabbee3b0cc6b2e27422e8e10b52126db9c.jpg',
                'content' => 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Phasellus est diam, tincidunt ac lorem sed, vehicula lobortis ligula. Nullam id scelerisque magna, et cursus arcu. Proin eleifend lacus sit amet bibendum imperdiet. Fusce a iaculis ex, eu euismod nisl. Proin ut fringilla nunc, ac suscipit magna. Curabitur mollis in ipsum vitae ullamcorper. In quis diam ut eros faucibus accumsan in ut est. In nec finibus ex. Etiam vulputate aliquet tortor ac consectetur. Etiam ac tortor aliquet, aliquam lacus efficitur, blandit nisl. Vestibulum in orci ut massa semper ultrices ut et nibh. Sed laoreet cursus libero eget maximus. Integer non lacus cursus tellus porttitor placerat ut sit amet magna. Pellentesque sagittis fringilla massa eget bibendum. Etiam vestibulum pretium risus, in sollicitudin nisl mollis nec. Integer quis turpis vulputate, volutpat ligula nec, dignissim dolor. Suspendisse potenti. Sed eget nunc vitae urna sodales euismod. Vestibulum mollis, metus at gravida malesuada, enim leo pharetra eros, at volutpat sem odio a lacus. Donec rutrum nisl in metus vehicula, in bibendum sapien vestibulum. Donec porttitor nisi risus, ut dignissim sem iaculis eget. Suspendisse condimentum congue ex, sed placerat nibh vehicula vel. Vestibulum aliquam lobortis dapibus. Donec pharetra posuere sapien a fermentum. Duis turpis nibh, viverra vel risus vel, varius blandit dolor. Praesent fringilla, lectus malesuada dapibus pharetra, risus lorem interdum turpis, id efficitur elit quam a eros. Class aptent taciti sociosqu ad litora torquent per conubia nostra, per inceptos himenaeos. Integer eu convallis libero. Aliquam sed enim lorem. Nunc ullamcorper bibendum mauris molestie ullamcorper. In euismod egestas felis. Vivamus interdum iaculis eros eget pretium. Pellentesque habitant morbi tristique senectus et netus et malesuada fames ac turpis egestas. Fusce non metus non urna hendrerit bibendum. Phasellus et viverra ex, ut maximus urna. Sed non justo id dolor mattis placerat eget commodo velit. Donec ut metus lacus. Proin eget eros eget elit bibendum blandit. Cras volutpat accumsan nunc in molestie. Nunc ultrices nibh ut ornare vulputate. Morbi sed efficitur sem.',
                'slug' => 'ollie',
                'edited' => '0',
            ],
            10 => [
                'category_id' => '1',
                'author_id' => '1',
                'title' => 'Taking Jumps',
                'image_card' => '71d891d2cdb60dda838bf19ecd2fc19b127a6aaa.webp',
                'content' => 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Phasellus est diam, tincidunt ac lorem sed, vehicula lobortis ligula. Nullam id scelerisque magna, et cursus arcu. Proin eleifend lacus sit amet bibendum imperdiet. Fusce a iaculis ex, eu euismod nisl. Proin ut fringilla nunc, ac suscipit magna. Curabitur mollis in ipsum vitae ullamcorper. In quis diam ut eros faucibus accumsan in ut est. In nec finibus ex. Etiam vulputate aliquet tortor ac consectetur. Etiam ac tortor aliquet, aliquam lacus efficitur, blandit nisl. Vestibulum in orci ut massa semper ultrices ut et nibh. Sed laoreet cursus libero eget maximus. Integer non lacus cursus tellus porttitor placerat ut sit amet magna. Pellentesque sagittis fringilla massa eget bibendum. Etiam vestibulum pretium risus, in sollicitudin nisl mollis nec. Integer quis turpis vulputate, volutpat ligula nec, dignissim dolor. Suspendisse potenti. Sed eget nunc vitae urna sodales euismod. Vestibulum mollis, metus at gravida malesuada, enim leo pharetra eros, at volutpat sem odio a lacus. Donec rutrum nisl in metus vehicula, in bibendum sapien vestibulum. Donec porttitor nisi risus, ut dignissim sem iaculis eget. Suspendisse condimentum congue ex, sed placerat nibh vehicula vel. Vestibulum aliquam lobortis dapibus. Donec pharetra posuere sapien a fermentum. Duis turpis nibh, viverra vel risus vel, varius blandit dolor. Praesent fringilla, lectus malesuada dapibus pharetra, risus lorem interdum turpis, id efficitur elit quam a eros. Class aptent taciti sociosqu ad litora torquent per conubia nostra, per inceptos himenaeos. Integer eu convallis libero. Aliquam sed enim lorem. Nunc ullamcorper bibendum mauris molestie ullamcorper. In euismod egestas felis. Vivamus interdum iaculis eros eget pretium. Pellentesque habitant morbi tristique senectus et netus et malesuada fames ac turpis egestas. Fusce non metus non urna hendrerit bibendum. Phasellus et viverra ex, ut maximus urna. Sed non justo id dolor mattis placerat eget commodo velit. Donec ut metus lacus. Proin eget eros eget elit bibendum blandit. Cras volutpat accumsan nunc in molestie. Nunc ultrices nibh ut ornare vulputate. Morbi sed efficitur sem.',
                'slug' => 'taking-jumps',
                'edited' => '0',
            ],
            11 => [
                'category_id' => '1',
                'author_id' => '1',
                'title' => 'Jump trick',
                'image_card' => '95486b54d3759298e05744254a9950c117dbcc1f.jpg',
                'content' => 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Phasellus est diam, tincidunt ac lorem sed, vehicula lobortis ligula. Nullam id scelerisque magna, et cursus arcu. Proin eleifend lacus sit amet bibendum imperdiet. Fusce a iaculis ex, eu euismod nisl. Proin ut fringilla nunc, ac suscipit magna. Curabitur mollis in ipsum vitae ullamcorper. In quis diam ut eros faucibus accumsan in ut est. In nec finibus ex. Etiam vulputate aliquet tortor ac consectetur. Etiam ac tortor aliquet, aliquam lacus efficitur, blandit nisl. Vestibulum in orci ut massa semper ultrices ut et nibh. Sed laoreet cursus libero eget maximus. Integer non lacus cursus tellus porttitor placerat ut sit amet magna. Pellentesque sagittis fringilla massa eget bibendum. Etiam vestibulum pretium risus, in sollicitudin nisl mollis nec. Integer quis turpis vulputate, volutpat ligula nec, dignissim dolor. Suspendisse potenti. Sed eget nunc vitae urna sodales euismod. Vestibulum mollis, metus at gravida malesuada, enim leo pharetra eros, at volutpat sem odio a lacus. Donec rutrum nisl in metus vehicula, in bibendum sapien vestibulum. Donec porttitor nisi risus, ut dignissim sem iaculis eget. Suspendisse condimentum congue ex, sed placerat nibh vehicula vel. Vestibulum aliquam lobortis dapibus. Donec pharetra posuere sapien a fermentum. Duis turpis nibh, viverra vel risus vel, varius blandit dolor. Praesent fringilla, lectus malesuada dapibus pharetra, risus lorem interdum turpis, id efficitur elit quam a eros. Class aptent taciti sociosqu ad litora torquent per conubia nostra, per inceptos himenaeos. Integer eu convallis libero. Aliquam sed enim lorem. Nunc ullamcorper bibendum mauris molestie ullamcorper. In euismod egestas felis. Vivamus interdum iaculis eros eget pretium. Pellentesque habitant morbi tristique senectus et netus et malesuada fames ac turpis egestas. Fusce non metus non urna hendrerit bibendum. Phasellus et viverra ex, ut maximus urna. Sed non justo id dolor mattis placerat eget commodo velit. Donec ut metus lacus. Proin eget eros eget elit bibendum blandit. Cras volutpat accumsan nunc in molestie. Nunc ultrices nibh ut ornare vulputate. Morbi sed efficitur sem.',
                'slug' => 'jump-trick',
                'edited' => '0',
            ],
            12 => [
                'category_id' => '1',
                'author_id' => '1',
                'title' => 'Ollie Midkley',
                'image_card' => '5e87b7ce2ae67ac65eca5b286e48e9659deacbf6.webp',
                'content' => 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Phasellus est diam, tincidunt ac lorem sed, vehicula lobortis ligula. Nullam id scelerisque magna, et cursus arcu. Proin eleifend lacus sit amet bibendum imperdiet. Fusce a iaculis ex, eu euismod nisl. Proin ut fringilla nunc, ac suscipit magna. Curabitur mollis in ipsum vitae ullamcorper. In quis diam ut eros faucibus accumsan in ut est. In nec finibus ex. Etiam vulputate aliquet tortor ac consectetur. Etiam ac tortor aliquet, aliquam lacus efficitur, blandit nisl. Vestibulum in orci ut massa semper ultrices ut et nibh. Sed laoreet cursus libero eget maximus. Integer non lacus cursus tellus porttitor placerat ut sit amet magna. Pellentesque sagittis fringilla massa eget bibendum. Etiam vestibulum pretium risus, in sollicitudin nisl mollis nec. Integer quis turpis vulputate, volutpat ligula nec, dignissim dolor. Suspendisse potenti. Sed eget nunc vitae urna sodales euismod. Vestibulum mollis, metus at gravida malesuada, enim leo pharetra eros, at volutpat sem odio a lacus. Donec rutrum nisl in metus vehicula, in bibendum sapien vestibulum. Donec porttitor nisi risus, ut dignissim sem iaculis eget. Suspendisse condimentum congue ex, sed placerat nibh vehicula vel. Vestibulum aliquam lobortis dapibus. Donec pharetra posuere sapien a fermentum. Duis turpis nibh, viverra vel risus vel, varius blandit dolor. Praesent fringilla, lectus malesuada dapibus pharetra, risus lorem interdum turpis, id efficitur elit quam a eros. Class aptent taciti sociosqu ad litora torquent per conubia nostra, per inceptos himenaeos. Integer eu convallis libero. Aliquam sed enim lorem. Nunc ullamcorper bibendum mauris molestie ullamcorper. In euismod egestas felis. Vivamus interdum iaculis eros eget pretium. Pellentesque habitant morbi tristique senectus et netus et malesuada fames ac turpis egestas. Fusce non metus non urna hendrerit bibendum. Phasellus et viverra ex, ut maximus urna. Sed non justo id dolor mattis placerat eget commodo velit. Donec ut metus lacus. Proin eget eros eget elit bibendum blandit. Cras volutpat accumsan nunc in molestie. Nunc ultrices nibh ut ornare vulputate. Morbi sed efficitur sem.',
                'slug' => 'ollie-midkley',
                'edited' => '0',
            ],
        ];

        foreach ($trick as $key => $value) {
            $trick = new Trick();
            $user = $this->entityManager->getRepository(User::class)->findOneBy(['email' => 'contact@snowtricks.com']);
            $category = $this->entityManager->getRepository(Category::class)->findOneBy(['name' => 'Jump']);;
            $today = new \DateTime('NOW');
            $trick->setCategory($category);
            $trick->setAuthor($user);
            $trick->setTitle($value['title']);
            $trick->setCreatedAt($today);
            $trick->setImageCard($value['image_card']);
            $trick->setContent($value['content']);
            $trick->setSlug($value['slug']);
            $trick->setEdited($value['edited']);
            $manager->persist($trick);
        }

        $manager->flush();

        // PAGES FIXTURE

        $page = [
            1 => [
                'title' => 'Cookie Policy',
                'slug' => 'cookie-policy',
                'content' => '<div>&nbsp;Lorem ipsum dolor sit amet, consectetur adipiscing elit. Cras at tincidunt ante. Pellentesque ultricies, risus non mattis suscipit, quam mauris interdum metus, ut gravida mi odio sit amet felis. Ut sagittis mauris posuere magna tristique, nec varius nisi hendrerit. Nunc iaculis euismod ligula at facilisis. Pellentesque laoreet posuere libero vel rhoncus. Aenean mi dui, ultrices nec ornare nec, vehicula vitae metus. Vivamus a sapien non dolor molestie elementum. Mauris eget fermentum lectus. Nunc eu augue turpis. Lorem ipsum dolor sit amet, consectetur adipiscing elit. Cras at tincidunt ante. Pellentesque ultricies, risus non mattis suscipit, quam mauris interdum metus, ut gravida mi odio sit amet felis. Ut sagittis mauris posuere magna tristique, nec varius nisi hendrerit. Nunc iaculis euismod ligula at facilisis. Pellentesque laoreet posuere libero vel rhoncus. Aenean mi dui, ultrices nec ornare nec, vehicula vitae metus. Vivamus a sapien non dolor molestie elementum. Mauris eget fermentum lectus. Nunc eu augue turpis.&nbsp; Lorem ipsum dolor sit amet, consectetur adipiscing elit. Cras at tincidunt ante. Pellentesque ultricies, risus non mattis suscipit, quam mauris interdum metus, ut gravida mi odio sit amet felis. Ut sagittis mauris posuere magna tristique, nec varius nisi hendrerit. Nunc iaculis euismod ligula at facilisis. Pellentesque laoreet posuere libero vel rhoncus. Aenean mi dui, ultrices nec ornare nec, vehicula vitae metus. Vivamus a sapien non dolor molestie elementum. Mauris eget fermentum lectus. Nunc eu augue turpis.&nbsp; Lorem ipsum dolor sit amet, consectetur adipiscing elit. Cras at tincidunt ante. Pellentesque ultricies, risus non mattis suscipit, quam mauris interdum metus, ut gravida mi odio sit amet felis. Ut sagittis mauris posuere magna tristique, nec varius nisi hendrerit. Nunc iaculis euismod ligula at facilisis. Pellentesque laoreet posuere libero vel rhoncus. Aenean mi dui, ultrices nec ornare nec, vehicula vitae metus. Vivamus a sapien non dolor molestie elementum. Mauris eget fermentum lectus. Nunc eu augue turpis.&nbsp; Lorem ipsum dolor sit amet, consectetur adipiscing elit. Cras at tincidunt ante. Pellentesque ultricies, risus non mattis suscipit, quam mauris interdum metus, ut gravida mi odio sit amet felis. Ut sagittis mauris posuere magna tristique, nec varius nisi hendrerit. Nunc iaculis euismod ligula at facilisis. Pellentesque laoreet posuere libero vel rhoncus. Aenean mi dui, ultrices nec ornare nec, vehicula vitae metus. Vivamus a sapien non dolor molestie elementum. Mauris eget fermentum lectus. Nunc eu augue turpis.&nbsp; Lorem ipsum dolor sit amet, consectetur adipiscing elit. Cras at tincidunt ante. Pellentesque ultricies, risus non mattis suscipit, quam mauris interdum metus, ut gravida mi odio sit amet felis. Ut sagittis mauris posuere magna tristique, nec varius nisi hendrerit. Nunc iaculis euismod ligula at facilisis. Pellentesque laoreet posuere libero vel rhoncus. Aenean mi dui, ultrices nec ornare nec, vehicula vitae metus. Vivamus a sapien non dolor molestie elementum. Mauris eget fermentum lectus. Nunc eu augue turpis.&nbsp;</div>',
            ],
            2 => [
                'title' => 'General Terms And Conditions Of User',
                'slug' => 'general-terms-and-conditions-of-user',
                'content' => '<div>&nbsp;Lorem ipsum dolor sit amet, consectetur adipiscing elit. Cras at tincidunt ante. Pellentesque ultricies, risus non mattis suscipit, quam mauris interdum metus, ut gravida mi odio sit amet felis. Ut sagittis mauris posuere magna tristique, nec varius nisi hendrerit. Nunc iaculis euismod ligula at facilisis. Pellentesque laoreet posuere libero vel rhoncus. Aenean mi dui, ultrices nec ornare nec, vehicula vitae metus. Vivamus a sapien non dolor molestie elementum. Mauris eget fermentum lectus. Nunc eu augue turpis. Lorem ipsum dolor sit amet, consectetur adipiscing elit. Cras at tincidunt ante. Pellentesque ultricies, risus non mattis suscipit, quam mauris interdum metus, ut gravida mi odio sit amet felis. Ut sagittis mauris posuere magna tristique, nec varius nisi hendrerit. Nunc iaculis euismod ligula at facilisis. Pellentesque laoreet posuere libero vel rhoncus. Aenean mi dui, ultrices nec ornare nec, vehicula vitae metus. Vivamus a sapien non dolor molestie elementum. Mauris eget fermentum lectus. Nunc eu augue turpis.&nbsp; Lorem ipsum dolor sit amet, consectetur adipiscing elit. Cras at tincidunt ante. Pellentesque ultricies, risus non mattis suscipit, quam mauris interdum metus, ut gravida mi odio sit amet felis. Ut sagittis mauris posuere magna tristique, nec varius nisi hendrerit. Nunc iaculis euismod ligula at facilisis. Pellentesque laoreet posuere libero vel rhoncus. Aenean mi dui, ultrices nec ornare nec, vehicula vitae metus. Vivamus a sapien non dolor molestie elementum. Mauris eget fermentum lectus. Nunc eu augue turpis.&nbsp; Lorem ipsum dolor sit amet, consectetur adipiscing elit. Cras at tincidunt ante. Pellentesque ultricies, risus non mattis suscipit, quam mauris interdum metus, ut gravida mi odio sit amet felis. Ut sagittis mauris posuere magna tristique, nec varius nisi hendrerit. Nunc iaculis euismod ligula at facilisis. Pellentesque laoreet posuere libero vel rhoncus. Aenean mi dui, ultrices nec ornare nec, vehicula vitae metus. Vivamus a sapien non dolor molestie elementum. Mauris eget fermentum lectus. Nunc eu augue turpis.&nbsp; Lorem ipsum dolor sit amet, consectetur adipiscing elit. Cras at tincidunt ante. Pellentesque ultricies, risus non mattis suscipit, quam mauris interdum metus, ut gravida mi odio sit amet felis. Ut sagittis mauris posuere magna tristique, nec varius nisi hendrerit. Nunc iaculis euismod ligula at facilisis. Pellentesque laoreet posuere libero vel rhoncus. Aenean mi dui, ultrices nec ornare nec, vehicula vitae metus. Vivamus a sapien non dolor molestie elementum. Mauris eget fermentum lectus. Nunc eu augue turpis.&nbsp; Lorem ipsum dolor sit amet, consectetur adipiscing elit. Cras at tincidunt ante. Pellentesque ultricies, risus non mattis suscipit, quam mauris interdum metus, ut gravida mi odio sit amet felis. Ut sagittis mauris posuere magna tristique, nec varius nisi hendrerit. Nunc iaculis euismod ligula at facilisis. Pellentesque laoreet posuere libero vel rhoncus. Aenean mi dui, ultrices nec ornare nec, vehicula vitae metus. Vivamus a sapien non dolor molestie elementum. Mauris eget fermentum lectus. Nunc eu augue turpis.&nbsp;</div>',
            ],
            3 => [
                'title' => 'Privacy Policy',
                'slug' => 'privacy-policy',
                'content' => '<div>&nbsp;Lorem ipsum dolor sit amet, consectetur adipiscing elit. Cras at tincidunt ante. Pellentesque ultricies, risus non mattis suscipit, quam mauris interdum metus, ut gravida mi odio sit amet felis. Ut sagittis mauris posuere magna tristique, nec varius nisi hendrerit. Nunc iaculis euismod ligula at facilisis. Pellentesque laoreet posuere libero vel rhoncus. Aenean mi dui, ultrices nec ornare nec, vehicula vitae metus. Vivamus a sapien non dolor molestie elementum. Mauris eget fermentum lectus. Nunc eu augue turpis. Lorem ipsum dolor sit amet, consectetur adipiscing elit. Cras at tincidunt ante. Pellentesque ultricies, risus non mattis suscipit, quam mauris interdum metus, ut gravida mi odio sit amet felis. Ut sagittis mauris posuere magna tristique, nec varius nisi hendrerit. Nunc iaculis euismod ligula at facilisis. Pellentesque laoreet posuere libero vel rhoncus. Aenean mi dui, ultrices nec ornare nec, vehicula vitae metus. Vivamus a sapien non dolor molestie elementum. Mauris eget fermentum lectus. Nunc eu augue turpis.&nbsp; Lorem ipsum dolor sit amet, consectetur adipiscing elit. Cras at tincidunt ante. Pellentesque ultricies, risus non mattis suscipit, quam mauris interdum metus, ut gravida mi odio sit amet felis. Ut sagittis mauris posuere magna tristique, nec varius nisi hendrerit. Nunc iaculis euismod ligula at facilisis. Pellentesque laoreet posuere libero vel rhoncus. Aenean mi dui, ultrices nec ornare nec, vehicula vitae metus. Vivamus a sapien non dolor molestie elementum. Mauris eget fermentum lectus. Nunc eu augue turpis.&nbsp; Lorem ipsum dolor sit amet, consectetur adipiscing elit. Cras at tincidunt ante. Pellentesque ultricies, risus non mattis suscipit, quam mauris interdum metus, ut gravida mi odio sit amet felis. Ut sagittis mauris posuere magna tristique, nec varius nisi hendrerit. Nunc iaculis euismod ligula at facilisis. Pellentesque laoreet posuere libero vel rhoncus. Aenean mi dui, ultrices nec ornare nec, vehicula vitae metus. Vivamus a sapien non dolor molestie elementum. Mauris eget fermentum lectus. Nunc eu augue turpis.&nbsp; Lorem ipsum dolor sit amet, consectetur adipiscing elit. Cras at tincidunt ante. Pellentesque ultricies, risus non mattis suscipit, quam mauris interdum metus, ut gravida mi odio sit amet felis. Ut sagittis mauris posuere magna tristique, nec varius nisi hendrerit. Nunc iaculis euismod ligula at facilisis. Pellentesque laoreet posuere libero vel rhoncus. Aenean mi dui, ultrices nec ornare nec, vehicula vitae metus. Vivamus a sapien non dolor molestie elementum. Mauris eget fermentum lectus. Nunc eu augue turpis.&nbsp; Lorem ipsum dolor sit amet, consectetur adipiscing elit. Cras at tincidunt ante. Pellentesque ultricies, risus non mattis suscipit, quam mauris interdum metus, ut gravida mi odio sit amet felis. Ut sagittis mauris posuere magna tristique, nec varius nisi hendrerit. Nunc iaculis euismod ligula at facilisis. Pellentesque laoreet posuere libero vel rhoncus. Aenean mi dui, ultrices nec ornare nec, vehicula vitae metus. Vivamus a sapien non dolor molestie elementum. Mauris eget fermentum lectus. Nunc eu augue turpis.&nbsp;</div>',
            ],
            4 => [
                'title' => 'Legal Mentions',
                'slug' => 'legal-mentions',
                'content' => '<div>&nbsp;Lorem ipsum dolor sit amet, consectetur adipiscing elit. Cras at tincidunt ante. Pellentesque ultricies, risus non mattis suscipit, quam mauris interdum metus, ut gravida mi odio sit amet felis. Ut sagittis mauris posuere magna tristique, nec varius nisi hendrerit. Nunc iaculis euismod ligula at facilisis. Pellentesque laoreet posuere libero vel rhoncus. Aenean mi dui, ultrices nec ornare nec, vehicula vitae metus. Vivamus a sapien non dolor molestie elementum. Mauris eget fermentum lectus. Nunc eu augue turpis. Lorem ipsum dolor sit amet, consectetur adipiscing elit. Cras at tincidunt ante. Pellentesque ultricies, risus non mattis suscipit, quam mauris interdum metus, ut gravida mi odio sit amet felis. Ut sagittis mauris posuere magna tristique, nec varius nisi hendrerit. Nunc iaculis euismod ligula at facilisis. Pellentesque laoreet posuere libero vel rhoncus. Aenean mi dui, ultrices nec ornare nec, vehicula vitae metus. Vivamus a sapien non dolor molestie elementum. Mauris eget fermentum lectus. Nunc eu augue turpis.&nbsp; Lorem ipsum dolor sit amet, consectetur adipiscing elit. Cras at tincidunt ante. Pellentesque ultricies, risus non mattis suscipit, quam mauris interdum metus, ut gravida mi odio sit amet felis. Ut sagittis mauris posuere magna tristique, nec varius nisi hendrerit. Nunc iaculis euismod ligula at facilisis. Pellentesque laoreet posuere libero vel rhoncus. Aenean mi dui, ultrices nec ornare nec, vehicula vitae metus. Vivamus a sapien non dolor molestie elementum. Mauris eget fermentum lectus. Nunc eu augue turpis.&nbsp; Lorem ipsum dolor sit amet, consectetur adipiscing elit. Cras at tincidunt ante. Pellentesque ultricies, risus non mattis suscipit, quam mauris interdum metus, ut gravida mi odio sit amet felis. Ut sagittis mauris posuere magna tristique, nec varius nisi hendrerit. Nunc iaculis euismod ligula at facilisis. Pellentesque laoreet posuere libero vel rhoncus. Aenean mi dui, ultrices nec ornare nec, vehicula vitae metus. Vivamus a sapien non dolor molestie elementum. Mauris eget fermentum lectus. Nunc eu augue turpis.&nbsp; Lorem ipsum dolor sit amet, consectetur adipiscing elit. Cras at tincidunt ante. Pellentesque ultricies, risus non mattis suscipit, quam mauris interdum metus, ut gravida mi odio sit amet felis. Ut sagittis mauris posuere magna tristique, nec varius nisi hendrerit. Nunc iaculis euismod ligula at facilisis. Pellentesque laoreet posuere libero vel rhoncus. Aenean mi dui, ultrices nec ornare nec, vehicula vitae metus. Vivamus a sapien non dolor molestie elementum. Mauris eget fermentum lectus. Nunc eu augue turpis.&nbsp; Lorem ipsum dolor sit amet, consectetur adipiscing elit. Cras at tincidunt ante. Pellentesque ultricies, risus non mattis suscipit, quam mauris interdum metus, ut gravida mi odio sit amet felis. Ut sagittis mauris posuere magna tristique, nec varius nisi hendrerit. Nunc iaculis euismod ligula at facilisis. Pellentesque laoreet posuere libero vel rhoncus. Aenean mi dui, ultrices nec ornare nec, vehicula vitae metus. Vivamus a sapien non dolor molestie elementum. Mauris eget fermentum lectus. Nunc eu augue turpis.&nbsp;</div>',
            ],
        ];

        foreach ($page as $key => $value) {
            $page = new Page();
            $page->setTitle($value['title']);
            $page->setSlug($value['slug']);
            $page->setContent($value['content']);
            $manager->persist($page);
        }

        $manager->flush();
    }
}
