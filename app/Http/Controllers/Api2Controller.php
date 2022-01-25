<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Tikets;
use App\Models\Bets;
use App\Models\User;
use DB;


class Api2Controller extends Controller
{
     public function GetTickets($id=null)

     {
      //This Condition Is Applied If We Want To Fetch A Specific Ticket By Its Id

        if(empty($id))    
       
    {
        $bet=Bets::get();
        $ticket=Tikets::get();
        return response()->json(["Tickets"=>$ticket,"bets"=>$bet]);  
    
    }else

      //If The Id Of The Ticket Is Not In Database Then Fetch All Bets 

      //If There Is A specific Id Then Fetch Just The Specific Ticket By Its Id 

    {

        $bet=Bets::get();
        $ticket=Tikets::find($id);
        return response()->json(['Tickets'=>$ticket,"bets"=>$bet]);  

        }

    }



//This Piece Of Code Allows Us To Add Multiple or Single Records Into The bets Table At The Same Time

     public function AddMultiple(Request $request)

     {
        if($request->isMethod('post'))
        {
            $userData= $request->input();
          //  echo"<pre>"; print_r($userData); die;
           foreach ($userData['bets'] as $key => $value)
           {
                $betty=new Bets;
                $ticket=Tikets::get();
                $betty->id = $value['id'];
                $betty->amount = $value['amount'];
               $betty->type = $value['type'];
               $betty->save();

             }
            return response()->json(["ticket"=>$ticket,"bets"=>$betty]);
            

        }

     }

//Updating The User's UserName

 public function UpdateUser(Request $request ,$id)
 {
    if($request->isMethod('patch'))
    {
        $userData=$request->input();
        //The Commented Statement Below Is For Checking Before Post Into The Database
       /*  echo "<pre>"; print_r($userData); die; */
       User::where('id',$id)->update(['name'=>$userData['name']]);
       $users=User::find($id);
       return response()->json(['message'=>'User Updated Successfully ^_^',"users"=>$users],202);
    }
 }
//Applyng Join Tables Then Sorting And Limiting The Eloquent Result Operation By OrderBy Operation
 public function GetOrdered()
   {

    $result=DB::table('tikets')
        ->join('users', function ($join)

         {
            $join->on('users.id', '=', 'tikets.id')
                 ->orderBy('winning_amount', 'Desc');
        })->get()->take(3);
        $result = Tikets::Orderby('winning_amount', 'desc')->limit(3)->get();

        return response()->json(["message"=>"Top","result"=>$result]);
  }

        }
