<?php

namespace App\Security;

use App\Entity\Comunidad;
use App\Entity\Rol;
use App\Entity\Usuario;
use App\Entity\UsuarioRol;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\HttpFoundation\RedirectResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Session\SessionInterface;
use Symfony\Component\Routing\Generator\UrlGeneratorInterface;
use Symfony\Component\Security\Core\Authentication\Token\TokenInterface;
use Symfony\Component\Security\Core\Encoder\UserPasswordEncoderInterface;
use Symfony\Component\Security\Core\Exception\CustomUserMessageAuthenticationException;
use Symfony\Component\Security\Core\Exception\InvalidCsrfTokenException;
use Symfony\Component\Security\Core\Security;
use Symfony\Component\Security\Core\User\UserInterface;
use Symfony\Component\Security\Core\User\UserProviderInterface;
use Symfony\Component\Security\Csrf\CsrfToken;
use Symfony\Component\Security\Csrf\CsrfTokenManagerInterface;
use Symfony\Component\Security\Guard\Authenticator\AbstractFormLoginAuthenticator;
use Symfony\Component\Security\Guard\PasswordAuthenticatedInterface;
use Symfony\Component\Security\Http\Util\TargetPathTrait;

class LoginFormAuthenticator extends AbstractFormLoginAuthenticator implements PasswordAuthenticatedInterface
{
    use TargetPathTrait;

    public const LOGIN_ROUTE = 'app_login';

    private $entityManager;
    private $urlGenerator;
    private $csrfTokenManager;
    private $passwordEncoder;
    private $session;

    public function __construct(EntityManagerInterface $entityManager, UrlGeneratorInterface $urlGenerator, CsrfTokenManagerInterface $csrfTokenManager, UserPasswordEncoderInterface $passwordEncoder, SessionInterface $session)
    {
        $this->entityManager = $entityManager;
        $this->urlGenerator = $urlGenerator;
        $this->csrfTokenManager = $csrfTokenManager;
        $this->passwordEncoder = $passwordEncoder;
        $this->session = $session;
    }

    /**
     * Called on every request to decide if this authenticator should be
     * used for the request. Returning `false` will cause this authenticator
     * to be skipped.
     */
    public function supports(Request $request)
    {
        return self::LOGIN_ROUTE === $request->attributes->get('_route')
            && $request->isMethod('POST');
    }

    /**
     * Called on every request. Return whatever credentials you want to
     * be passed to getUser() as $credentials.
     */
    public function getCredentials(Request $request)
    {
        $credentials = [
            'email' => $request->request->get('email'),
            'password' => $request->request->get('password'),
            'comunidad' => $request->request->get('comunidad'),
            'csrf_token' => $request->request->get('_csrf_token'),
        ];
        $request->getSession()->set(
            Security::LAST_USERNAME,
            $credentials['email']
        );

        return $credentials;
    }

    // If this returns a user, checkCredentials() is called next:
    public function getUser($credentials, UserProviderInterface $userProvider)
    {
        $token = new CsrfToken('authenticate', $credentials['csrf_token']);
        if (!$this->csrfTokenManager->isTokenValid($token)) {
            throw new InvalidCsrfTokenException();
        }

        $user = $this->entityManager->getRepository(Usuario::class)->findOneBy(['email' => $credentials['email'], 'estado' => 1]);

        if (!$user) {
            throw new CustomUserMessageAuthenticationException('Credenciales Incorrectas.');
        }
        //siempre limpiar roles
        $user->setRoles([]);
        $this->entityManager->flush();

        return $user;
    }
    
    // Check credentials - e.g. make sure the password is valid.
    // Return `true` to cause authentication success
    public function checkCredentials($credentials, UserInterface $user)
    {
        $password = $this->passwordEncoder->isPasswordValid($user, $credentials['password']);
        if(!$password){
            // fail authentication with a custom error
            throw new CustomUserMessageAuthenticationException('Credenciales Incorrectas.');
        }
        else{
            //si la password es correcta
            $comunidad = null;
            if($credentials['comunidad'] != '0'){
                //buscar la comunidad por codigo
                $comunidad = $this->entityManager->getRepository(Comunidad::class)->findOneBy(['codigo' => $credentials['comunidad'], 'estado' => 1]);
                if(!$comunidad){
                    throw new CustomUserMessageAuthenticationException('Credenciales Incorrectas.');
                }
            }
            //buscar el usuario_rol de este usuario y de esta comunidad
            $usuarioRol = $this->entityManager->getRepository(UsuarioRol::class)->findOneBy(['usuario' => $user, 'comunidad' => $comunidad, 'estado' => 1]);
            if(!$usuarioRol){
                throw new CustomUserMessageAuthenticationException('Credenciales Incorrectas.');
            }
            else{
                //buscar el rol como tal para guardarlo
                $rol = $this->entityManager->getRepository(Rol::class)->findOneBy(['id' => $usuarioRol->getRol(), 'estado' => 1]);
                if(!$rol){
                    throw new CustomUserMessageAuthenticationException('Credenciales Incorrectas.');
                }
            }
            //si todo esta correcto, guardar la comunidad y el rol en sesion
            $this->session->set('comunidad', $comunidad);
            $user->setRoles([$rol->getNombre()]);
            $this->entityManager->flush();
        }
        return $password;
    }

    /**
     * Used to upgrade (rehash) the user's password automatically over time.
     */
    public function getPassword($credentials): ?string
    {
        return $credentials['password'];
    }

    public function onAuthenticationSuccess(Request $request, TokenInterface $token, string $providerKey)
    {
        if ($targetPath = $this->getTargetPath($request->getSession(), $providerKey)) {
            return new RedirectResponse($targetPath);
        }

        // For example : return new RedirectResponse($this->urlGenerator->generate('some_route'));
        return new RedirectResponse($this->urlGenerator->generate('dashboard'));
        throw new \Exception('TODO: provide a valid redirect inside '.__FILE__);
    }

    protected function getLoginUrl()
    {
        return $this->urlGenerator->generate(self::LOGIN_ROUTE);
    }
}
