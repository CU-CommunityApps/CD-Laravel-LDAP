<?php

namespace App\Helpers;

use App\Helpers\Contracts\LDAPContract;

class LDAP implements LDAPContract

{

    public function data()
    {
        $NetID = \Illuminate\Session::get("username");  
        $result = ["emplid"=>"", 'firstname'=>"", 'lastname'=>'', 'email'=>''];

        $ldappass = env("LDAP_PASS", "");
        $ldaprdn = 'uid='.env("LDAP_USER","").',ou=Directory Administrators,o=Cornell University,c=US';
        $ds=ldap_connect(env("LDAP_SERVER",""));
        if ($ds)
        {
            if ($ldappass == "") {
                $r = ldap_bind($ds);  // anonymous
            } else {
                $r = ldap_bind($ds, $ldaprdn, $ldappass);  // with bind id
            }
            $sr = ldap_search($ds,"ou=People,o=Cornell University,c=US","uid=$NetID");
            $info = ldap_get_entries($ds, $sr);

            $EmplID = $info[0]["cornelleduemplid"][0];
            $FirstName = $info[0]["givenname"][0];
            $LastName = $info[0]["sn"][0];
            $Email = $info[0]["mail"][0];

            #  Student may have exercised FERPA right to suppress name
            if (($FirstName == "") && ($LastName == "")) {
                $FirstName = "Cornell";
                $LastName  = "Student";
            }

            $result = array(    'emplid'=>$EmplID,
                                'firstname'=>$FirstName,
                                'lastname'=>$LastName,
                                'email'=>$Email
                            );
        }
        return $result;
    }
}
