<?php
namespace AppBundle\Classes;

/**
 * Class UsersClass
 *
 * @package AppBundle\Classes
 */

class UsersClass
{

    public function formatDataForDatatable($users)
    {
        $iTotal = 0;
        $iFilteredTotal = 0;
        $output = array(
            "iTotalRecords" => $iTotal,
            "iTotalDisplayRecords" => $iFilteredTotal,
            "aaData" => array()
        );

        foreach ($users as $user) {
            $row = [];
            $row[] = $user['id'];
            $row[] = $user['first_name'];
            $row[] = $user['last_name'];
            $row[] = $user['email'];
            $row[] = $user['gender'];
            $row[] = $user['ip_address'];
            $row[] = $user['company'];
            $row[] = $user['city'];
            $row[] = $user['title'];
            $row[] = $user['website'];
            $output['aaData'][] = $row;

            $iTotal++;
            $output['iTotalRecords'] = $iTotal;
        }

        return $output;
    }
}