<?php

namespace App\Facades;


class VerifyPermissions
{

    public function checkPermissions($permissions)
    {
        $havePermission = false;
        $i = 0;
        if ($permissions == null)
            return True;
        foreach (auth()->user()->getPermissionsViaRoles() as $key => $value) {
            if (in_array($value->name, $permissions)) {
                $havePermission = True;
                break;
            }
            $i++;
        }
        return $havePermission;
    }
}
