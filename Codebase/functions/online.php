<?php
function IfIsOnline($updated_at_timestamp) {
    if(strtotime($updated_at_timestamp) > strtotime("-120 seconds")) {
     return true;   
    }
    return false;
}