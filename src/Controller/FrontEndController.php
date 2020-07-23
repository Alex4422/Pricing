<?php

namespace App\Controller;

use App\Entity\ProductForSale;
use App\Form\ProductForSaleType;
use App\Repository\ProductForSaleRepository;
use Doctrine\ORM\EntityManagerInterface;
use Doctrine\Persistence\ObjectManager;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;

class FrontEndController extends AbstractController
{

    /**
     * @Route("/search", name="search")
     */
    public function search(Request $req, ProductForSaleRepository $rep)
    {
        // Récupère produit recherché en mode old-school (sans FormType)
        $search = $req->query->get('search');

        $qb = $rep->createQueryBuilder("pfs")
            ->join("pfs.product", "p")
            ->where("p.name LIKE :SEARCH")
            ->setParameter("SEARCH", '%'.$search.'%')
            ->join("pfs.state", "s")
            ->orderBy("p.id")
            ->addOrderBy("s.rank", "DESC")
            ->addOrderBy("pfs.prixMax");

        $productsForSale = $qb->getQuery()->getResult();
        dump($productsForSale);

        // Renvoyer les données récupéréés vers la vue
        return $this->render("front_end/search.html.twig", ["resultats"=>$productsForSale]);
    }

    /**
     * @Route("/sell", name="sell")
     */
    public function sell(Request $req, EntityManagerInterface $em, ProductForSaleRepository $rep)
    {
        $dto = new ProductForSale();
        $monForm = $this->createForm(ProductForSaleType::class, $dto);
        $monForm->remove("user");
        $monForm->add("Sell", SubmitType::class);

        $monForm->handleRequest($req);
        if( $monForm->isSubmitted() && $monForm->isValid() ){

            // Détermine prix de vente ( prixMax ) : c'est la stratégie de l'algo demandé
            $prix = $rep->prixMaxMiniPourEtatEgal($dto->getProduct()->getId(), $dto->getState()->getId());
            if( $prix==null ){
                $prix = $rep->prixMaxMiniPourEtatSuperieur($dto->getProduct()->getId(), $dto->getState()->getRank());
                if( $prix==null ){
                    $prix = $dto->getPrixMax();
                }else{
                    $prix -= 1;
                }
            }else{
                $prix -= 0.01;
            }
            if( $prix<$dto->getPrixPlancher() ){
                $prix=$dto->getPrixPlancher();
            }

            $dto->setPrixMax($prix);

            $dto->setUser( $this->getUser() );
            $em->persist($dto);
            $em->flush();

            return $this->redirectToRoute('welcome');
        }

        return $this->render("front_end/sell.html.twig", ["formulaire"=>$monForm->createView()]);
    }
    /**
     * @Route("/welcome", name="welcome")
     */
    public function index()
    {
        return $this->render('front_end/welcome.html.twig');
    }
}
