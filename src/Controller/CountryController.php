<?php
/**
 * Created by PhpStorm.
 * User: santino83
 * Date: 08/06/19
 * Time: 1.19
 */

namespace Santino83\CR\Controller;


use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;

class CountryController extends Controller
{

    /**
     * Renders a list of countries
     *
     * @param Request $request
     * @return Response
     */
    public function getCountriesAction(Request $request): Response
    {
        $username = $request->get('username');

        $countries = ['it' => 'Italy', 'fr' => 'France','uk' => 'United Kingdom'];

        return $this->renderView('countries.twig',['username' => $username, 'countries' => $countries]);
    }

    /**
     * Renders details about a country
     *
     * @param Request $request
     * @return Response
     */
    public function getCountryAction(Request $request): Response
    {
        $username = $request->get('username');

        $countries = ['it' => 'Italy', 'fr' => 'France','uk' => 'United Kingdom'];

        $country_id = $request->get('country_id');

        return $this->renderView('country.twig',
            [
                'username' => $username,
                'countries' => $countries,
                'country_id' => $country_id
            ]);
    }

}