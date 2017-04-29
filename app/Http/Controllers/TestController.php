<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Input;

class TestController extends Controller
{
    //public $jsText;

    public  function testFunc()
    {
        $flightPathIndex = null;
        $variable = [ 0=> 'Test array', 1 => 'Second Object'];

        if (Input::has('pathIndex'))
        {
            $flightPathIndex = Input::get('pathIndex');
        }

        return view('testblade',compact('flightPathIndex'));

    }

    public function jsTest()
    {
       // if ($jsText!=null)
        //    dd($jsText);
        return view('jstest');
    }

    public function jsPost(Request $request)
    {
        $jsText = $request->input('JStext');
        //return view('jstest',compact('request'));
    }
    public function requestWiki()
    {
        return "https://en.wikipedia.org/w/api.php?format=json&action=query&prop=extracts&exintro=&explaintext=&titles=Stack%20Overflow";
            //Redirect::to("https://en.wikipedia.org/w/api.php?format=json&action=query&prop=extracts&exintro=&explaintext=&titles=Stack%20Overflow");
    }

    public static function getWikiText(Request $request)
    {
        // $request = Request::create('https://en.wikipedia.org/w/api.php?format=json&action=query&prop=extracts&exintro=&explaintext=&titles=Stack%20Overflow');
        $json = json_decode(file_get_contents('https://en.wikipedia.org/w/api.php?format=json&action=query&prop=extracts&exintro=&explaintext=&titles=Stack%20Overflow'), true);

        //dd($json);
        foreach($json['query']['pages'] as $reponse=>$value)
        {
            dd($value['extract']);
        }
    }

}
