<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class AuditController extends Controller
{
    /*
                    ACTION CODES
        # ACCESS
            0 = LOGGED IN (ACCESSED ADMIN PANEL)
            1 = ACCESSED USERS MANAGEMENT
            2 = ACCESSED LOCATION MANAGEMENT
            3 = ACCESSED USER REPORTS
            4 = ACCESSED STATISTICS
            5 = BECAME AN ADMIN THROUGH SECRET LINK
        # USER MANAGEMENT 
                        ADMIN
            11 = CHECKED PROFILE (REF: USER_ID)
            12 = EDIT USER'S PFOFILE (REF: USER_ID)
            13 = PROMOTED USER (REF: USER_ID)
            14 = DEMOTED USER (REF: USER_ID)
            15 = BANNED USER (REF: USER_ID)
            16 = LIFTED BAN (REF: USER_ID)
                    HEAD ADMIN
            17 = CREATED ADMIN ACCOUNT
            18 = CHANGED PASS (REF: ADMIN_ID)
         # LOCATION MANAGEMENT
            21 = EDITED LOCATION (REF: LOCATION)
            22 = DELETED LOCATION (REF: LOCATION)
        # USER REPORTS
            31 = MARKED NO ACTION (REF: REPORT_ID)
            32 = SENT INFRACTION (REF: REPORT_ID, USER_ID)
    */
        function __construct() {
            $this-> middleware(['superadmin','verify']);
        }

        public function audit()
        {
            return \App\Audit::latest()->get();
        }
}
