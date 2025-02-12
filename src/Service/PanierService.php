<?php
namespace App\Service;

use Symfony\Component\HttpFoundation\Session\SessionInterface;
use Doctrine\ORM\EntityManagerInterface;
use App\Entity\Produit;

class PanierService
{
    protected $entityManager; 

    public function __construct(EntityManagerInterface $entityManager)
    {
        $this->entityManager = $entityManager; 
    }

    ################################################################
    #                   AJOUTER AU PANIER
    #####################################0###########################

    public function add($id, $request)
    {
        $session=$request->getSession();
        $panier = $session->get('panier');
        
        $produit = $this->entityManager->getRepository(Produit::class)->findOneBy(['id' => $id]);

        if ($produit) 
        {
            if (!empty($panier[$id])) 
            {
                $panier[$id]++;
            } 
            else 
            {
                $panier[$id] = 1;
            }
        }
        
        $session->set('panier', $panier);
    }

    ################################################################
    #                   SUPRIMER DU PANIER
    ################################################################

    public function remove($id, $request) 
    {
        $session = $request->getSession();
        $panier = $session->get('panier', []);

        if (isset($panier[$id]))
        {
            unset ($panier[$id]);
        }

        $session->set('panier', $panier);

    }
 
    ################################################################
    #                   DÉCRÉMENTER LA QUANTITÉ
    ################################################################

    public function decrementer($id, $request)
    {
        $session = $request->getSession();
        $panier = $session->get('panier', []);

        if (!empty($panier[$id])) 
        {
            if ($panier[$id] > 1) 
            {
                $panier[$id]--;
                // $this->addFlash('success', 'La quantité du produit a été réduit.');
            } 
            else 
            {
                unset($panier[$id]);
            }
        }
        $session->set('panier', $panier);
        
    }

    ################################################################
    #                   INCRÉMENTER LA QUANTITÉ
    ################################################################

    public function incrementer($id, $request)
    {
        $session = $request->getSession();
        $panier = $session->get('panier', []);

        if (!empty($panier[$id])) 
        {
            $panier[$id]++;
            // $this->addFlash('success', 'La quantité du produit a été augmentée.');

        }    
      
        $session->set('panier', $panier);

    }

    ################################################################
    #                             TOTAL
    ################################################################

    // public function Total() : float 
    // {
    //     $session = $request->getSession();
    //     $panier = $session->get('panier', []);

    //     $total = 0;
    //     $produits = [];  
    
    //     foreach ($panier as $id => $quantity) 
    //     {
    //         $produit = $entityManager->getRepository(Produit::class)->find($id);

    //         if ($produit) 
    //         {
    //             $total += $produit->getProduitPrixHt() * $quantity;
                
    //             $produits[] = 
    //             [
    //                 'produit' => $produit,
    //                 'quantite' => $quantity
    //             ];
    //         }
    // }

    // public function fullPanier() : array {}
    
}
