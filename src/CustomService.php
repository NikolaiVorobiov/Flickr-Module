<?php

namespace Drupal\mp_flickr;

use Drupal\Core\Session\AccountInterface;

/**
 * Class CustomService
 * @package Drupal\mp_flickr\Services
 */
class CustomService {

  /**
   * Allows to display an image on the screen.
   */
  public function getPhoto($api_key, $photo_id) {

    //build the API URL parameters to call
    $params = [
      'api_key'	=> $api_key,
      'method'	=> 'flickr.photos.getInfo',
      'photo_id'	=> $photo_id,
      'format'	=> 'php_serial',
    ];

    $rsp_obj = $this->callTheApi($params);

    //display the photo image (or an error if it failed)
    if ($rsp_obj['stat'] == 'ok'){

      $server = $rsp_obj['photo']['server'];
      $id = $rsp_obj['photo']['id'];
      $secret = $rsp_obj['photo']['secret'];
      $photo_title = $rsp_obj['photo']['title']['_content'];

      echo "<div><img src=\"https://live.staticflickr.com/{$server}/{$id}_{$secret}_w.jpg\">Title is $photo_title!<div>";

    } else {
      echo "Call failed!";
    }
    die;
  }

  /**
   * Allows to display gallery on the screen.
   */
  public  function getGallery($api_key, $gallery_id) {

    //build the API URL parameters to call
    $params = [
      'api_key'	=> $api_key,
      'method'	=> 'flickr.galleries.getPhotos',
      'gallery_id'	=> $gallery_id,
      'format'	=> 'php_serial',
    ];

    $encoded_params = [];
    foreach ($params as $k => $v){
      $encoded_params[] = urlencode($k).'='.urlencode($v);
    }

    $rsp_obj = $this->callTheApi($encoded_params);

    //display gallery images (or an error if it failed)
    if ($rsp_obj['stat'] == 'ok') {

      foreach ($rsp_obj['photos']['photo'] as $photo) {

        $server = $photo['server'];
        $id = $photo['id'];
        $secret = $photo['secret'];
        $photo_title = $photo['title'];

        echo "<div><img src=\"https://live.staticflickr.com/{$server}/{$id}_{$secret}_w.jpg\">Title is $photo_title!</div>";
      }
    } else {
      echo "Call failed!";
    }
    die;
  }

  /**
   * Peforms call the API and decode the response
   */
  public function callTheApi($params) {

    $encoded_params = [];
    foreach ($params as $k => $v){
      $encoded_params[] = urlencode($k).'='.urlencode($v);
    }

    $url = "https://api.flickr.com/services/rest/?".implode('&', $encoded_params);

    $client = \Drupal::httpClient();
    $client->request('GET', $url);
    $request = $client->get($url);
    $response = $request->getBody();
    $rsp_obj = unserialize($response);
    return $rsp_obj;
  }


//  protected $currentUser;
//
//  /**
//   * CustomService constructor.
//   * @param AccountInterface $currentUser
//   */
//  public function __construct(AccountInterface $currentUser) {
//    $this->currentUser = $currentUser;
//  }
//
//
//  /**
//   * @return \Drupal\Component\Render\MarkupInterface|string
//   */
//  public function getData() {
//    return $this->currentUser->getDisplayName();
//  }

}