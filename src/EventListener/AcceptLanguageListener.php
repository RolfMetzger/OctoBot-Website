<?php
namespace App\EventListener;

use Symfony\Component\HttpKernel\Event\GetResponseEvent;

class AcceptLanguageListener
{

    private $availablesLanguages;

    public function __construct(array $availablesLanguages)
    {
        $this->availablesLanguages = $availablesLanguages;
    }

    public function onKernelRequest(GetResponseEvent $event)
    {
        dump($this->availablesLanguages);

        // s'il ne s'agit pas d'une master request, alors ne pas allez plus loin
        if (!$event->isMasterRequest()) {
            return;
        }

        // extraire la variable request de l'évènement
        $request = $event->getRequest();

        // vérifier qu'il n'y a aucun moyen de déterminer la langue d'une autre manière, comme par exemple à l'aide d'une URL spécifique
        // if the locale has been set as a _locale routing parameter, définir la variable '_locale' pour la session, et ne pas aller plus loin
        if ($locale = $request->attributes->get('_locale')) {
            $request->getSession()->set('_locale', $locale);
            return;
        }

        // vérifier que la langue n'est pas déjà stockée dans la session
        $sessionLocale = $request->getSession()->get('_locale');
        if ($sessionLocale) {
            $request->setLocale($sessionLocale);
            return;
        }

        // Récupérer la liste des langues possibles
        if (is_null($this->availablesLanguages)) {
            $this->availablesLanguages = array('en');
        }

        // Récupérer les langues que le client est capable de comprendre with $request->headers->get('accept-language'),
        // et déterminer quelle variante locale est préférée
        // Si aucune langue ne correspond, ne pas aller plus loin
        $locale = $request->getPreferredLanguage($this->availablesLanguages);

        // Définir le paramètre "locale", en fonction de la langue la plus adaptée
        $request->setLocale($locale);

        // Mémoriser le paramètre "locale", dans la session,
        $request->getSession()->set('_locale', $locale);

        return;
    }


}
