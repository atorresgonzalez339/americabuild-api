<?php

namespace AppBundle\Controller;

use AppBundle\Libs\Controller\BaseController;
use AppBundle\Libs\Decorator\MailDecorator;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use FOS\RestBundle\View\View;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Nelmio\ApiDocBundle\Annotation\ApiDoc;
use FOS\RestBundle\Controller\Annotations as Rest;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use AppBundle\Libs\Normalizer\ResultDecorator;
use JMS\SecurityExtraBundle\Annotation\Secure;


class UserController extends BaseController
{


    /**
     * Return the overall User list.
     *
     * @ApiDoc(
     *   resource = true,
     *   description = "Return the overall User List",
     *   statusCodes = {
     *     200 = "Returned when successful"
     *   }
     * )
     * @Rest\Get("/api/users")
     * @Method({"GET"})
     *
     */
    public function getAllAction()
    {
        return new View($this->getAllDataOfModel('User'), Response::HTTP_OK);
    }

    /**
     * @Rest\Get("/api/users/info")
     * @Method({"GET"})
     */
    public function getUserInfoAction()
    {
        $user = $this->getUserOfCurrentRequest();
        if (!$user)
        {
            return $this->returnSecurityViolationResponse();
        }

        return $this->normalizeResult("User", $user, ResultDecorator::DEFAULT_DECORATOR);
    }

    /**
     * @Rest\Delete("/api/users/{id}")
     * @Method({"DELETE"})
     */
    public function deleteAction($id)
    {
        return new View($this->removeModel('User', $id), Response::HTTP_OK);
    }

    /**
     * Create a new User
     * @ApiDoc(
     *   resource = true,
     *   description = "Return an object with property success to inform the result of response an data array with id of new resource create",
     *   statusCodes = {
     *     200 = "Returned when successful"
     *   }
     * )
     * @Rest\Post("/api/users/register")
     * @Method({"POST"})
     */
    public function postAction(Request $request)
    {
        $data["username"] = $request->get("username");
        $data["password"] = $request->get("password");
        $data["fullname"] = $request->get("fullname");
        $data["address"] = $request->get("address");
        $data["phoneNumber"] = $request->get("phoneNumber");
        $data["licenseNumber"] = $request->get("licenseNumber");
        $repassword = $request->get("repassword");

        if ( filter_var( $data["username"], FILTER_VALIDATE_EMAIL) == false )
        {
            return new View(array('success' => false, 'error' => $this->get('translator')->trans('validation.email.error')), Response::HTTP_OK);
        }

        if ( $data['password'] != $repassword )
        {
            return new View(array('success' => false, 'error' => $this->get('translator')->trans('validation.password.notmatch')), Response::HTTP_OK);
        }

        if (!isset($data["address"]) || empty($data["address"]))
        {
            return new View(array('success' => false, 'error' => $this->get('translator')->trans('validation.parameters.requiered', array("paramname"=>"address"))), Response::HTTP_OK);
        }

        if (!isset($data["phoneNumber"]) || empty($data["phoneNumber"]))
        {
            return new View(array('success' => false, 'error' => $this->get('translator')->trans('validation.parameters.requiered', array("paramname"=>"phoneNumber"))), Response::HTTP_OK);
        }

        $data["userType"] = $request->get("userType");
        if (!isset($data["userType"]) || empty($data["userType"]))
        {
            return new View(array('success' => false, 'error' => $this->get('translator')->trans('validation.parameters.requiered', array("paramname"=>"userType"))), Response::HTTP_OK);
        }
        else
        {
            $userType = $this->getRepo("UserType")->find($data["userType"]);
            if (!$userType) {
                return new View(array('success' => false, 'error' => $this->get('translator')->trans('validation.object.notfound', array("element"=>"user type"))), Response::HTTP_OK);
            }

            if ( $userType->getType() == "CONTRACTOR" || $userType->getType() == "ARCHITECT" )
            {
                if (!isset($data["licenseNumber"]) || empty($data["licenseNumber"]))
                {
                    return new View(array('success' => false, 'error' => $this->get('translator')->trans('validation.parameters.requiered', array("paramname"=>"licenseNumber"))), Response::HTTP_OK);
                }
            }
            else
            {
                unset($data["licenseNumber"]);
            }
        }

        $data["roles"] = array(2); //AUTHENTICATED_USER
        $data["active"] = false;
        $data["company"] = 1; // Default Company

        $validationToken = $this->get('lexik_jwt_authentication.encoder')->encode(['username' => $data["username"], "actionName" => "userActivation"]);
        $data["validationToken"] = $validationToken;
        $save = $this->saveModel('User', $data);

        $origin = $request->headers->get("Origin");
        $emailParameters = array( "email" => $data["username"], "subject" => "User Registration", "url" => $origin."/user/activation?token=".$validationToken, "fullname" => $data["fullname"]);
        $this->get("manager.email")->sendMessage( $emailParameters, MailDecorator::REGISTER_ACTIVATION );

        return new View($save, Response::HTTP_OK);
    }

