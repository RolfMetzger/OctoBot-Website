<?php

namespace App\Controller;

use App\Entity\Package;
use App\Form\PackageType;
use App\Repository\PackageRepository;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

/**
* @Route("/package")
 */
class PackageController extends Controller
{
    /**
     * @Route("/", name="package_index", methods="GET")
     */
    public function index(PackageRepository $packageRepository): Response
    {
        return $this->render('package/index.html.twig', ['packages' => $packageRepository->findAll()]);
    }

    /**
     * @Route("/new", name="package_new", methods="GET|POST")
     */
    public function new(Request $request): Response
    {
        $package = new Package();
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
        if ($this->isCsrfTokenValid('delete'.$package->getId(), $request->request->get('_token'))) {
            $em = $this->getDoctrine()->getManager();
            $em->remove($package);
            $em->flush();

            $this->addFlash('success', sprintf('Package "%s" is deleted.', $package->getName()));
        }

        return $this->redirectToRoute('package_index');
    }
}
