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
        // if it is not a master request, then do not go further
        if (!$event->isMasterRequest()) {
            return;
        }

        // extract the request variable from the event
        $request = $event->getRequest();

        // check that there is no way to determine the language in any other way, such as using a specific URL
        // if the locale has been set as a _locale routing parameter, set the variable '_locale' for the session, and not go further
        if ($locale = $request->attributes->get('_locale')) {
            $request->getSession()->set('_locale', $locale);
            return;
        }

        // check that the language is not already stored in the session
        $sessionLocale = $request->getSession()->get('_locale');
        if ($sessionLocale) {
            $request->setLocale($sessionLocale);
            return;
        }

        // retrieve the list of possible languages
        if (is_null($this->availablesLanguages)) {
            $this->availablesLanguages = array('en');
        }

        // retrieve the languages that the client is able to understand with $request->headers->get('accept-language'),
        // and determine which local variant is preferred
        // if no language matches, do not go further
        $locale = $request->getPreferredLanguage($this->availablesLanguages);

        // define the "local" parameter, according to the most suitable language
        $request->setLocale($locale);

        // save the "locale" parameter, in the session
        $request->getSession()->set('_locale', $locale);

        return;
    }

}
