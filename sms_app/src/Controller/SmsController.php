<?php

namespace App\Controller;

use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;

class SmsController
{
  /**
   *@Route("/")
   */
  public function homepage()
  {
    return new Response("Hello Fuckinnnnnnnnnn World!");
  }
  /**
   *@Route("/send/sms/")
   */
  public function add()
  {
    $request = Request::createFromGlobals();
    $number = $request->get('number');
    $body = $request->get('body');
    if(!$number || !$body)
      return new Response('Invalid API call.', Response::HTTP_NOT_FOUND);
    else {
      return new Response(sprintf("<b>Number:</b> <tt>%s</tt></br><b>Body: </b><tt>%s </tt>", $number, $body));
    }
  }
  /**
   *@Route("/report/")
   */
  public function report()
  {
    $request = Request::createFromGlobals();
    $number = $request->get('number');
    if (!$number) {
      return new Response("Response for all!");
    }
    else {
      return new Response(sprintf("Response for %s", $number));
    }
  }
}
