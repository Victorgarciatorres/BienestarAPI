

<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DateTime;
use App\usage;
use App\User;
use App\application;

class usageController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $csv = array_map('str_getcsv' , file('/Applications/MAMP/htdocs/Victor/BienestarAPI/storage/app/usage.csv'));

        $csvLength = count($csv);

        $email = $request->data_token->email;
        $user = User::where('email', $email)->first();

        or ($i=1; $i < $csvLength ; $i++) { 

                $openDate = new DateTime ($csv[$i][0]);
                $application = $csv[$i][1];
                $openLocation = $csv[$i][3] . "," . $csv[$i][4];

                $i++;

                $closeDate =  new DateTime ($csv[$i][0]);
                // $timeUsed se guarda en segundos 
                $timeUsed = $closeDate->getTimestamp() - $openDate->getTimestamp();

                $application = application::where('name',$application)->first();

                if (isset($application)) {

                    $newUsage = new usage();
                    $newUsage->register($openDate,$timeUsed,$openLocation,$user->id,$application->id);   
                }               


            }
            return response()->json(["Success" => "Se ha añadido el uso de todas las aplicaciones"]);




    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $email = $request->data_token->email;
        $user = User::where('email',$email)->first();
        $usage = usage::where('user_id',$user->id)->get();

        $usageLength = count($usages);

        $usagesToShow = [];

        foreach ($usages as $key => $usage) {
            
            if (!in_array($usage->$usagesToShow)) {
                array_push($usagesToShow, $usage)
            }
        }


    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
