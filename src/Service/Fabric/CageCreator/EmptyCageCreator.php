<?php

namespace App\Service\Fabric\CageCreator;

use App\Entity\EmptyCage;
use Symfony\Component\DependencyInjection\ContainerInterface;
use App\Service\Fabric\CageCreator\Creator;

class EmptyCageCreator implements Creator
{
    /*
     * ContainerInterface $container
    */
    protected $container;

    public function __construct(ContainerInterface $container)
    {
        $this->container = $container;
    }

    /**
     *
     * @param $
     * @return  
    */
    public function factoryMethod() : \App\Entity\EmptyCage
    {
        $emptyCage = new EmptyCage();
        $entityManager = $this->container->get('doctrine')->getManager();
        $entityManager->persist($emptyCage);
        $entityManager->flush();

        return $emptyCage;
    }
}