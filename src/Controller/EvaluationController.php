<?php

namespace App\Controller;

use App\Form\FilterType;
use App\Repository\ArabeRepository;
use App\Repository\FrancaisRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;
use Doctrine\DBAL\Connection;
use Symfony\Component\HttpFoundation\Request;

class EvaluationController extends AbstractController
{
    private $connection;
    public function __construct(Connection $connection)
    {
        $this->connection = $connection;
    }
    #[Route('/evaluation', name: 'app_evaluation')]
    public function index(Request $request, FrancaisRepository $francaisRepository, ArabeRepository $arabeRepository): Response
    {
        $sql = "SELECT * FROM `arabe_francais` ORDER BY RAND() LIMIT 25";
        $results = $this->connection->executeQuery($sql)->fetchAll();
        $interro = [];
        $question = [];
        for ($i=0; $i < count($results); $i++) { 
            $entityFrancais = $francaisRepository->find($results[$i]["francais_id"]);
            $entityArabe = $arabeRepository->find($results[$i]["arabe_id"]);
            $question += ["francais" => $entityFrancais->getMot(), "arabe" => $entityArabe->getMot()];
            array_push($interro, $question);
            $question = [];
        }
        $form = $this->createForm(FilterType::class);
        dump($form);
        $recoit = $request->query->get("recoit");
        if ($recoit == "francais") {
            for ($j=0; $j < count($interro); $j++) { 
                $interro[$j]["arabe"] = NULL;
            }
        } else if($recoit == "arabe"){
            for ($k=0; $k < count($interro); $k++) { 
                $interro[$k]["francais"] = NULL;
            }
        }
        
        return $this->render('evaluation/index.html.twig', [
            'interro' => $interro,
            'form' => $form
        ]);
    }
    // #[Route('/evaluation/francais')]
    // public function onlyfrench(Request $request) :Response
    // {
    //     for ($i=0; $i < count($interro); $i++) { 
    //         $interro[$i] = $interro[$i]["francais"];
    //     }
    //     return $this->redirectToRoute('app_evaluation');
    // }
}

