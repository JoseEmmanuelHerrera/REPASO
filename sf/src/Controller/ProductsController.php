<?php

namespace App\Controller;

header('Access-Control-Allow-Origin: *');
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

// Json response
use Symfony\Component\HttpFoundation\JsonResponse;

class ProductsController extends AbstractController{

    public function findAllProducts(){
        
        $em = $this->getDoctrine()->getManager();

        $query = $em->createQuery('SELECT p.idproduct, p.name, p.price, p.status FROM App:Products p');
        $listProducts = $query->getResult();
        $data = [
            'status'=> 200,
            'message'=> 'Hola! NO se ha encontraron '
        ];
        if (count($listProducts)>0){
            $data =[
                'status'=> 200,
                'message'=> 'Hola! Se encontraron '.count($listProducts) .'Resultados',
                'listProducts' => $listProducts   
            ];
        }
        return new JsonResponse($data);
    }
}
