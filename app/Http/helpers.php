<?php
/***
 * Genrate uuid
 */
function alert($user_id) {
    return \App\Payment::where('seen',2)->where('citizen_id',$user_id)->get();

}
function complains($user_id) {
    return \App\Complain::where('seen',2)->where('user_id',$user_id)->get();

}


?>