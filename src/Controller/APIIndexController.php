<?php

namespace GlpiPlugin\API\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\Routing\Annotation\Route;

class APIIndexController extends AbstractController {

   /**
    * Returns a list of available API versions.
    * This endpoint should be publicly viewable so clients can determine which API version they will use for retrieving a session token.
    * @Route("/", name="index")
    * @since 1.0.0
    * @return Response
    */
   public function index(): Response
   {
      return new JsonResponse([
         [
            // Legacy API. This will use a shim controller to redirect requests to the old API system.
            'apiVersion' => 1,
            'version'    => '1.0.0',
            'endpoint'   => 'v1',
         ],
         [
            // First "modern" REST API version
            'apiVersion' => 2,
            'version'    => '2.0.0',
            'endpoint'   => 'v2',
         ],
      ]);
   }
}