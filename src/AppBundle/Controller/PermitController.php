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


class PermitController extends BaseController
{


    /**
     * Return the overall Permit list.
     *
     * @ApiDoc(
     *   resource = true,
     *   description = "Return the overall Permit List",
     *   statusCodes = {
     *     200 = "Returned when successful"
     *   }
     * )
     * @Rest\Get("/api/permits")
     * @Method({"GET"})
     *
     */
    public function getAllAction()
    {
        return new View($this->getAllDataOfModel('Permit'), Response::HTTP_OK);
    }

    /**
     * Return the Permit with the provided id.
     *
     * @ApiDoc(
     *   resource = true,
     *   description = "Return the Permit with the provided id",
     *   statusCodes = {
     *     200 = "Returned when successful"
     *   }
     * )
     * @Rest\Get("/api/permits/{id}")
     * @Method({"GET"})
     *
     */
    public function getByIdAction($id)
    {
        return new View($this->getDataOfModelById('Permit',$id), Response::HTTP_OK);
    }

    /**
     * Create a new Permit
     * @ApiDoc(
     *   resource = true,
     *   description = "Return an object with property success to inform the result of response an data array with id of new resource create",
     *   statusCodes = {
     *     200 = "Returned when successful"
     *   }
     * )
     * @Rest\Post("/api/permits")
     * @Method({"POST"})
     */
    public function postAction(Request $request)
    {
        $user = $this->getUserOfCurrentRequest();
        if (!$user)
        {
            return $this->returnSecurityViolationResponse();
        }

        $repo = $this->getRepo("Permit");
        $repoUserRT = $this->getRepo("PermitUserRelationType");
        try {
            // permit data
            $permit["user"] = $user->getId();
            $permit["type"] = $request->get("permitType");
            $createdAt = new \DateTime("now");
            $permit["createdAt"] = $createdAt->format('Y-m-d H:i:s');
            $permit["updatedAt"] = $createdAt->format('Y-m-d H:i:s');
            $permit["folioNumber"] = $request->get("folioNumber");
            $permit["numberOfUnits"] = $request->get("numberOfUnits");
            $permit["lot"] = $request->get("lot");
            $permit["block"] = $request->get("block");
            $permit["subdivision"] = $request->get("subdivision");
            $permit["pbpg"] = $request->get("pbpg");
            $permit["currentUseOfProperty"] = $request->get("currentUseOfProperty");
            $permit["descriptionOfWork"] = $request->get("descriptionOfWork");
            $permit["estimateValue"] = $request->get("estimateValue");
            $permit["area"] = $request->get("area");
            $permit["length"] = $request->get("length");
            $permit["typeOfImprovement"] = $request->get("typeOfImprovement");
            $permit['ownerBuilder'] = $request->get("ownerBuilder");

            if (isset($permit["estimateValue"]) && isset($permit["area"]) && isset($permit["length"]))
            {
                $permit["estimateValue"] = doubleval($permit["estimateValue"]);
                $permit["area"] = doubleval($permit["area"]);
                $permit["length"] = doubleval($permit["length"]);
            }

            $repo->beginTransaction();
            $permitSaved = $this->saveModel('Permit', $permit, array("Permit" => array("ValuesValidation")), false);
            if (!$permitSaved["success"]) {
                throw new \Exception($permitSaved["error"], 4000);
            }

            // permit user profile owner / tenant - information
            $ownerTenantUserProfile = $request->get("ownerTenantUserProfile");
            if ( !isset( $ownerTenantUserProfile ) )
            {
                throw new \Exception( $this->get('translator')->trans('validation.parameters.requiered', array("paramname" => "ownerTenantUserProfile")), 4000);
            }
            unset($ownerTenantUserProfile['licenseNumber']);
            $permitUPSaved = $this->saveModel('PermitUserProfile', $ownerTenantUserProfile, array("PermitUserProfile"=>array("owner-tenant")), false);
            if (!$permitUPSaved["success"]) {
                throw new \Exception($permitUPSaved["error"], 4000);
            }

            // permit user for owner / tenant
            $permitUser["user"] = $user->getId();
            $permitUser["permit"] = $permitSaved['data']['id'];
            $permitUser["permitUserProfile"] = $permitUPSaved['data']['id'];

            $ownerType = $repoUserRT->findOneBy(array("type"=>"OWNER"));
            if ( !$ownerType )
            {
                throw new \Exception($this->get('translator')->trans('validation.permittype.notfound', array("ptype" => "OWNER")), 4000);
            }
            $permitUser["permitUserRelationType"] = $ownerType->getId();
            $permitUserSaved = $this->saveModel('PermitUser', $permitUser, array(), false);

            if (!$permitUserSaved["success"]) {
                throw new \Exception($permitUPSaved["error"], 4000);
            }

            // permit user profile contractor - information
            if ( $permit['ownerBuilder'] == false  )
            {
                $contractorUserProfile = $request->get("contractorUserProfile");
                if (!isset($contractorUserProfile)) {
                    throw new \Exception($this->get('translator')->trans('validation.parameters.requiered', array("paramname" => "contractorUserProfile")), 4000);
                }

                unset($contractorUserProfile['driverLicOrId']);
                $permitUPSaved = $this->saveModel('PermitUserProfile', $contractorUserProfile, array("PermitUserProfile" => array("contractor")), false);
                if (!$permitUPSaved["success"]) {
                    throw new \Exception($permitUPSaved["error"], 4000);
                }

                // permit user for contractor
                $permitUser["user"] = $user->getId();
                $permitUser["permit"] = $permitSaved['data']['id'];
                $permitUser["permitUserProfile"] = $permitUPSaved['data']['id'];

                $contractorType = $repoUserRT->findOneBy(array("type"=>"CONTRACTOR"));
                if ( !$contractorType )
                {
                    throw new \Exception($this->get('translator')->trans('validation.permittype.notfound', array("ptype" => "CONTRACTOR")), 4000);
                }
                $permitUser["permitUserRelationType"] = $contractorType->getId();
                $permitUserSaved = $this->saveModel('PermitUser', $permitUser, array(), false);

                if (!$permitUserSaved["success"]) {
                    throw new \Exception($permitUPSaved["error"], 4000);
                }
            }

            // permit user profile architect - information
            $architectUserProfile = $request->get("architectUserProfile");
            if ( !isset( $architectUserProfile ) )
            {
                throw new \Exception( $this->get('translator')->trans('validation.parameters.requiered', array("paramname" => "architectUserProfile")), 4000);
            }

            unset($architectUserProfile['licenseNumber']);
            $permitUPSaved = $this->saveModel('PermitUserProfile', $architectUserProfile, array("PermitUserProfile"=>array("architect")), false);
            if (!$permitUPSaved["success"]) {
                throw new \Exception($permitUPSaved["error"], 4000);
            }

            // permit user for architect
            $permitUser["user"] = $user->getId();
            $permitUser["permit"] = $permitSaved['data']['id'];
            $permitUser["permitUserProfile"] = $permitUPSaved['data']['id'];

            $architectType = $repoUserRT->findOneBy(array("type"=>"CONTRACTOR"/*"ARCHITECT should be in the database"*/));
            if ( !$architectType )
            {
                throw new \Exception($this->get('translator')->trans('validation.permittype.notfound', array("ptype" => "ARCHITECT")), 4000);
            }
            $permitUser["permitUserRelationType"] = $architectType->getId();
            $permitUserSaved = $this->saveModel('PermitUser', $permitUser, array(), false);

            if (!$permitUserSaved["success"]) {
                throw new \Exception($permitUPSaved["error"], 4000);
            }

            $repo->commit();
            return new View($permitSaved,Response::HTTP_OK);
        }
        catch (\Exception $ex )
        {
            $repo->rollback();
            $this->resetManager();
            if ($ex->getCode() != 4000)
            {
                return $this->manageException($ex);
            }
            else
            {
                return array('success' => false, 'error' => $ex->getMessage());
            }
        }
    }

