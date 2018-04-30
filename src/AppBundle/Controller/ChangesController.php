<?php

namespace AppBundle\Controller;

use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use AppBundle\Event\Dispatcher;


class ChangesController extends Controller
{
    /**
     * @Route("/applychanges", name="applychanges")
     */
    public function indexAction(Request $request)
    {
        $eventResult = "";

        if($request->isMethod('POST')){
            //Call to service for restart sems proccess
            $dispatcher = $this->container->get(Dispatcher::class);
            $eventResult = $dispatcher->dispatch('sbc.opensips.service','restart');

            if($eventResult['success'])
                $this->addFlash("success", "The service was restarted correctly.");
            else
                $this->addFlash("error", "An error happened!  [".$eventResult['msg']."]");

        }

        $form = $this->createFormBuilder()
            ->add('apply', SubmitType::class, array( 'label' => 'Apply Changes', 'attr' => array('class' => 'btn btn-danger')))
            ->getForm();


        return $this->render('admin/changes.html.twig', [
            'form' => $form->createView(),
        ]);
    }
}

