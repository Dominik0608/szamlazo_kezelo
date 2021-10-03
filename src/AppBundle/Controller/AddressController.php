<?php

namespace AppBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Validator\Validator\ValidatorInterface;

use AppBundle\Entity\Address;

class AddressController extends Controller
{
  /**
   * @Route("/address", name="address")
   */
  public function index(Request $request) {
    $addresses = $this->getDoctrine()->getRepository('AppBundle:Address')->findBy(array(), array('id' => 'ASC'));

    return $this->render('address/index.html.twig', [
      'addresses' => $addresses,
    ]);
  }

  /**
   * @Route("/address/create", name="address-create")
   */
  public function create(Request $request, ValidatorInterface $validator) {
    $entityManager = $this->getDoctrine()->getManager();

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
    } else {
      $entityManager->persist($address);
      $entityManager->flush();
  
      $return = [
        'type' => 'success',
        'text' => 'Cím sikeresen mentve!'
      ];
    }

    return new Response(json_encode($return));
  }

  /**
   * @Route("/address/get/{id}", name="address-get")
   */
  public function get($id) {
    $entityManager = $this->getDoctrine()->getManager();

    $address = $entityManager->find('AppBundle\Entity\Address', $id);

    if ($address) {
      $return = [
        'type' => 'success',
        'address' => $address
      ];
    } else {
      $return = [
        'type' => 'danger',
        'text' => 'Cím nem található.'
      ];
    }

    return new Response(json_encode($return));
  }

  /**
   * @Route("/addresses", name="addresses")
   */
  public function getAddresses() {
    $addresses = $this->getDoctrine()->getRepository('AppBundle:Address')->findBy(array(), array('id' => 'ASC'));

    if ($addresses) {
      $return = [
        'type' => 'success',
        'addresses' => $addresses
      ];
    } else {
      $return = [
        'type' => 'danger',
        'text' => 'Hiba a címek betöltése során.'
      ];
    }

    return new Response(json_encode($return));
  }

  /**
   * @Route("/address/save", name="address-save")
   */
  public function save(Request $request, ValidatorInterface $validator) {
    $entityManager = $this->getDoctrine()->getManager();

    $address = $entityManager->find('AppBundle\Entity\Address', $request->request->get('id'));

    if ($address) {
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
      } else {
        $entityManager->persist($address);
        $entityManager->flush();

        $return = [
          'type' => 'success',
          'text' => 'Cím sikeresen módosítva.'
        ];
      }
    } else {
      $return = [
        'type' => 'danger',
        'text' => 'Cím nem található.'
      ];
    }

    return new Response(json_encode($return));
  }

  /**
   * @Route("/address/delete", name="address-delete")
   */
  public function delete(Request $request) {
    $entityManager = $this->getDoctrine()->getManager();

    $address = $entityManager->find('AppBundle\Entity\Address', $request->request->get('id'));

    if ($address) {
      $entityManager->remove($address);
      $entityManager->flush();

      $return = [
        'type' => 'success',
        'text' => 'Cím sikeresen törölve!'
      ];
    } else {
      $return = [
        'type' => 'danger',
        'text' => 'Cím nem található.'
      ];
    }

    return new Response(json_encode($return));
  }
}
