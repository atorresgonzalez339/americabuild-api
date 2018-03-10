<?php

namespace AppBundle\Controller;

use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use FOS\RestBundle\Controller\Annotations as Rest;
use AppBundle\Libs\Controller\BaseController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use FOS\RestBundle\View\View;
use AppBundle\Entity\Users;
use Nelmio\ApiDocBundle\Annotation\ApiDoc;

class AppController extends BaseController {

    /**
     * @ApiDoc(
     *  description="Create a new User",
     *  input="Your\Namespace\Form\Type\YourType",
     *  output="Your\Namespace\Class",
     *     headers={
     *         {
     *             "name"="X-AUTHORIZE-KEY",
     *             "description"="Authorization key",
     *              "required":true
     *         }
     *     }
     * )
     *
     * @Rest\Post("/api/login")
     * @Method({"POST"})
     */
    public function loginAction(Request $request) {

        $username = $request->get('username');
        $password = $request->get('password');
        $user = $this->getRepo('User')->findOneBy(['username' => $username]);

        if (!$user) {
            return new View(array('success' => false, 'error' => $this->get('translator')->trans('validation.user.notfound')), Response::HTTP_OK);
        }

        if (!$user->getActive())
        {
            return new View(array('success' => false, 'error' => $this->get('translator')->trans('validation.user.active')), Response::HTTP_OK);
        }

        // password check
        if (!$this->get('security.password_encoder')->isPasswordValid($user, $password)) {
            return new View(array('success' => false, 'error' => $this->get('translator')->trans('validation.password.incorrect')), Response::HTTP_OK);
        }

        // Use LexikJWTAuthenticationBundle to create JWT token that hold only information about user name
        $token = $this->get('lexik_jwt_authentication.encoder')->encode(['userid'=>$user->getId(), 'username' => $user->getUsername()]);

        $result = $this->saveModel('User', array('id' => $user->getId(), 'token' => $token));
        if ($result['success'] == false) {
            return new View($result, Response::HTTP_OK);
        }

        return new View(array('success' => true, 'token' => $token), Response::HTTP_OK);
    }

    /**
     * @ApiDoc(
     *  description="Create a new User",
     *  input="Your\Namespace\Form\Type\YourType",
     *  output="Your\Namespace\Class",
     *     headers={
     *         {
     *             "name"="X-AUTHORIZE-KEY",
     *             "description"="Authorization key",
     *              "required":true
     *         }
     *     }
     * )
     *
     * @Rest\Post("/api/logout")
     * @Method({"POST","OPTIONS"})
     */
    public function logoutAction(Request $request) {
        $token = $request->headers->get('apiKey');

        $user = $this->getRepo('User')
                ->findOneBy(['token' => $token]);

        if (!$user) {
            return new View(array('success' => false, 'error' => $this->get('translator')->trans('access.token.notfound'), 'code' => 403), Response::HTTP_OK);
        }

        $result = $this->saveModel('User', array('id' => $user->getId(), 'token' => null));
        if ($result['success'] == false) {
            return new View($result, Response::HTTP_OK);
        }
        return new View(array('success' => true), Response::HTTP_OK);
    }

    /**
     * @ApiDoc(
     *  description="Create a new User",
     *  input="Your\Namespace\Form\Type\YourType",
     *  output="Your\Namespace\Class",
     *     headers={
     *         {
     *             "name"="X-AUTHORIZE-KEY",
     *             "description"="Authorization key",
     *              "required":true
     *         }
     *     }
     * )
     *
     * @Rest\Post("/api/passwords/forgot")
     * @Method({"POST","OPTIONS"})
     */
    public function forgotPasswordAction(Request $request) {

        $username = $request->get("email");

        if (!isset($username))
        {
            return new View(array('success' => false, 'error' => $this->get('translator')->trans('validation.email.error')), Response::HTTP_OK);
        }

        $user = $this->getRepo('User')->findOneBy(['username' => $username]);

        if (!$user) {
            return new View(array('success' => false, 'error' => $this->get('translator')->trans('validation.email.notfound')), Response::HTTP_OK);
        }

        $validationToken = $this->get('lexik_jwt_authentication.encoder')->encode(['username' => $user->getUsername()]);
        // aqui en envio del correo
        $result = $this->saveModel('User', array('id' => $user->getId(), 'validationToken' => $validationToken, 'token' => null ) );
        if ($result['success'] == false) {
            return new View($result, Response::HTTP_OK);
        }

        return new View(array('success' => true), Response::HTTP_OK);
    }
}
