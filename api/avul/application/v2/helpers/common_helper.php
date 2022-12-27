<?php

    function leadingZeros($num,$numDigits) {
       return sprintf("%0".$numDigits."d",$num);
    }

    function generateRandomString($length) 
    {
        $characters = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
        $charactersLength = strlen($characters);
        $randomString = '';
        for ($i = 0; $i < $length; $i++) {
            $randomString .= $characters[rand(0, $charactersLength - 1)];
        }
        return $randomString;
    }

    function generateRandomNumber($length) 
    {
        $characters = '0123456789';
        $charactersLength = strlen($characters);
        $randomString = '';
        for ($i = 0; $i < $length; $i++) {
            $randomString .= $characters[rand(0, $charactersLength - 1)];
        }
        return $randomString;
    } 

    function system_date($value)
    {
        if(!empty($value))
        {
            $result = date('Y-m-d', strtotime($value));
        }
        else
        {
            $result = null;
        }

        return $result;
    }
        
    function banner_status($value)
    {
        if($value == 1)
        {
            $result = '<span class="badge bg-success">Parmanent</span>';
        }
        else
        {
            $result = '<span class="badge bg-danger">Temporary</span>';
        }

        return $result;
    }
    function validateCountryPhone($phoneNumber,$countryCode) 
    {
        $result = false;
        if($countryCode==1)
        {
            if (preg_match('#[^0-9]#', $phoneNumber) || strlen($phoneNumber)!=10)
            {
                $result =  true; 
            }
        }
        else if($countryCode==2)
        {
            if (preg_match('#[^0-9]#', $phoneNumber))
            {
                $result =  true; 
            }
            else if(strlen($phoneNumber)<7 || strlen($phoneNumber)>9)
            {
                $result =  true; 
            }
        }
        return $result;
    }

    function getCountryPhone($phoneNumber,$countryCode) 
    {
        $result = '';
        if($countryCode==1)
        {
            $result = '91'.(!empty($phoneNumber) ? $phoneNumber : '');
        }
        else if($countryCode==2)
        {
            $result = '66'.(!empty($phoneNumber) ? $phoneNumber : '');
        }
        return $result;
    }

    function urlSlug($text, string $divider = '-')
    {
        // replace non letter or digits by divider
        $text = preg_replace('~[^\pL\d]+~u', $divider, $text);

        // transliterate
        $text = iconv('utf-8', 'us-ascii//TRANSLIT', $text);

        // remove unwanted characters
        $text = preg_replace('~[^-\w]+~', '', $text);

        // trim
        $text = trim($text, $divider);

        // remove duplicate divider
        $text = preg_replace('~-+~', $divider, $text);

        // lowercase
        $text = strtolower($text);

        if (empty($text)) {
            return 'n-a';
        }

        return $text;
    }

    function avul_sendmail($data='')
    {
        $postData = '';
        foreach($data as $k => $v) 
        { 
            $postData .= $k . '='.$v.'&'; 
        }
        rtrim($postData, '&');
        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL,"http://www.datasense.in/demo/ci/v2.php");
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, TRUE);
        curl_setopt($ch, CURLOPT_HEADER, false); 
        curl_setopt($ch, CURLOPT_POSTFIELDS, $postData);    

        $output=curl_exec($ch);

        curl_close($ch);
        
        $arraydata=json_decode($output, true);

        return $arraydata ? true : false;
    }

    function youtube_url($value='')
    {
        if (strpos($value, "?v=") !== false) {
            $video_id = explode("?v=", $value);
            $video_id = $video_id[1];
        } else if (strpos($value, ".be/") !== false) {
            $video_id = explode(".be/", $value);
            $video_id = $video_id[1];
        } else if (strpos($value, "watch/") !== false) {
            $video_id = explode("watch/", $value);
            $video_id = $video_id[1];
        }

        $video_url = "https://www.youtube.com/embed/".$video_id."?feature=oembed";
        return $video_url;
    }

    function userAccess($prevKey)
    {
        $CI =& get_instance();
        if($prevKey != '')
        {
            $userAccess= $CI->session->userdata('n_user_access');
            $explodeRoles = explode(",", $userAccess);
            if(!empty($explodeRoles))
            {
                $access = 0;
                foreach($explodeRoles as $key => $value)
                {
                    if($value == $prevKey)
                    {
                       $access = 1;
                    }
                }
                if($access == 1)
                {
                    return TRUE;
                }
                else
                {
                    return FALSE;
                }
            }
            else
            {
                return FALSE;
            }
        }
        else
        {
            return FALSE;
        }
    }

    function post_img($fileName,$tempFile,$targetFolder)
    {   
        if ($fileName!="")
        {
            return copy($tempFile, $targetFolder."/".$fileName);    
        }
    }

    function empty_check($value)
    {
        return !empty($value)?$value:NULL;
    }

    function zero_check($value)
    {
        return !empty($value)?$value:'0';
    }

    function date_check($value)
    {
        if(!empty($value))
        {
            $result = date('d M,Y', strtotime($value));
        }
        else
        {
            $result = null;
        }

        return $result;
    }

    function active_status($value)
    {
        if($value == 1)
        {
            $result = '<span class="badge bg-success">Active</span>';
        }
        else
        {
            $result = '<span class="badge bg-danger">In Active</span>';
        }

        return $result;
    }

    function active_verified($value)
    {
        if($value == 1)
        {
            $result = '<span class="badge bg-success">Verified</span>';
        }
        else
        {
            $result = '<span class="badge bg-danger">Not verified</span>';
        }

        return $result;
    }

    function str_value($value='', $type='')
    {
        $str_replace = str_replace("'", '\'', strtolower(trim($value)));
        $str_result  = ucfirst($str_replace);

        if($type == 1)
        {
            $str_result = strtoupper($str_replace);
        }
        else if($type == 2)
        {
            $str_result = str_replace("'", '\'', strtolower(trim($value)));
        }
        else if($type == 3)
        {
            $str_result = str_replace("'", '\'', trim($value));
        }

        return $str_result;
    }

    function str_compress($value='', $count='30'){
        return mb_strimwidth($value, 0, $count, '...');
    }

    function response_msg($value,$val_1=null){
        if($value == 'otp_success')
        {
            $message = 'OTP Send Successfully';
        }
        else if($value == 'otp_failure')
        {
            $message = 'OTP Send Not Successfully';
        }
        else if($value == 'invalid_otp')
        {
            $message = 'Invalid OTP';
        }
        else if($value == 'invalid_login')
        {
            $message = 'Invalid username and password';
        }
        else if($value == 'overall_required')
        {
            $message = 'Please fill all required fields';
        }
        else if($value == 'login_success')
        {
            $message = 'Login Successfully';
        }
        else if($value == 'dashboard_message')
        {
            $message = 'You have successfully logged to admin panel. Now you can start to explore!';
        }
        else if($value == 'already_exist')
        {
            $message = 'Data Already Exist';
        }
        else if($value == 'store_success')
        {
            $message = 'Data Insert Successfully';
        }
        else if($value == 'store_failure')
        {
            $message = 'Data Insert Not Successfully';
        }
        else if($value == 'update_success')
        {
            $message = 'Data Update Successfully';
        }
        else if($value == 'update_failure')
        {
            $message = 'Data Update Not Successfully';
        }
        else if($value == 'delete_success')
        {
            $message = 'Data Delete Successfully';
        }
        else if($value == 'delete_failure')
        {
            $message = 'Data Delete Not Successfully';
        }
        else if($value == 'success_message')
        {
            $message = 'Success';
        }
        else if($val_1 == 'success')
        {
            if($val_2 == 1)
            {
                $message = 'Data insert successfully';
            }
            else if($val_2 == 2)
            {
                $message = 'Data update successfully';   
            }
            else if($val_2 == 3)
            {
                $message = 'Data delete successfully';      
            }
            else
            {
                $message = 'Success';         
            }
        }
        else if($value == 'no_data')
        {
            $message = 'No Data Found';
        }
        else if($value == 'access_denied')
        {
            $message = 'You need permission to access this';
        }
        else if($value == 'model_mapped')
        {
            $message = 'Cannot be deleted, delete/reassign the associated contents before proceeding with delete';
        }
        
        else
        {
            $message = 'Error';
        }

        return $message;
    }
    function page_status($value)
    {
        if($value == 1)
        {
            $result = '<span class="badge bg-success">Text page</span>';
        }
        else
        {
            $result = '<span class="badge bg-danger">Link Page</span>';
        }

        return $result;
    }
    
    function avul_get_tVal($url){
        $jsondata=file_get_contents($url);
        $arraydata=json_decode($jsondata, true);
        return $arraydata[0][0][0];
    }
    function clean($string) {
       $string = strtolower(str_replace(' ', '', $string));
       return preg_replace('/[^A-Za-z0-9\-]/', '', $string);
    }
?>