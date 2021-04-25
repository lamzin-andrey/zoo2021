<?php

namespace App\Controller;

use App\Entity\AnimalType;
use App\Entity\CageAnimalsRelation;
use App\Entity\EmptyCage;
use App\Entity\LionCage;
use App\Service\Fabric\CageCreator\EmptyCageCreator;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class CageAnimalsController extends AbstractController
{
    /**
     * @Route("/", name="default")
     */
    public function index()
    {
        return $this->render('cageanimals/index.html.twig', [
            'controller_name' => 'DefaultController',
        ]);
    }

    /**
     * @Route("/list", name="list")
     */
    public function listAction(Request $request)
    {
        // выбираем все пустые клетки
        $emptyCagesRepository = $this->getDoctrine()->getRepository(EmptyCage::class);
        $emptyCages = $emptyCagesRepository->findAll();
        // выбираем все непустые клетки
        $cageAnimalsRepository = $this->getDoctrine()->getRepository(CageAnimalsRelation::class);
        $busyCages = $cageAnimalsRepository->findCages();

        $list = [];
        foreach ($emptyCages as $cage) {
            $item = [
                'id' =>  $cage->getId(),
                'name' =>  $cage->getName(),
                'image' => '/images/empty_cage.png',
                'type' => 'empty'
            ];
            $list[] = $item;
        }

        foreach ($busyCages as $cageInfo) {
            /** @var CageAnimalsRelation $cageInfo */
            /** @var LionCage $cage */
            $cage = $cageInfo->getCage();
            $animals = $cage->getAnimals();

            $type = 'empty';
            $image = '';
            if ($animals) {
                $className = get_class($animals[0]);
                $type = $className::ANIMAL_TYPE;
                $image = $className::ANIMAL_IMAGE;
            }


            $item = [
                'id' =>  $cageInfo->getId(),
                'name' =>  $cage->getName(),
                'image' => $image,
                'quantity' => count($animals),
                'type'    => $type
            ];
            $list[] = $item;
        }

        $response = new Response(json_encode([
            'status' => 'ok',
            'cages' => $list
        ]));

        $response->headers->set('Content-Type', 'application/json');
        return $response;
    }

    /**
     * Route("/addlion", name="addLion")
    */
    /*public function addLionAction(Request $request, LionCreator $lionCreator, LionCageCreator $cageCreator)
    {
        return $this->addAnimal($request, $lionCreator, $cageCreator);

    }*/

    /**
     *
    */
    protected function addAnimal(Request $request, Creator $animalCreator, Creator $cageCreator)
    {
        $animal = $animalCreator->factoryMethod();
        $type   = $request->request->get('type');
        $cageId = $request->request->get('cageId');

        if ('empty' === $type) {
            $cage = $cageCreator->factoryMethod();
            $emptyCage = $this->getDoctrine()->getRepository(EmptyCage::class)->find($cageId);
            if (!is_null($emptyCage)) {
                $entityManager = $this->getDoctrine()->getManager();
                $entityManager->remove($emptyCage);
                $entityManager->flush();
            }
        } else {
            // $cageId is CageAnimalsRelation.id
            $cageAnimalsRepository = $this->getDoctrine()->getRepository(CageAnimalsRelation::class);
            /**
             * @var CageAnimalsRelation $cageAnimalData
            */
            $cageAnimalData = $cageAnimalsRepository->find($cageId);
            $cage = $cageAnimalData->getCage();// TODO method by cage_id
        }
        // $cage->add($animal);
        $cageAnimalData = new CageAnimalsRelation();
        $cageAnimalData->setAnimal($animal); // TODO method
        $cageAnimalData->setCageId($cage->getId());
        $animalTypeRepository = $this->getDoctrine()->getRepository(AnimalType::class);
        $className = get_class($animal);
        $animalType = $animalTypeRepository->findTypeByClassName($className);//TODO method
        $cageAnimalData->setAnimalTypeId($animalType);

        $type = $className::ANIMAL_TYPE;
        $image = $className::ANIMAL_IMAGE;


        $response = new Response(json_encode([
            'status' => 'ok',
            'type'   => $type,
            'cage' => [
                'id' =>  $cageAnimalData->getId(),
                'name' =>  $cage->getName(),
                'image' => $image
            ]
        ]) );

        $response->headers->set('Content-Type', 'application/json');
        return $response;
    }

    /**
     * @Route("/addcage", name="addCage")
     */
    public function addCageAction(Request $request, EmptyCageCreator $creator)
    {
        /**
         * @var EmptyCage $cage
        */
        $cage = $creator->factoryMethod();

        $response = new Response(json_encode([
            'status' => 'ok',
            'cage' => [
                'id' =>  $cage->getId(),
                'name' =>  $cage->getName(),
                'image' => '/images/empty_cage.png'
            ]
        ]) );

        $response->headers->set('Content-Type', 'application/json');
        return $response;
    }
}
