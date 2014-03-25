<!DOCTYPE html>
<!--
To change this license header, choose License Headers in Project Properties.
To change this template file, choose Tools | Templates
and open the template in the editor.
-->
<html>
    <head>
        <meta charset="UTF-8">
        <title></title>
    </head>
    <body>
        <?php
                 function generateACL($clearance)
    {
        $access_control = array('anonymous', 'user', 'admin', 'superadmin');
        $access_control['anonymous'] = array('home', 'login');
        $access_control['user'] = array('user', 'test');
        $access_control['admin'] = array('testadmin','questionadmin');
        $access_control['superadmin'] = array('useradmin');

        $acl = array();
        if ($clearance >= 0) {
            $acl = array_merge($acl, $access_control['anonymous']);
            if ($clearance >= 1) {
                $acl = array_merge($acl, $access_control['user']);
                if ($clearance >= 2) {
                    $acl = array_merge($acl, $access_control['admin']);
                    if ($clearance >= 3) {
                        $acl = array_merge($acl, $access_control['superadmin']);
                    }
                }
            }
        }
        
        return $acl;
    }
                
                $cl0 = array('clearance level 0', generateACL(0));
                $cl1 = array('clearance level 1', generateACL(1));
                $cl2 = array('clearance level 2', generateACL(2));
                $cl3 = array('clearance level 3', generateACL(3));
                print('<pre>');
                print_r($cl0);
                print_r($cl1);
                print_r($cl2);
                print_r($cl3);
                print('</pre>');
                
        ?>
    </body>
</html>
