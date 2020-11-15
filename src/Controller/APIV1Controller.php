<?php

namespace GlpiPlugin\API\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\RedirectResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

/**
 * API v1 controller shim. This redirects all requests from the v1 endpoint to the old ApiRest entrypoint.
 * @Route("/v1", name="apiv1_")
 */
class APIV1Controller extends AbstractController {

   /**
    * Redirect to old ApiRest entrypoint
    * @Route("/{endpoint}", name="index", requirements={"endpoint": ".*"})
    * @param Request $request
    * @return Response
    * @since 1.0.0
    */
   public function index(Request $request): Response
   {
      global $CFG_GLPI;
      $endpoint = $request->attributes->get('_route_params')['endpoint'];
      $legacy_endpoint = $CFG_GLPI['url_base'].'/apirest.php/' . $endpoint;
      return new RedirectResponse($legacy_endpoint);
   }
}