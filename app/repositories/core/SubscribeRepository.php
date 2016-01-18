<?php
/*
* CityHub Follow Repository
*
* Handles notification subscriptions

*/




class SubscribeRepository
{
  public function __construct() {
       
     //eventi za push   

         CommunalServiceReport::saved(function($report)
            {

               $followId=array(
                               CommunalServiceReportCity::where('report_id', '=', $report->id)->first()->city_id,
                                1,
                                0,
                                $report->id,
                              );
      $report = CommunalServiceReport::find($report->id);
//echo '$report u getsingle ________________ : <pre>'; print_r( $report) ; echo '</pre>'; 
          //echo '$followId u CommServ:saved<pre>'; print_r( $followId) ; echo '</pre>';     
                
                $uuids=$this->getFollowers($followId);
//echo '$uuids u CommServ:saved<pre>'; print_r( $uuids) ; echo '</pre>'; 
                
                if(isset($report->description)) $body= $report->description;
                else $body= $report->location_address;
                $poruka=' : '.$body;
                 $notice='notification_status_change';
                  $message=array($notice, $poruka);  
                $message['state']='tabs.details';
                $message['params']=array('id'=>$report->id);
                    $this->sendPush($uuids, $message);                

             //echo 'CommunalServiceReport EVENT::updated::id=<pre>'; print_r ($poruka); echo '</pre>'; 


            }); 
        
          CityNews::saved(function($report)
            {

               $followId=array(
                               $report->city_id,
                                2, 0,0 );
     // echo '$followId u News:saved<pre>'; print_r( $followId) ; echo '</pre>';           
                $uuids=$this->getFollowers($followId);

                $poruka=' : '.$report->news_name;                
                 $notice='notification_new_article';
                  $message=array($notice, $poruka);  
                 $message['state']='cityNewsSingle';
                $message['params']=array('id'=>$report->id);
                    $this->sendPush($uuids, $message);


            });  
     
             TouristInformationEntry::saved(function($report)
            {

               $followId=array(
                               TouristInformationCategory::find($report->category_id)->city_id,
                               3,
                               $report->category_id,
                                $report->id,
                               );
                
                $uuids=$this->getFollowers($followId);
                
                if(!empty($uuids)){
                    $poruka=' : ' . TouristInformationCategory::find($report->category_id)->name.
                    ' * '.$report->name;
                    $notice='notification_update';
                  $message=array($notice, $poruka);  
                  $message['state']='tourist.details';
                $message['params']=array('id'=>$report->id);
                    $this->sendPush($uuids, $message);
                
               
             //echo 'TouristInformationEntry EVENT::saved::poruka=<pre>'; print_r ($poruka); echo '</pre>'; 
                }



            });        
    }
 

    //raspoređuje juzere po jezicima i za svaki jezik priprema drugu poruku
    private function sendPush($uuids, $message){
         //echo 'useri u sendPush<pre>'; print_r( $uuids) ; echo '</pre>';
                
        
        foreach($uuids as $lang => $uuidovi){
           

            $lang_tag=Language::find($lang)->iso_tag;
            $msgtxt= Lang::get('push.'.$message[0], array(), $lang_tag) . $message[1];
            $msg=array(
                'txt'=>$msgtxt,
                'state'=>$message['state'],
                'params'=>$message['params'],
            );
            
            $this-> pushNotification($uuidovi, $msg);
        }
        
    }
    
    

    
     private function pushNotification($uuids, $message) {
//echo '<pre>'; print_r( $uuids) ; echo '</pre>';
//echo '<pre>'; print_r( $message) ; echo '</pre>';
            $url = 'https://push.ionic.io/api/v1/push';
            $auth = base64_encode('4cde69b36ab2515a1bac0137f92c8726cec27b8dc2635d81:');

            $data  = array(
                
                            'notification'=> array(
                                'alert' => $message['txt'], 
                                'ios' => array(
                                        'alert' => $message['txt'], 
                                          "badge"=>1,
                                        "sound"=>"ping.aiff",
                                          "priority"=> 10,
                                        "contentAvailable"=> 0,
                                    'payload' => array(
                                        'state' => $message['state'], 
                                        'params' => $message['params'], 
                                    ),
                                ),
                                'android' => array( 
                                    'payload' => array(
                                        'state' => $message['state'], 
                                        'params' => $message['params'], 
                                    ),
                                ),
                            ),
                            'tokens'             => $uuids,
                          );

            $data1 = json_encode($data);
        
        //var_dump($data1);


            $curl = curl_init();
            curl_setopt($curl, CURLOPT_POST, 1);
            curl_setopt($curl, CURLOPT_POSTFIELDS, $data1);
            curl_setopt($curl, CURLOPT_URL, $url);
            curl_setopt($curl, CURLOPT_RETURNTRANSFER, 1);
            curl_setopt($curl, CURLOPT_HTTPHEADER, array(
                'Content-Type: application/json',
                'X-Ionic-Application-Id: 5fc6cb18',
                'Authorization: Basic '.$auth
            ));

            $curl_res = curl_exec($curl);
//echo '<pre>'; print_r( $curl_res) ; echo '</pre>';
            return $curl_res;



    }

