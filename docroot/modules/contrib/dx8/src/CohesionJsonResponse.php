<?php

namespace Drupal\cohesion;

use Symfony\Component\HttpFoundation\JsonResponse;

/**
 * JSON response object for Cohesion AJAX requests.
 * Use this for all JSON responses to Angular so headers are defined in
 * a single place.
 */
class CohesionJsonResponse extends JsonResponse {

  public function __construct($data = null, $status = 200, $headers = array()) {

    $headers = array(
      // CORS.
      'Access-Control-Allow-Origin' => '*',
      // OPTIONS allows js preflight check.
      'Access-Control-Allow-Methods' => 'POST, GET, PUT, DELETE, OPTIONS',
      // Send the cookies with response.
      'Access-Control-Allow-Headers' => 'Authorization',
      // Disable caching.
      'Cache-Control' => 'no-cache, no-store, must-revalidate',
      'Pragma' => 'no-cache',
      'Expires' => 0
    );

    if(is_array($data)){
      // Optional HTTP code.
      if (isset($data['code'])) {
        $status = $data['code'];
      }

      $response_data = isset($data['data']) ? $data['data'] : $data;
      if (isset($data['status'])) {
        $this->setStatusCode($status, $data['status']);
      }
    }else{
      $response_data = $data;
    }

    // Run the parent to populate this data and create the request.
    parent::__construct($response_data, $status, $headers);
  }

}
