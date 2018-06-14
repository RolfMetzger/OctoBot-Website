<?php

namespace App\Controller;

use App\Entity\Package;
use App\Form\PackageType;
use App\Repository\PackageRepository;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Security\Core\Authentication\Token\Storage\TokenStorageInterface;

/**
* @Route("/package")
 */
class PackageController extends Controller
{

    private $user;
    private $userId;

    public function __construct(TokenStorageInterface $tokenStorage)
    {
        $this->user = $tokenStorage->getToken()->getUser();
        if ($this->user == 'anon.') {
            $this->userId = 0;
        }
        else {
            $this->userId = $this->user->getId();
        }
    }

    /**
     * @Route("/", name="package_index", methods="GET")
     */
    public function index(PackageRepository $packageRepository): Response
    {
        return $this->render('package/index.html.twig', ['packages' => $packageRepository->findAll($this->isGranted('ROLE_SUPER_ADMIN'), $this->userId)]);
    }

    /**
     * @Route("/new", name="package_new", methods="GET|POST")
     */
    public function new(Request $request): Response
    {
        $this->denyAccessUnlessGranted('ROLE_USER', null, 'Access not allowed');
        $package = new Package($this->user);
        $form = $this->createForm(PackageType::class, $package);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($package);
            $em->flush();

            $this->addFlash('success', sprintf('Package "%s" is registred.', $package->getName()));

            return $this->redirectToRoute('package_index');
        }

        return $this->render('package/new.html.twig', [
            'package' => $package,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{id}", name="package_show", methods="GET")
     */
    public function show(Package $package): Response
    {
        return $this->render('package/show.html.twig', ['package' => $package]);
    }

    /**
     * @Route("/{id}/edit", name="package_edit", methods="GET|POST")
     */
    public function edit(Request $request, Package $package): Response
    {
        $this->denyAccessUnlessGranted('ROLE_USER', null, 'Access not allowed');

        $form = $this->createForm(PackageType::class, $package);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {

            $package->setUpdatedAt(new \DateTime());

            $this->getDoctrine()->getManager()->flush();

            $this->addFlash('success', sprintf('Package "%s" is updated.', $package->getName()));

            return $this->redirectToRoute('package_edit', ['id' => $package->getId()]);
        }

        return $this->render('package/edit.html.twig', [
            'package' => $package,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{id}", name="package_delete", methods="DELETE")
     */
    public function delete(Request $request, Package $package): Response
    {
        $this->denyAccessUnlessGranted('ROLE_USER', null, 'Access not allowed');

        if ($this->isCsrfTokenValid('delete'.$package->getId(), $request->request->get('_token'))) {
            $em = $this->getDoctrine()->getManager();
            $em->remove($package);
            $em->flush();

            $this->addFlash('success', sprintf('Package "%s" is deleted.', $package->getName()));
        }

        return $this->redirectToRoute('package_index');
    }
}
