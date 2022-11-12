<?php
namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

use App\Entity\Benutzer;
use App\Entity\Projekt;
use App\Form\ProjektFormType;
use App\Repository\ProjektRepository;
use Doctrine\ORM\EntityManagerInterface;
use Doctrine\Persistence\ManagerRegistry;
use Symfony\Component\HttpFoundation\File\Exception\FileException;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class IndexController extends AbstractController
{
    private $em;
    private $projektRepository;
    public function __construct (EntityManagerInterface $em, ProjektRepository $projektRepository)
    {
        $this->projektRepository=$projektRepository;
        $this->em=$em;
    }
    
    #[Route('/projekte', methods:['GET'], name:'projekte')]
    public function index(): Response
    { 
        //findAll() - SELECT * FROM BENUTZER;
        //find(15) - SELECT * FROM BENUTZER WHERE ID=15;
        //findBy([],['id'=>'DESC') - SELECT * from benutzer ORDER BY id DESC;
        //findOneBy(['id'=>15,'ben_name'=>'dyar'], ['id'=>'DESC']) - SELECt * from benutzer where id=15 and 
        //ben_name=dyar order by id DESC
        //count(['id'=>15]) - Select count() from benutzer where id=15

        $projekte = $this->projektRepository->findAll();
       return $this->render('projects/index.html.twig', [
        'projekte' => $projekte]);
    }

    #[Route('/projekte/create', name:'create')]
    public function create(Request $request): Response
    { 
        $projekt= new Projekt;
        $form =$this->createForm(ProjektFormType::class,$projekt);

        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()) {
            $newprojekt = $form->getData();
            
            $imagePath= $form->get('bild_path')->getData();
            if ($imagePath) {
                $newFileName = uniqid() . '.' . $imagePath->guessExtension();

                try {
                    $imagePath->move(
                        $this->getParameter('kernel.project_dir') . '/public/build/Images',
                        $newFileName
                    );
                } catch (FileException $e) {
                    return new Response($e->getMessage());
                }
                
                $newprojekt->setBildPath('build/Images/'.$newFileName);

            }
            $this->em->persist($newprojekt);
            $this->em->flush();

            return $this->redirectToRoute('projekte');
        }
        


        return $this->render('projects/creat.html.twig',[
            'form'=>$form->createView()
        ]);
    }
    #[Route('/projekte/edit/{id}', name: 'projekt-bearbeiten')]
    public function edit($id):Response
    {
        $projekt = $this->projektRepository->find($id);

        $form = $this->createForm(ProjektFormType::class, $projekt);
        
        return $this->render('projects/edit.html.twig',[
            'projekt'=>$projekt,
            'form'=>$form->createView()
        ]);
       /* $form->handleRequest($request);
        $imagePath = $form->get('imagePath')->getData();

        if ($form->isSubmitted() && $form->isValid()) {
            if ($imagePath) {
                if ($movie->getImagePath() !== null) {
                    if (file_exists(
                        $this->getParameter('kernel.project_dir') . $movie->getImagePath()
                        )) {
                            $this->GetParameter('kernel.project_dir') . $movie->getImagePath();
                    }
                    $newFileName = uniqid() . '.' . $imagePath->guessExtension();

                    try {
                        $imagePath->move(
                            $this->getParameter('kernel.project_dir') . '/public/uploads',
                            $newFileName
                        );
                    } catch (FileException $e) {
                        return new Response($e->getMessage());
                    }

                    $movie->setImagePath('/uploads/' . $newFileName);
                    $this->em->flush();

                    return $this->redirectToRoute('movies');
                }
            } else {
                $movie->setTitle($form->get('title')->getData());
                $movie->setReleaseYear($form->get('releaseYear')->getData());
                $movie->setDescription($form->get('description')->getData());

                $this->em->flush();
                return $this->redirectToRoute('movies');
            }
        }

        return $this->render('movies/edit.html.twig', [
            'movie' => $movie,
            'form' => $form->createView()
        ]);*/
    }

    #[Route('/projekte/{id}', name:'projekt')]
    public function show($id): Response
    { 
        $projekt = $this->projektRepository->find($id);
       return $this->render('projects/show.html.twig', [
        'projekt' => $projekt]);
    }

   
}