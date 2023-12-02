<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class ContactController extends Controller
{
    public function contactIdentityType(Request $request)
    {
        if($request->ajax() && $request->isMethod('post'))
        {
            try
            {
                $contactTypeID = $request->input('contactType');
                $organisationGroupID = Crypt::decrypt($request->attributes->get('userInfo')['organisationGroupID']);
                $identityTypeList =  OrganisationIdentityType::getIDTypeList($organisationGroupID,$contactTypeID);
                return response()->json(['identityTypeList' => $identityTypeList,'success' => true]);
            }
            catch(\Exception $e)
            {
                return response()->json(['identityTypeList' => null,'success' => false]);
            }
        }
    }

    public function getContactProfileIdentityDetails(Request $request)
    {
        if($request->ajax() && $request->isMethod('post'))
        {
            try
            {
                $contactID = Crypt::decrypt($request->input('contactID'));
                $contactProfileDetails = Contact::getContactProfileIdentityDetails($contactID);
                $functionalDCCList = Crypt::decrypt($request->attributes->get('userInfo')['functionalDCCList']);
                $contactProfileIdentityRenderedDetails = view('Backend.Contact.Identity.contact-profile-identity',compact('contactProfileDetails','functionalDCCList'))->render();
                return response()->json(['success' => true,'contactProfileIdentityRenderedDetails' => $contactProfileIdentityRenderedDetails]);
            }
            catch(\Exception $e)
            {
                dd($e->getMessage());
                return response()->json(['success' => false]);
            }
        }
    }
}
