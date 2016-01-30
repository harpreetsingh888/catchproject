<?php

namespace AppBundle\Controller;

use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Symfony\Component\HttpFoundation\Response;

class DefaultController extends Controller
{
    /**
     * @Route("/", name="homepage")
     */
    public function indexAction(Request $request)
    {
        $test = '';
//        $users = $this->getDoctrine()->getRepository('AppBundle:Users')->findAllUsers();

        // replace this example code with whatever you need
        return $this->render(
            'default/index.html.twig'
        );
    }

    /**
     * @Route("/getAllUsers")
     * @Method("GET")
     * @param Request $request
     * @return string
     */
    public function getAllUsersAction(Request $request)
    {
        $params = $request->query->all();
        $columns = array( 'id', 'first_name', 'last_name', 'email', 'gender', 'ip_address', 'company', 'city', 'title', 'website' );
        $get['columns'] = &$columns;
        $get['sEcho'] = 0;

//        if (isset($params['length'])) {
//            $get['iDisplayLength'] = $params['length'];
//        }
//        if (isset($params['start'])) {
//            $get['iDisplayStart'] = $params['start'];
//        }f

        $rResult = $this->getDoctrine()->getRepository('AppBundle:Users')->ajaxTable($get);

        /* Data set length after filtering */
        $iFilteredTotal = count($rResult);
        /*
         * Output
         */
        $output = array(
            "sEcho" => intval($get['sEcho']),
            "iTotalRecords" => $this->getDoctrine()->getRepository('AppBundle:Users')->getCount(),
            "iTotalDisplayRecords" => $iFilteredTotal,
            "aaData" => array()
        );
        foreach($rResult as $aRow)
        {
            $row = array();
            for ( $i=0 ; $i<count($columns) ; $i++ ){
                if ( $columns[$i] == "version" ){
                    /* Special output formatting for 'version' column */
                    $row[] = ($aRow[ $columns[$i] ]=="0") ? '-' : $aRow[ $columns[$i] ];
                }elseif ( $columns[$i] != ' ' ){
                    /* General output */
                    $row[] = $aRow[ $columns[$i] ];
                }
            }
            $output['aaData'][] = $row;
        }
        unset($rResult);

        $response = new Response(json_encode($output));
        $response->headers->set('Content-Type', 'application/json');
        return $response;
    }
}
