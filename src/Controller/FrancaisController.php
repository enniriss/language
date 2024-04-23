<?php

namespace App\Controller;

use App\Entity\Francais;
use App\Entity\Japonais;
use App\Form\FrancaisType;
use App\Repository\ArabeRepository;
use App\Repository\FrancaisRepository;
use App\Repository\JaponaisRepository;
use Doctrine\ORM\EntityManagerInterface;
use mysqli;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;
use Doctrine\DBAL\Connection;


#[Route('/francais')]
class FrancaisController extends AbstractController
{
    private $connection;
    public function __construct(Connection $connection)
    {
        $this->connection = $connection;
    }
    #[Route('/', name: 'app_francais_index', methods: ['GET'])]
    public function index(FrancaisRepository $francaisRepository, JaponaisRepository $japonaisRepository, ArabeRepository $arabeRepository, Connection $connection): Response
    {
        $francais = [];
        $entityFrancaisFinal = [];
        $sql = "SELECT * FROM `arabe_francais` JOIN `japonais_francais` ON arabe_francais.francais_id = japonais_francais.francais_id";
        $resultsArabeXJapon = $this->connection->executeQuery($sql)->fetchAll();
        
        if (count($resultsArabeXJapon) != 0) {
            for ($i = 0; $i < count($resultsArabeXJapon); $i++) {
                $idFrancais = $resultsArabeXJapon[$i]["francais_id"];
                $idJaponais = $resultsArabeXJapon[$i]["japonais_id"];
                $idArabe = $resultsArabeXJapon[$i]["arabe_id"];
                $entityFrancais = $francaisRepository->find($idFrancais);
                $entityJaponais = $japonaisRepository->find($idJaponais);
                $entityArabe = $arabeRepository->find($idArabe);
                $jap = $entityJaponais->getMot();
                $ar = $entityArabe->getMot();
                $Fonctions = [$entityFrancais->getId(), $entityFrancais->getMot(), $entityFrancais->getClasse(), $entityFrancais->getImage(), $jap, $ar];
                $cles = ["id", "mot", "classe", "image", "japon", "arabe"];
                for ($j = 0; $j < count($Fonctions); $j++) {
                    $entityFrancaisFinal += [$cles[$j] => $Fonctions[$j]];
                }
                array_push($francais, $entityFrancaisFinal);
            }

            $sql2 = "SELECT * FROM `japonais_francais` WHERE";
            for ($k=0; $k < count($resultsArabeXJapon); $k++) { 
                if ($k == count($resultsArabeXJapon) - 1) {
                    $sql2 .= " francais_id != " . $resultsArabeXJapon[$k]["francais_id"];
                } else {
                    $sql2 .= " francais_id != " . $resultsArabeXJapon[$k]["francais_id"] . " AND";
                }
            }
            $resultsJapon = $this->connection->executeQuery($sql2)->fetchAll();
            dump(count($resultsJapon));
            if (count($resultsJapon) != 0) {
                for ($l=0; $l < count($resultsJapon); $l++) { 
                    $entityFrancaisSansJaponFinal = [];
                    $entityFrancaisSansJapon = $francaisRepository->find($resultsJapon[$l]["francais_id"]);
                    $entityFrancaisJaponais = $japonaisRepository->find($resultsJapon[$l]["japonais_id"]);
                    $FonctionsSansJapon = [$entityFrancaisSansJapon->getId(), $entityFrancaisSansJapon->getMot(), $entityFrancaisSansJapon->getClasse(), $entityFrancaisSansJapon->getImage(), $entityFrancaisJaponais->getMot(), NULL];
                    $clesSansJapon = ["id", "mot", "classe", "image", "japon", "arabe"];
                    for ($m=0; $m < count($FonctionsSansJapon); $m++) { 
                        $entityFrancaisSansJaponFinal += [$clesSansJapon[$m] => $FonctionsSansJapon[$m]];
                    }
                    array_push($francais, $entityFrancaisSansJaponFinal);                    
                }
            }

            $sql3 = "SELECT * FROM `arabe_francais` WHERE";
            for ($n=0; $n < count($resultsArabeXJapon); $n++) { 
                if ($n == count($resultsArabeXJapon) - 1) {
                    $sql3 .= " francais_id != " . $resultsArabeXJapon[$n]["francais_id"];
                } else {
                    $sql3 .= " francais_id != " . $resultsArabeXJapon[$n]["francais_id"] . " AND";
                }
            }
            $resultsArabe = $this->connection->executeQuery($sql3)->fetchAll();
            if (count($resultsArabe)) {
                for ($o=0; $o < count($resultsArabe); $o++) {
                    $entityFrancaisSansArabeFinal = [];
                    $entityFrancaisSansArabe = $francaisRepository->find($resultsArabe[$o]["francais_id"]);
                    $entityFrancaisArabe = $arabeRepository->find($resultsArabe[$o]["arabe_id"]);
                    $FonctionsSansArabe = [$entityFrancaisSansArabe->getId(), $entityFrancaisSansArabe->getMot(), $entityFrancaisSansArabe->getClasse(), $entityFrancaisSansArabe->getImage(), $entityFrancaisArabe->getMot(), NULL];
                    $clesSansArabe = ["id", "mot", "classe", "image", "arabe", "japon"];
                    for ($p=0; $p < count($FonctionsSansArabe); $p++) { 
                        $entityFrancaisSansArabeFinal += [$clesSansArabe[$p] => $FonctionsSansArabe[$p]];
                    }
                    array_push($francais, $entityFrancaisSansArabeFinal);                    


                }
            }

            $sql4 = "SELECT * FROM `francais` WHERE";
            for ($q=0; $q < count($francais); $q++) { 
                if ($q == count($francais) - 1) {
                    $sql4 .= " id != " . $francais[$q]["id"];
                } else {
                    $sql4 .= " id != " . $francais[$q]["id"] . " AND";
                }
            }
            dump($sql4);
            $resultsFrancais = $this->connection->executeQuery($sql4)->fetchAll();
            for ($r=0; $r < count($resultsFrancais); $r++) { 
                $resultsFrancais[$r] += ["japon" => NULL, "arabe" => NULL];
                array_push($francais, $resultsFrancais[$r]);
            }

            dump($francais);
            
            }
        return $this->render('francais/index.html.twig', [
            'francais' => $francais,
        ]);
}

