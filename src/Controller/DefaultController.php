<?php declare(strict_types=1);

namespace App\Controller;

use App\Entity\EntityA;
use App\Form\BrokenEntityAForm;
use App\Form\WorkingEntityAForm;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;

class DefaultController extends AbstractController
{
    /**
     * @return Response
     */
    public function index () : Response
    {
        return $this->render("index.html.twig");
    }


    /**
     * @param Request $request
     * @param EntityA $entityA
     *
     * @return Response
     */
    public function broken (
        Request $request,
        EntityA $entityA
    ) : Response
    {
        dump($entityA);

        $form = $this->createForm(BrokenEntityAForm::class, $entityA, [
            "method" => "post",
            "action" => $this->generateUrl("broken", [
                "entityA" => $entityA->getId(),
            ])
        ]);

        if ($form->handleRequest($request)->isSubmitted() && $form->isValid())
        {
            dump("broken form: submitted + valid", $form);
            exit;
        }

        return $this->render("form.html.twig", [
            "form" => $form->createView(),
        ]);
    }


    /**
     * @param Request $request
     * @param EntityA $entityA
     *
     * @return Response
     */
    public function working (
        Request $request,
        EntityA $entityA
    ) : Response
    {
        dump($entityA);

        $form = $this->createForm(WorkingEntityAForm::class, $entityA, [
            "method" => "post",
            "action" => $this->generateUrl("working", [
                "entityA" => $entityA->getId(),
            ])
        ]);

        if ($form->handleRequest($request)->isSubmitted() && $form->isValid())
        {
            dump("working form: submitted + valid", $form);
            exit;
        }

        return $this->render("form.html.twig", [
            "form" => $form->createView(),
        ]);
    }
}
