<?php

namespace AppBundle\Controller;

use AppBundle\Entity\TrancheIR;
use Doctrine\Common\Collections\ArrayCollection;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;
use AppBundle\Entity\BaremeIR;
use AppBundle\Form\BaremeIRType;

/**
 * BaremeIR controller.
 *
 * @Route("/parametrage/impots/ir/baremes")
 */
class BaremeIRController extends Controller
{

    /**
     * Lists all BaremeIR entities.
     *
     * @Route("/", name="parametrage_impots_ir_baremes")
     * @Method("GET")
     */
    public function indexAction()
    {
        $em = $this->getDoctrine()->getManager();

        $baremes = $em->getRepository('AppBundle:BaremeIR')->findAll();

        return $this->render('baremeir/index.html.twig', array(
            'baremes' => $baremes,
        ));
    }
    /**
     * Creates a new BaremeIR entity.
     *
     * @Route("/new", name="parametrage_impots_ir_baremes_create")
     * @Method("POST")
     */
    public function createAction(Request $request)
    {
        $bareme = new BaremeIR();
        $form = $this->createCreateForm($bareme);
        $form->handleRequest($request);

        if ($form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($bareme);
            $em->flush();

            return $this->redirect($this->generateUrl('parametrage_impots_ir_baremes_edit', array('id' => $bareme->getId())));
        }

        return $this->render('baremeir/new.html.twig', array(
            'bareme' => $bareme,
            'form'   => $form->createView(),
        ));
    }

    /**
     * Creates a form to create a BaremeIR entity.
     *
     * @param BaremeIR $entity The entity
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createCreateForm(BaremeIR $bareme)
    {
        for ($i = 0; $i < BaremeIR::DEFAULT_TRANCHES_NUMBER; $i++) {
            $bareme->addTranche(new TrancheIR());
        }

        $form = $this->createForm(new BaremeIRType(), $bareme, array(
            'action' => $this->generateUrl('parametrage_impots_ir_baremes_create'),
            'method' => 'POST',
        ));

        return $form;
    }

    /**
     * Displays a form to create a new BaremeIR entity.
     *
     * @Route("/new", name="parametrage_impots_ir_baremes_new")
     * @Method("GET")
     */
    public function newAction()
    {
        $bareme = new BaremeIR();
        $form   = $this->createCreateForm($bareme);

        return $this->render('baremeir/new.html.twig', array(
            'bareme' => $bareme,
            'form'   => $form->createView(),
        ));
    }

    /**
     * Displays a form to edit an existing BaremeIR entity.
     *
     * @Route("/{id}", name="parametrage_impots_ir_baremes_edit")
     * @Method("GET")
     */
    public function editAction($id)
    {
        $em = $this->getDoctrine()->getManager();

        $bareme = $em->getRepository('AppBundle:BaremeIR')->find($id);

        if (!$bareme) {
            throw $this->createNotFoundException($this->get('translator')->translate('gezgezzg'));
        }

        $editForm = $this->createEditForm($bareme);
        $deleteForm = $this->createDeleteForm($id);

        return $this->render('baremeir/edit.html.twig', array(
            'bareme'      => $bareme,
            'edit_form'   => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
    * Creates a form to edit a BaremeIR entity.
    *
    * @param BaremeIR $entity The entity
    *
    * @return \Symfony\Component\Form\Form The form
    */
    private function createEditForm(BaremeIR $entity)
    {
        $form = $this->createForm(new BaremeIRType(), $entity, array(
            'action' => $this->generateUrl('parametrage_impots_ir_baremes_update', array('id' => $entity->getId())),
            'method' => 'PUT',
        ));

        return $form;
    }
    /**
     * Edits an existing BaremeIR entity.
     *
     * @Route("/{id}", name="parametrage_impots_ir_baremes_update")
     * @Method("PUT")
     */
    public function updateAction(Request $request, $id)
    {
        $em = $this->getDoctrine()->getManager();

        $bareme = $em->getRepository('AppBundle:BaremeIR')->find($id);

        if (!$bareme) {
            throw $this->createNotFoundException($this->get('translator')->translate('hrhrhrhrh'));
        }

        $tranches = new ArrayCollection();

        foreach ($bareme->getTranches() as $tranche) {
            $tranches->add($tranche);
        }

        $deleteForm = $this->createDeleteForm($id);
        $editForm = $this->createEditForm($bareme);
        $editForm->handleRequest($request);

        if ($editForm->isValid()) {

            foreach ($tranches as $tranche) {
                if ($bareme->getTranches()->contains($tranche) == false) {
                    $em->remove($tranche);
                }
            }

            $em->flush();

            return $this->redirect($this->generateUrl('parametrage_impots_ir_baremes_edit', array('id' => $id)));
        }

        return $this->render('baremeir/edit.html.twig', array(
            'bareme'      => $bareme,
            'edit_form'   => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        ));
    }
    /**
     * Deletes a BaremeIR entity.
     *
     * @Route("/{id}", name="parametrage_impots_ir_baremes_delete")
     * @Method("DELETE")
     */
    public function deleteAction(Request $request, $id)
    {
        $form = $this->createDeleteForm($id);
        $form->handleRequest($request);

        if ($form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $bareme = $em->getRepository('AppBundle:BaremeIR')->find($id);

            if (!$bareme) {
                throw $this->createNotFoundException($this->get('translator')->translate('hrhrhrhrh'));
            }

            $em->remove($bareme);
            $em->flush();
        }

        return $this->redirect($this->generateUrl('parametrage_impots_ir_baremes'));
    }

    /**
     * Creates a form to delete a BaremeIR entity by id.
     *
     * @param mixed $id The entity id
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createDeleteForm($id)
    {
        return $this->createFormBuilder()
            ->setAction($this->generateUrl('parametrage_impots_ir_baremes_delete', array('id' => $id)))
            ->setMethod('DELETE')
            ->getForm()
        ;
    }
}
