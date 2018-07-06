<?php

namespace AppBundle\Controller;

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
     * @Rest\Get("/api/revision/permit/{id}")
     * @Method({"GET"})
     *
     */
    public function getByPermitAction($id)
    {
        $data = $this->getRepo('Revision')->getByPermit($id);
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
    public function postRevisionAction(Request $request)
    {
        $repoRevision = $this->getRepo("Revision");
        try {
            $revisions = $request->get('permitrevision');
            $repoRevision->beginTransaction();
            foreach ($revisions as $revision) {

                if (!isset($revision['description']) || empty($revision['description'])) {
                    return new View(array("success" => false, "error" => $this->get('translator')->trans('validation.parameters.requiered', array("paramname" => "description"))), Response::HTTP_OK);
                } else if (!isset($revision['name']) || empty($revision['name'])) {
                    return new View(array("success" => false, "error" => $this->get('translator')->trans('validation.parameters.requiered', array("paramname" => "name"))), Response::HTTP_OK);
                }

                $isAdd = !isset($revision['id']);

                $revisionSaved = $this->saveModel('Revision', $revision, array(), false);

                if (!$revisionSaved["success"]) {
                    throw new \Exception($revisionSaved["error"], 4000);
                }

                if ($isAdd) {
                    $permitRevision['permit'] = $request->get('idpermit');
                    $permitRevision['revision'] = $revisionSaved['data']['id'];
                    $permitRevisionSaved = $this->saveModel('PermitRevision', $permitRevision, array(), false);
                    if (!$permitRevisionSaved["success"]) {
                        throw new \Exception($permitRevisionSaved["error"], 4000);
                    }
                }
            }

            $deletes = $request->get('todelete', array());
            foreach ($deletes as $id) {
                $this->removeModel('Revision', $id);
            }

            $repoRevision->commit();
            return new View(array('success' => true), Response::HTTP_OK);
        } catch (\Exception $ex) {
            $repoRevision->rollback();
            $this->resetManager();
            if ($ex->getCode() != 4000) {
                return $this->manageException($ex);
            } else {
                return array('success' => false, 'error' => $ex->getMessage());
            }
        }
    }
}
