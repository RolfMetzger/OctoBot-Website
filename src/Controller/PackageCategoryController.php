<?php

namespace App\Controller;

use App\Entity\PackageCategory;
use App\Form\PackageCategoryType;
use App\Repository\PackageCategoryRepository;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

/**
 * @Route("/package/category")
 */
class PackageCategoryController extends Controller
{
    /**
     * @Route("/", name="package_category_index", methods="GET")
     */
    public function index(PackageCategoryRepository $packageTypeRepository): Response
    {
        return $this->render('package_category/index.html.twig', ['package_categories' => $packageTypeRepository->findAll()]);
    }

    /**
     * @Route("/new", name="package_category_new", methods="GET|POST")
     */
    public function new(Request $request): Response
    {
        $packageCategory = new PackageCategory();
        $form = $this->createForm(PackageCategoryType::class, $packageCategory);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($packageCategory);
            $em->flush();

            $this->addFlash('success', sprintf('Package\'s category "%s" is registred.', $packageCategory->getShortname()));

            return $this->redirectToRoute('package_category_index');
        }

        return $this->render('package_category/new.html.twig', [
            'package_category' => $packageCategory,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{id}", name="package_category_show", methods="GET")
     */
    public function show(PackageCategory $packageCategory): Response
    {
        return $this->render('package_category/show.html.twig', ['package_category' => $packageCategory]);
    }

    /**
     * @Route("/{id}/edit", name="package_category_edit", methods="GET|POST")
     */
    public function edit(Request $request, PackageCategory $packageCategory): Response
    {
        $form = $this->createForm(PackageCategoryType::class, $packageCategory);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $this->getDoctrine()->getManager()->flush();

            $this->addFlash('success', sprintf('Package\'s category "%s" is updated.', $packageCategory->getShortname()));

            return $this->redirectToRoute('package_category_edit', ['id' => $packageCategory->getId()]);
        }

        return $this->render('package_category/edit.html.twig', [
            'package_category' => $packageCategory,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{id}", name="package_category_delete", methods="DELETE")
     */
    public function delete(Request $request, PackageCategory $packageCategory): Response
    {
        if ($this->isCsrfTokenValid('delete'.$packageCategory->getId(), $request->request->get('_token'))) {
            $em = $this->getDoctrine()->getManager();
            $em->remove($packageCategory);
            $em->flush();

            $this->addFlash('success', sprintf('Package\'s category "%s" is deleted.', $packageCategory->getShortname()));
        }

        return $this->redirectToRoute('package_category_index');
    }
}
