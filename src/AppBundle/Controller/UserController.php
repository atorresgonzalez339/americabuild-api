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
        $repassword = $request->get("repassword");

        if ( filter_var( $data["username"], FILTER_VALIDATE_EMAIL) == false )
        {
            return new View(array('success' => false, 'error' => $this->get('translator')->trans('validation.email.error')), Response::HTTP_OK);
        }

        if ( $data['password'] != $repassword )
        {
            return new View(array('success' => false, 'error' => $this->get('translator')->trans('validation.password.notmatch')), Response::HTTP_OK);
        }
        $data["role"] = 2; //AUTHENTICATED_USER
        $data["active"] = false;
        $data["company"] = 1; // Default Company

        $validationToken = $this->get('lexik_jwt_authentication.encoder')->encode(['username' => $data["username"], "actionName" => "userActivation"]);
        $data["validationToken"] = $validationToken;
        $save = $this->saveModel('User', $data);

        $origin = $request->headers->get("Origin");
        $emailParameters = array( "email" => $data["username"], "subject" => "User registration", "url" => $origin."/user/activation?token=".$validationToken, "fullname" => $data["fullname"]);
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
}
