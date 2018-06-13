<?php

namespace App\Tests\Controller;

use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Security\Core\Authentication\Token\UsernamePasswordToken;
use Symfony\Component\BrowserKit\Cookie;
use Psr\Log\LogLevel;

class SecurityControllerTest extends WebTestCase
{
    private $client = null;
    private $session = null;

    public function setUp()
    {
        $this->client = static::createClient();
        $this->session = $this->client->getContainer()->get('session');
    }

    private function login($username = 'username', $role = 'ROLE_USER')
    {
        $firewallName = 'main';
        $firewallContext = 'main';

        $token = new UsernamePasswordToken($username, null, $firewallName, array($role));
        $this->session->set('_security_'.$firewallContext, serialize($token));
        $this->session->save();

        $cookie = new Cookie($this->session->getName(), $this->session->getId());
        $this->client->getCookieJar()->set($cookie);
    }

    private function logout()
    {
        $this->client->request('GET', '/logout');

        $this->session->invalidate();
    }

    /**
     * login form show username, password and submit button
     */
    public function testShowlogin()
    {
        $crawler = $this->client->request('GET', '/login');

        // asserts that login path exists and don't return an error
        $this->assertEquals(Response::HTTP_OK, $this->client->getResponse()->getStatusCode());

        // asserts that the response content contains csrf token
        $this->assertContains('<input type="hidden" id="user__token" name="user[_token]" value="', $this->client->getResponse()->getContent());

        // asserts that the response content contains input type="text" id="username
        $this->assertContains('<input type="text" id="username" name="_username" required="required"', $this->client->getResponse()->getContent());

        // asserts that the response content contains input type="text" id="password
        $this->assertContains('<input type="password" id="password" name="_password" required="required"', $this->client->getResponse()->getContent());
    }

    /**
     * ROLE_USER access
     */
    public function testUserRole()
    {
        $this->login('user', 'ROLE_USER');

        // after login -> /package : OK
        $crawler = $this->client->request('GET', '/package/');
        $this->assertSame(Response::HTTP_OK, $this->client->getResponse()->getStatusCode());
        $this->assertSame('Package index', $crawler->filter('h1')->text());

        // after login -> /packagecategory : OK
        $crawler = $this->client->request('GET', '/packagecategory/');
        $this->assertSame(Response::HTTP_OK, $this->client->getResponse()->getStatusCode());
        $this->assertSame('Package Types index', $crawler->filter('h1')->text());

        // after login -> /admin : KO
        $this->client->request('GET', '/admin/');
        $this->assertSame(Response::HTTP_FORBIDDEN, $this->client->getResponse()->getStatusCode());

        // after login -> /user : KO
        $this->client->request('GET', '/user/');
        $this->assertSame(Response::HTTP_FORBIDDEN, $this->client->getResponse()->getStatusCode());

        $this->logout();
    }

    /**
     * "ROLE_ADMIN access
     */
    public function testAdminRole()
    {
        // $this->logger->debug('testAdminRole');

        // before login -> /admin : KO
        $this->client->request('GET', '/admin/');
        $this->assertSame(Response::HTTP_FOUND, $this->client->getResponse()->getStatusCode());

        $this->login('admin', 'ROLE_ADMIN');

        // after login -> /admin : OK
        $crawler = $this->client->request('GET', '/admin/');
        $this->assertSame(Response::HTTP_OK, $this->client->getResponse()->getStatusCode());
        $this->assertSame('Control panel', $crawler->filter('h1')->text());

        // after login -> /user : KO
        $this->client->request('GET', '/user/');
        $this->assertSame(Response::HTTP_FORBIDDEN, $this->client->getResponse()->getStatusCode());

        $this->logout();

        // after logout -> /admin : KO
        $this->client->request('GET', '/admin/');
        $this->assertSame(Response::HTTP_FOUND, $this->client->getResponse()->getStatusCode());
    }

    /**
     * "ROLE_SUPER_ADMIN access
     */
    public function testSuperAdminRole()
    {
        // $this->logger->debug('testSuperAdminRole');

        $this->login('super-admin', 'ROLE_SUPER_ADMIN');

        // after login -> /admin : OK
        $crawler = $this->client->request('GET', '/admin/');
        $this->assertSame(Response::HTTP_OK, $this->client->getResponse()->getStatusCode());
        $this->assertSame('Control panel', $crawler->filter('h1')->text());

        // after login -> /user : OK
        $this->client->request('GET', '/user/');
        $this->assertSame(Response::HTTP_OK, $this->client->getResponse()->getStatusCode());

        $this->logout();
    }

}