    /**
     * Create a new User
     * @ApiDoc(
     *   resource = true,
     *   description = "Return an object with property success to inform the result of response an data array with id of new resource create",
     *   statusCodes = {
     *     200 = "Returned when successful"
     *   }
     * )
     * @Rest\Put("/api/users/register/activation")
     * @Method({"PUT"})
     */
    public function userActivationAction(Request $request)
    {
        $data["token"] = $request->get("token");
        $tokenInfo = $this->get('lexik_jwt_authentication.encoder')->decode($data["token"]);

        if ( !isset( $tokenInfo["username"] ) || !isset( $tokenInfo["actionName"] ) || $tokenInfo["actionName"] != "userActivation" )
        {
            return new View(array('success' => false, 'error' => $this->get('translator')->trans('validation.validationtoken.invalid')), Response::HTTP_OK);
        }

        $user = $this->getRepo('User')->findOneBy(array("username" => $tokenInfo["username"]));
        if ( !$user || $user->getValidationToken() != $data["token"] )
        {
            return new View(array('success' => false, 'error' => $this->get('translator')->trans('validation.validationtoken.invalid')), Response::HTTP_OK);
        }

        $save = $this->saveModel('User', array('id' => $user->getId(), 'validationToken' => null, 'active' => true ) );
        return new View($save, Response::HTTP_OK);
    }

    /**
     *
     * Update a User
     * @ApiDoc(
     *   resource = true,
     *   description = "Return an object with property success to inform the result of response an data array with id of resource update",
     *   statusCodes = {
     *     200 = "Returned when successful"
     *   }
     * )
     * @Rest\Put("/api/users")
     * @Method({"PUT"})
     */
    public function putAction(Request $request)
    {
        $data = $request->request->all();
        unset($data["username"]);
        unset($data["password"]);
        unset($data["salt"]);
        unset($data["token"]);
        unset($data["roles"]);
        if (!isset($data['id']))
        {
            return new View(array("success"=>false,"error"=>"No user identifier provided to performe the update action"), Response::HTTP_OK);
        }
        $user = $this->getRepo('User')->find($data['id']);
        if (!$user)
            return new View(array("success"=>false,"error"=>"User identifier not found"), Response::HTTP_OK);

        $save = $this->saveModel('User', $data);
        return new View($save, Response::HTTP_OK);
    }

    /**
     * Return the overall UserType list. This service is used for anonymous users.
     *
     * @ApiDoc(
     *   resource = true,
     *   description = "Return the overall UserType List",
     *   statusCodes = {
     *     200 = "Returned when successful"
     *   }
     * )
     * @Rest\Get("/api/users/usertypes")
     * @Method({"GET"})
     *
     */
    public function getUserTypesAction()
    {
        return new View($this->getAllDataOfModel('UserType'), Response::HTTP_OK);
    }
}