    //provjeri da li je UUID zapisan kod juzera, ako nije zapiše ga
  public function checkUuid($uuid, $user_id)
  {

            $uid=Uuids::where('userId', '=', $user_id )->first();
        if(!$uid){
            $uid=new Uuids;
                $uid->UUID =$uuid;
                $uid->userId = $user_id; 
                $uid->save();              
        }
        elseif($uid->UUID!=$uuid){
                $uid->UUID =$uuid;
                $uid->userId = $user_id; 
                $uid->save();  
        }


      //return Uuids::where('UUID', '=', $uuid )->first();
        return $uid->id;
    

  }
    
    protected function getFollowIdObject(Array $follow){
        
            $city=(isset($follow[0]))?$follow[0]:0;
            $module=(isset($follow[1]))?$follow[1]:0;
           $category=(isset($follow[2]))?$follow[2]:0;
           $object=(isset($follow[3]))?$follow[3]:0;
        
        
    
           $follIds=FollowIds::where('city_id', '=', $city)
                ->where('module_id', '=', $module)
                ->where('category_id', '=', $category)
               ->where('object_id', '=',  $object)
               ->first();
        
        return $follIds;
    }
    
 
                                                    //provjeri da li followId postoji, ako ne zapamti ga i vrati implodanog
  protected function checkFollowId(Array $follow)
  {

            $city=(isset($follow[0]))?$follow[0]:0;
            $module=(isset($follow[1]))?$follow[1]:0;
           $category=(isset($follow[2]))?$follow[2]:0;
           $object=(isset($follow[3]))?$follow[3]:0;
        
        
        //$follIds=FollowIds::where('id', '=', 24)->get();
        
        $fidObject=$this->getFollowIdObject($follow);
       
         if(!$fidObject){
                $nuData=new FollowIds(array(
                            'city_id'=>$city,
                              'module_id'=>$module,
                              'category_id'=>$category,
                              'object_id'=>$object, 
                             ));

                $nu=$nuData->save();
             
             
             $nuId=$this->getFollowIdObject($follow)->id;
            
            }
            else {

                    $nuId=$fidObject->id;
            }

      return $nuId;

  }    

    //doda followId useru, ili ga izbriše ako user otkazuje pretplatu
  public function saveFollowId($user_id, Array $followId, $unsubscribe=false)
  {
    
        $follow_id=$this->checkFollowId($followId);

            
            if(!$unsubscribe){                
                $juzer= User::find($user_id);
                
                
                $nufid=$follow_id.',';
             if(strpos($juzer->follow, $nufid)===false) {
                    $juzer->follow.=$nufid;
                    $juzer->save();
                }
            }
            else{
                $juzer= User::find($user_id);
                $juzer->follow=str_replace($follow_id.',', '', $juzer->follow );
                $juzer->save();                
            }
          //echo 'juzer prati ove follow_idje: <pre>'; print_r ( $juzer->follow); echo '</pre>';

      return $juzer->id;

  } 

    public function getPushData($user_id){
        
                $uuids=Uuids::where('userId', '=', $user_id)->get(array('UUID'));
         //return 'push data: <pre>'; print_r ( $uuids); echo '</pre>';
                $userFollows=User::find($user_id)->follow;
                $userFollows=explode(',', $userFollows);
        $listaFollowIda=array();
        return print_r ( $listaFollowIda); 
       
        foreach($userFollows as $fid){
            $followId=FollowIds::find($fid)->toArray();
                $listaFollowIda[]=array_values($followId);
                }
        
        $pushdata=array('uuids'=>$uuids,
                       'following'=>$listaFollowIda,
                       );
        //echo 'push data: <pre>'; print_r ( $pushdata); echo '</pre>';
          return  $pushdata;          
    }
   
     //dohvaća array uuid-a koji prate neki followId
  public function getFollowers(Array $followId)
  {
        $this->checkFollowId($followId);
        $lista=array();
            for($i=3; $i>=0; $i--){
                if(isset($followId[$i])){
                     //echo 'fid array: <pre>'; print_r ( $followId); echo '</pre>';
                    $follow_id= $this->checkFollowId($followId);
                    //echo 'fid int: <pre>'; print_r ( $follow_id); echo '</pre>';
                    $juzeri=User::where('follow', 'like', '%'.$follow_id.'%')->get();
                    //echo 'juzeri: <pre>'; print_r ($juzeri); echo '</pre>';
                    
                    foreach($juzeri as $user){
                        //echo 'user: <pre>'; print_r ( $user->id); echo '</pre>';
                        // $uuid=Uuids::where('userId', '=', $user->id)->first();
                        //$lista[$user->language]=array();
                                 
                        if(!isset($lista[$user->language]) OR !in_array($user->push_token, $lista[$user->language])){
                           if($user->push_token) $lista[$user->language][]=$user->push_token;
                        }
                                
                         
                    }
                    //echo 'lista <pre>'; print_r( $lista) ; echo '</pre>'; 
                    unset($followId[$i]);
                }
                
            }

            
             //echo 'prije returna<pre>'; print_r ( $lista); echo '</pre>'; die();
            return $lista;

  } 
}
