<?php

namespace App\Controller;

use App\Entity\Arabe;
use App\Form\ArabeType;
use App\Repository\ArabeRepository;
use App\Repository\FrancaisRepository;
use Doctrine\ORM\EntityManagerInterface;
use Doctrine\Persistence\ManagerRegistry;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;
use Doctrine\DBAL\Connection;

#[Route('/arabe')]
class ArabeController extends AbstractController
{
    private $connection;
    public function __construct(Connection $connection)
    {
        $this->connection = $connection;
    }
    #[Route('/', name: 'app_arabe_index', methods: ['GET'])]
    public function index(ArabeRepository $arabeRepository, FrancaisRepository $francaisRepository): Response
    {
        $arabe = [];
        $entityArabeXFrance = [];
        $sql = "SELECT * FROM `arabe_francais`";
        $result = $this->connection->executeQuery($sql)->fetchAll();
        if (count($result) != 0) {
            for ($i = 0; $i < count($result); $i++) {
                $idFrancais = $result[$i]["francais_id"];
                $idArabe = $result[$i]["arabe_id"];

                $entityArabe = $arabeRepository->find($idArabe);
                $entityFrancais = $francaisRepository->find($idFrancais);
                $fr = $entityFrancais->getMot();

                $Fonctions = [$entityArabe->getId(), $entityArabe->getClasse(), $entityArabe->getMot(), $entityArabe->getImage(), $fr];
                $cles = ["id", "classe", "mot", "image", "francais"];

                for ($j = 0; $j < count($Fonctions); $j++) {
                    $entityArabeXFrance += [$cles[$j] => $Fonctions[$j]];
                }
                array_push($arabe, $entityArabeXFrance);
                $entityArabeXFrance = [];
            }
            $sql2 = "SELECT * FROM `arabe` WHERE ";

            for ($k = 0; $k < count($arabe); $k++) {
                if ($k == count($arabe) - 1) {
                    $sql2 .= " id != " . $arabe[$k]["id"];
                 } else {
                    $sql2 .= " id != " . $arabe[$k]["id"] . " AND";
                }
            }
            $resultASansF = $this->connection->executeQuery($sql2)->fetchAll();
            if (count($resultASansF) != 0) {
                for ($k = 0; $k < count($resultASansF); $k++) {
                    $entityArabeSFFinal = [];
                    $entityArabeSF = $arabeRepository->find($resultASansF[$k]["id"]);
                    $FonctionsADF = [$entityArabeSF->getId(), $entityArabeSF->getClasse(), $entityArabeSF->getMot(), $entityArabeSF->getImage(), NULL];
                    $cles = ["id", "classe", "mot", "image", "francais"];
                    for ($l = 0; $l < count($FonctionsADF); $l++) {
                        $entityArabeSFFinal += [$cles[$l] => $FonctionsADF[$l]];
                    }
                    array_push($arabe, $entityArabeSFFinal);
                    $entityArabeSFFinal = [];
                }
            }
        }
        return $this->render('arabe/index.html.twig', [
            'arabes' => $arabe,
        ]);
    }

    #[Route('/new', name: 'app_arabe_new', methods: ['GET', 'POST'])]
    public function new(Request $request,FrancaisRepository $francaisRepository,  EntityManagerInterface $entityManager): Response
    {
        $arabe = new Arabe();
        $form = $this->createForm(ArabeType::class, $arabe);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {   
  
        $entityManager->persist($arabe);
            $entityManager->flush();  

            return $this->redirectToRoute('app_arabe_index', [], Response::HTTP_SEE_OTHER);
        } else {
            // dump($form);
        }

        return $this->render('arabe/new.html.twig', [
            'arabe' => $arabe,
            'form' => $form,
        ]);
    }

    #[Route('/{id}', name: 'app_arabe_show', methods: ['GET'])]
    public function show(Arabe $arabe): Response
    {
        return $this->render('arabe/show.html.twig', [
            'arabe' => $arabe,
        ]);
    }

    #[Route('/{id}/edit', name: 'app_arabe_edit', methods: ['GET', 'POST'])]
    public function edit(Request $request, Arabe $arabe, EntityManagerInterface $entityManager): Response
    {
        $form = $this->createForm(ArabeType::class, $arabe);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager->flush();

            return $this->redirectToRoute('app_arabe_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->render('arabe/edit.html.twig', [
            'arabe' => $arabe,
            'form' => $form,
        ]);
    }

    #[Route('/{id}/delete', name: 'app_arabe_delete', methods: ['POST', 'GET'])]
    public function delete(Request $request, Arabe $arabe, ManagerRegistry $doctrine): Response
    {
            $entityManager = $doctrine->getManager();
            $entityManager->remove($arabe);
            $entityManager->flush();
        return $this->redirectToRoute('app_arabe_index', [], Response::HTTP_SEE_OTHER);
    }
}