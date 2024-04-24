<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;
use Exception;
use MongoDB\Client;
use App\Document\Avis;
use Doctrine\ODM\MongoDB\DocumentManager;

class MongoDBController extends AbstractController
{
    private $uri = 'mongodb+srv://hichemdjacta:hichemgarage123321@galaxygarageparis.qskdsk3.mongodb.net/?retryWrites=true&w=majority&appName=galaxyGarageParis';
    
    #[Route('/mongo/d/b', name: 'app_mongo_d_b')]
    public function index(): Response
    {
        // Replace the placeholder with your Atlas connection string

        $client = new Client($this->uri);
        $message = '';

        try {
            // Send a ping to confirm a successful connection
            $client->selectDatabase('admin')->command(['ping' => 1]);
            echo "Pinged your deployment. You successfully connected to MongoDB!\n";
            $message = 'Pinged your deployment. You successfully connected to MongoDB!';
        } catch (Exception $e) {
            printf($e->getMessage());
        }

        return $this->render('mongo_db/index.html.twig');
    }

        private $documentManager;

        public function __construct(DocumentManager $documentManager)
        {
            $this->documentManager = $documentManager;
        }

        // src/Controller/AvisController.php

        public function createAvisAction()
        {
            $avis = new Avis();
            $avis->setTitre('Super produit!');
            $avis->setContenu('J\'ai adoré ce produit. Il est de grande qualité et répond parfaitement à mes besoins.');
            $avis->setNote(5);
            $avis->setAuteur('John Doe');
            $avis->setDateCreation(new \DateTime());

            $this->documentManager->persist($avis);
            $this->documentManager->flush();

            // Success message or redirect to view the created avis
        }

        public function getAllAvisAction()
        {
            $avisRepository = $this->documentManager->getRepository(Avis::class);
            $avis = $avisRepository->findAll();

            // Display or process the retrieved avis documents
        }

        public function updateAvisAction($id)
        {
            $avisRepository = $this->documentManager->getRepository(Avis::class);
            $avis = $avisRepository->find($id);

            if (!$avis) {
                // Handle avis not found error
                return;
            }

            $avis->setTitre('Titre mis à jour');
            $avis->setContenu('Contenu mis à jour');

            $this->documentManager->persist($avis);
            $this->documentManager->flush();

            // Success message or redirect to view the updated avis
        }

        public function deleteAvisAction($id)
        {
            $avisRepository = $this->documentManager->getRepository(Avis::class);
            $avis = $avisRepository->find($id);

            if (!$avis) {
                // Handle avis not found error
                return;
            }

            $this->documentManager->remove($avis);
            $this->documentManager->flush();

            // Success message or redirect to the avis list
        }
}