    /**
     *
     * Update a Permit
     * @ApiDoc(
     *   resource = true,
     *   description = "Return an object with property success to inform the result of response an data array with id of resource update",
     *   statusCodes = {
     *     200 = "Returned when successful"
     *   }
     * )
     * @Rest\Put("/api/permits")
     * @Method({"PUT"})
     */
    public function putAction(Request $request)
    {
        $data = $request->request->all();
        isset($data["createdAt"]);
        isset($data["user"]);
        $data["updatedAt"] = ( new \DateTime("now"))->format('Y/m/d H:i:s');

        if (!isset($data['id']))
        {
            return new View(array("success"=>false,"error"=>$this->get('translator')->trans('validation.updateid.notfound')), Response::HTTP_OK);
        }
        $permitType = $this->getRepo('PermitType')->find($data['id']);

        if (!$permitType)
            return new View(array("success"=>false,"error"=>$this->get('translator')->trans('validation.identifier.invalid', array("value"=>"Permit", "idvalue"=>$data["id"]))), Response::HTTP_OK);

        $save = $this->saveModel('Permit', $data);
        return new View($save, Response::HTTP_OK);
    }

    /**
     * @Rest\Delete("/api/permits/{id}")
     * @Method({"DELETE"})
     */
    public function deleteAction($id)
    {
        return new View($this->removeModel('Permit', $id), Response::HTTP_OK);
    }
}
