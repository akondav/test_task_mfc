<?php

namespace App\Controller;

use App\Entity\QueryMfc;
use App\Entity\StatusMfc;
use App\Entity\ChangesMfc;
use App\Entity\ImagesMfc;
use App\Form\ItemAddType;
use App\Form\ItemChangeType;
use App\Service\FileUploader;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;


class QueryController extends AbstractController
{
    /**
     * @Route("/", name="query")
     */
    public function index(): Response
    {
        $em = $this->getDoctrine()->getManager();
        
        $querys = $em->getRepository(QueryMfc::class)->findBy([], ['id' => 'DESC']);
        return $this->render('query/index.html.twig', [
            'querys' => $querys,
            'controller_name' => 'QueryController'
        ]);

    }

    /**
     * @Route("/table-index", name="table_index", methods={"POST"})
     */
    public function tableIndex()
    {
    $em = $this->getDoctrine()->getManager();
    $querys = $em->getRepository(QueryMfc::class)->findBy([], ['id' => 'DESC']);
    $newTable = $this->render('query/_table_index.html.twig', [
        'querys' => $querys,
        'controller_name' => 'QueryController'
    ]);
    return new Response($newTable);
    }


    /**
     * @Route("/query/create", name="create_query")
     */
    public function create(Request $request, FileUploader $fileUploader)
    {
        $query = new QueryMfc();

        $form = $this->createForm(ItemAddType::class, $query);

        $form->handleRequest($request);
 
        if ($form->isSubmitted() && $form->isValid()) {

            $imageFile = $form->get('image')->getData();
            foreach ($imageFile as $imgFile) {
                if ($imgFile) {
                    $imageFileName = $fileUploader->upload($imgFile);
                    $images = new ImagesMfc();
                    $images->setRefImage($imageFileName);
                    $query->addImage($images);
                }
            }
            $query = $form->getData();
            $query->setDateCreate(new \DateTime('now'));

            $em = $this->getDoctrine()->getManager();

            $status = $em->find(StatusMfc::class, 1);
            $query->setStatus($status);
    
            $em->persist($query);
            if ($imageFile) {
                $em->persist($images);
            }
            $em->flush();

            return $this->redirectToRoute('query');
        }

        return $this->render('query/add.html.twig', [
            'form' => $form->createView()
        ]);
    }

    /**
     * @Route("/query/update/{query}", name="update_query")
     */
    public function update(Request $request, QueryMfc $query)
    {
        $form = $this->createForm(ItemChangeType::class, $query, [
            'action' => $this->generateUrl('update_query', [
                'query' => $query->getId()
            ]),
            'method' => 'POST',
        ]);

        $em = $this->getDoctrine()->getManager();
        $changesquery = $em->getRepository(ChangesMfc::class)->findBy(['query' => $query->getId()]);
        $imagesquery = $em->getRepository(ImagesMfc::class)->findBy(['query' => $query->getId()]);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $query = $form->getData();
            $query->setDateLastChange(new \DateTime('now'));
            
            $changes = new ChangesMfc();
            $changes->setOldstatus($query->getStatus()->getStatus());
            $changes->setDateChange(new \DateTime('now'));
            $changes->setQuery($query);

            $em->persist($changes);
            $em->flush();

            return $this->redirectToRoute('query');
        }

        return $this->render('query/change.html.twig', [
            'form' => $form->createView(),
            'query' => $query,
            'changesquery' => $changesquery,
            'imagesquery' => $imagesquery
        ]);
    }

}
