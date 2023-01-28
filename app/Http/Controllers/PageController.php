<?php

namespace App\Http\Controllers;

use App\Http\Controllers\BillingController;
use App\Http\Controllers\MasterDataController;
use App\Http\Controllers\OperatorController;
use Illuminate\Http\Request;

class PageController extends Controller
{
    /**
     * Display all the static pages when authenticated
     *
     * @param string $page
     * @return \Illuminate\View\View
     */
    public function index(string $page)
    {
        if (view()->exists("pages.{$page}")) {
            if ($page == "master-data") {
                return $this->masterdata();
            } elseif($page == "billing") {
                return $this->billing();
            } elseif($page == "operator") {
                return $this->operator();
            } else {
                return view("pages.{$page}");  
            }
        }

        return abort(404);
    }

    public function vr()
    {
        return view("pages.virtual-reality");
    }

    public function rtl()
    {
        return view("pages.rtl");
    }

    public function profile()
    {
        return view("pages.profile-static");
    }

    public function signin()
    {
        return view("pages.sign-in-static");
    }

    public function signup()
    {
        return view("pages.sign-up-static");
    }
    public function masterdata()
    {   
        $result = (new MasterDataController)->show();
        return $result;
    }
    public function operator()
    {
        $result = (new OperatorController)->index();
        return $result;
    }

    public function billing()
    {
        $result = (new BillingController)->index();
        return $result;
    }
}
