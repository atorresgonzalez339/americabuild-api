<?php

namespace AppBundle\Controller;

use AppBundle\Entity\PermitPermitType;
use AppBundle\Entity\PermitRevision;
use AppBundle\Entity\Revision;
use AppBundle\Libs\Controller\BaseController;
use AppBundle\Listeners\ExceptionListener;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use FOS\RestBundle\View\View;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Nelmio\ApiDocBundle\Annotation\ApiDoc;
use FOS\RestBundle\Controller\Annotations as Rest;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use AppBundle\Libs\Normalizer\ResultDecorator;
use JMS\SecurityExtraBundle\Annotation\Secure;


class RevisionController extends BaseController
{

    /**
     * Return the Permit revision list.
     *
     * @ApiDoc(
     *   resource = true,
     *   description = "Return the overall Fees Item List",
     *   statusCodes = {
     *     200 = "Returned when successful"
     *   }
     * )
     * @Rest\Get("/api/permitrevision/{id}")
     * @Method({"GET"})
     */
    public function getAllAction($id)
    {
        $premitRevisions = $this->getEm()->getRepository(PermitRevision::class)->getByPermite($id);

        return new View($this->normalizeResult('PermitRevision', $premitRevisions), Response::HTTP_OK);
    }

    /**
     * Return the Permit revision.
     *
     * @ApiDoc(
     *   resource = true,
     *   description = "Return the overall Fees Item List",
     *   statusCodes = {
     *     200 = "Returned when successful"
     *   }
     * )
     * @Rest\Get("/api/get-permitrevision/{id}")
     * @Method({"GET"})
     */
    public function getPermiRevisionAction($id)
    {
        $premitRevision = $this->getEm()->find(PermitRevision::class, $id);

        return new View($this->normalizeResult('PermitRevision', $premitRevision), Response::HTTP_OK);
    }

    /**
     * Return the Revisions of the permit with the provided id.
     *
     * @author Yosviel Dominguez <yosvield@gmail.com>
     * @ApiDoc(
     *   resource = true,
     *   description = "Return the Revisions of the permit with the provided id.",
     *   statusCodes = {
     *     200 = "Returned when successful"
     *   }
     * )
     * @Rest\Get("/api/revision/permittype/{id}")
     * @Method({"GET"})
     *
     */
    public function getByPermitTypeAction($id)
    {
        $em = $this->getEm();

        $data = $em->getRepository(Revision::class)->findBy(array('permitType' => $id));
        return new View($this->normalizeResult('Revision', $data), Response::HTTP_OK);
    }

    /**
     * Create a Revision for permit
     *
     * @author Yosviel Dominguez <yosvield@gmail.com>
     * @ApiDoc(
     *   resource = true,
     *   description = "Create a Revision for permit",
     *   statusCodes = {
     *     200 = "Returned when successful"
     *   }
     * )
     * @Rest\Post("/api/revision")
     * @Method({"POST"})
     */
    public function createRevisionAction(Request $request)
    {
        try {
            $em = $this->getEm();
            $idpermit = $request->get('idpermit');
            $revision = $request->get('revision');
            $permitType = $request->get('permitType');

            $permitPermitType = $em->getRepository(PermitPermitType::class)->findBy(array('type' => $permitType['id'], 'permit' => $idpermit));
            $revision = $em->getRepository(Revision::class)->find($revision['id']);

            $permitRevision = new PermitRevision();
            $permitRevision->setPermitpermittype($permitPermitType[0]);
            $permitRevision->setRevision($revision);

            $em->persist($permitRevision);
            $em->flush();

            return new View(array('success' => true), Response::HTTP_CREATED);
        } catch (\Exception $ex) {
            return array('success' => false, 'error' => $ex->getMessage());
        }
    }

    /**
     * Update a Revision for permit
     *
     * @author Yosviel Dominguez <yosvield@gmail.com>
     * @ApiDoc(
     *   resource = true,
     *   description = "Update a Revision for permit",
     *   statusCodes = {
     *     200 = "Returned when successful"
     *   }
     * )
     * @Rest\Put("/api/revision/{id}")
     * @Method({"PUT"})
     */
    public function updateRevisionAction($id, Request $request)
    {
        try {
            $em = $this->getEm();
            $idpermit = $request->get('idpermit');
            $revision = $request->get('revision');
            $permitType = $request->get('permitType');

            $permitPermitType = $em->getRepository(PermitPermitType::class)->findBy(array('type' => $permitType['id'], 'permit' => $idpermit));
            $revision = $em->getRepository(Revision::class)->find($revision['id']);

            $permitRevision = $em->find(PermitRevision::class, $id);
            $permitRevision->setPermitpermittype($permitPermitType[0]);
            $permitRevision->setRevision($revision);

            $em->persist($permitRevision);
            $em->flush();

            return new View(array('success' => true), Response::HTTP_CREATED);
        } catch (\Exception $ex) {
            return array('success' => false, 'error' => $ex->getMessage());
        }
    }

    /**
     * @Rest\Delete("/api/permitrevision/{id}")
     * @Method({"DELETE"})
     */
    public function deletePermitRevisionAction($id)
    {
        return new View($this->removeModel('PermitRevision', $id), Response::HTTP_OK);
    }
}
