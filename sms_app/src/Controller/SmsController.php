<?php

namespace App\Controller;

use App\Entity\Sms;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class SmsController extends AbstractController
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
  public function add(EntityManagerInterface $em)
  {
    $request = Request::createFromGlobals();
    $number = $request->get('number');
    $body = $request->get('body');

    if(!$number || !$body)
      return new Response('Invalid API call.', Response::HTTP_NOT_FOUND);
    else if(false) {
      // else if(!isNumberOk($number)) {
      return new Response('Invalid number.', Response::HTTP_NOT_FOUND);
    }
    else {
      $sms = new Sms();
      $sms->setNumber($number)
          ->setBody($body)
          ->setCreatedAt(new \DateTime('now'))
          ->setStatus(1);

      $em->persist($sms);
      $em->flush();

      return new Response(sprintf("<b>Number:</b> <tt>%s</tt></br><b>Body: </b><tt>%s </tt>", $number, $body));
    }
  }
  /**
   *@Route("/report/")
   */
  public function report(EntityManagerInterface $em)
  {
    $request = Request::createFromGlobals();
    $number = $request->get('number');
    if (!$number) {
      $productCount = $em->getRepository(Sms::class)
                         ->count(['status' => 1]);
      return $this->render(
        'report.html.twig',
        ['count' => $productCount]
      );
    }
    else {
      return new Response(sprintf("Response for %s", $number));
    }
  }
}
