<?php

namespace AppBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Validator\Validator\ValidatorInterface;

use AppBundle\Entity\Order;
use AppBundle\Entity\Address;

class OrderController extends Controller
{
  /**
   * @Route("/order", name="order")
   */
  public function index(Request $request)
  {
    $addresses = $this->getDoctrine()->getRepository('AppBundle:Address')->findAll();

    return $this->render('order/index.html.twig', [
      'addresses' => $addresses,
    ]);
  }

  /**
   * @Route("/order/create", name="order-create")
   */
  public function create(Request $request, ValidatorInterface $validator) {
    $entityManager = $this->getDoctrine()->getManager();

    $order = new Order();

    
    if ($request->request->get('address') == 'new') { // Új szállítási cím
      $address = new Address();
      $address->type = $request->request->get('type');
      $address->name = $request->request->get('name');
      $address->phone = $request->request->get('phone');
      $address->taxNumber = $request->request->get('taxNumber');
      $address->country = $request->request->get('country');
      $address->postCode = $request->request->get('postCode');
      $address->city = $request->request->get('city');
      $address->street = $request->request->get('street');

      $errors = $validator->validate($address);

      if (count($errors) > 0) {
        $errorsString = '';
        foreach ($errors as $key => $error) {
          $errorsString .= $error->getMessage() . ' ';
        }

        $return = [
          'type' => 'danger',
          'text' => $errorsString
        ];
        return new Response(json_encode($return));
      } else {
        $entityManager->persist($address);
        $entityManager->flush();
        $order->type = $request->request->get('type');
        $order->name = $request->request->get('name');
        $order->phone = $request->request->get('phone');
        $order->taxNumber = $request->request->get('taxNumber');
        $order->country = $request->request->get('country');
        $order->postCode = $request->request->get('postCode');
        $order->city = $request->request->get('city');
        $order->street = $request->request->get('street');
      }
    } else { // Meglévő szállítási cím
      $address = $entityManager->find('AppBundle\Entity\Address', $request->request->get('address'));
      
      $order->type = $address->type;
      $order->name = $address->name;
      $order->phone = $address->phone;
      $order->taxNumber = $address->taxNumber;
      $order->country = $address->country;
      $order->postCode = $address->postCode;
      $order->city = $address->city;
      $order->street = $address->street;
    }

    $net = rand(10000, 100000);
    $order->net = $net;
    $order->vat = $net * 0.27;
    $order->gross = $net * 1.27;

    $errors = $validator->validate($order);

    if (count($errors) > 0) {
      $errorsString = '';
      foreach ($errors as $key => $error) {
        $errorsString .= $error->getMessage() . ' ';
      }

      $return = [
        'type' => $request->request->get('name'),
        'text' => $errorsString
      ];
    } else {
      $entityManager->persist($order);
      $entityManager->flush();
  
      $return = [
        'type' => 'success',
        'text' => 'Rendelés sikeresen mentve!'
      ];
    }

    return new Response(json_encode($return));
  }

  /**
   * @Route("/orders", name="orders")
   */
  public function list(Request $request) {
    $orders = $this->getDoctrine()->getRepository('AppBundle:Order')->findBy(array(), array('id' => 'ASC'));

    return $this->render('order/list.html.twig', [
      'orders' => $orders
    ]);
  }
}