    #[Route('/new', name: 'app_francais_new', methods: ['GET', 'POST'])]
    public function new(Request $request, EntityManagerInterface $entityManager): Response
    {
        $francai = new Francais();
        $form = $this->createForm(FrancaisType::class, $francai);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager->persist($francai);
            $entityManager->flush();

            return $this->redirectToRoute('app_francais_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->render('francais/new.html.twig', [
            'francai' => $francai,
            'form' => $form,
        ]);
    }

    #[Route('/{id}', name: 'app_francais_show', methods: ['GET'])]
    public function show(Francais $francai): Response
    {
        return $this->render('francais/show.html.twig', [
            'francai' => $francai,
        ]);
    }

    #[Route('/{id}/edit', name: 'app_francais_edit', methods: ['GET', 'POST'])]
    public function edit(Request $request, Francais $francai, EntityManagerInterface $entityManager): Response
    {
        $form = $this->createForm(FrancaisType::class, $francai);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager->flush();

            return $this->redirectToRoute('app_francais_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->render('francais/edit.html.twig', [
            'francai' => $francai,
            'form' => $form,
        ]);
    }

    #[Route('/{id}/delete', name: 'app_francais_delete', methods: ['POST'])]
    public function delete(Request $request, Francais $francai, EntityManagerInterface $entityManager): Response
    {
        if ($this->isCsrfTokenValid('delete' . $francai->getId(), $request->request->get('_token'))) {
            $entityManager->remove($francai);
            $entityManager->flush();
        }

        return $this->redirectToRoute('app_francais_index', [], Response::HTTP_SEE_OTHER);
    }
}
