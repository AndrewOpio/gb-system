<?php
if (!function_exists('uploadImage')){
    function uploadImage($fieldName)
    {
        $file_name =$_FILES[$fieldName]['name'];
        $file_size = $_FILES[$fieldName]['size'];
        $file_tmp = $_FILES[$fieldName]['tmp_name'];
        $file_type = $_FILES[$fieldName]['type'];
        $desired_dir="imgs";
        $newFileName=uniqid().'.'.pathinfo($file_name, PATHINFO_EXTENSION);
        if(is_dir($desired_dir)==false)
        {
        mkdir("$desired_dir", 0700);// Create directory if it does not exist
        }
        //upload file
        if(file_exists("$desired_dir/".$newFileName)==false)
        {
            $upload1=move_uploaded_file($file_tmp,"$desired_dir/".$newFileName);
            $fileUrl='imgs/'.$newFileName;
        }
        elseif(file_exists("$desired_dir/".$newFileName)==true)
        {                 // rename the file if another one exist
            $upload1=move_uploaded_file($file_tmp,"$desired_dir/".'1'.$newFileName);
            $fileUrl="imgs/1".$newFileName;
        }
        return $fileUrl;
    }
}
if (!function_exists('getPageUrl')){
    function getPageUrl($pageid){
        GLOBAL $conn;
        $pageSelectQuery=mysqli_query($conn, "select url from pages where pageid = '$pageid'");
        $num = mysqli_num_rows($pageSelectQuery);
        if($num == 1)
        {
            $row = mysqli_fetch_array($pageSelectQuery);
            return $row['url'];
        }
        else{
            return null;
        }

    }
}
if (!function_exists('getParentName')){
    function getParentName($navid){
        GLOBAL $conn;
        $navParentSelectQuery=mysqli_query($conn, "select linktext from navigation where id = '$navid'");
        $num = mysqli_num_rows($navParentSelectQuery);
        if($num == 1)
        {
            $row = mysqli_fetch_array($navParentSelectQuery);
            return $row['linktext'];
        }
        else{
            return null;
        }

    }
}
if (!function_exists('checkkids')){
    function checkKids($parentID){
        GLOBAL $conn;
        $kidCheckQuery=mysqli_query($conn, "select * from navigation where parent = '$parentID'");
        $rows = mysqli_num_rows($kidCheckQuery);
        if($rows >= 1)
        {
            return 1;
        }
        else{
            return 0;
        }

    }
}
if (!function_exists('getKids')){ 
    function getKids($parentID){
        GLOBAL $conn;
        $kidCheckQuery=mysqli_query($conn, "select * from navigation where parent = '$parentID'");
        $rows = mysqli_num_rows($kidCheckQuery);
        if($rows >= 1)
        {
            while($items = mysqli_fetch_array($kidCheckQuery))
            {
                echo"
                <li><a href='".getPageUrl($items['pageurl']).".html'>".$items['linktext']."</a><li>
                ";
            }
        }
        else{
            return null;
        }

    }
}
if (!function_exists('uploadImage')){ 
    function getKids($parentID){
        GLOBAL $conn;
        $kidCheckQuery=mysqli_query($conn, "select * from navigation where parent = '$parentID'");
        $rows = mysqli_num_rows($kidCheckQuery);
        if($rows >= 1)
        {
            while($items = mysqli_fetch_array($kidCheckQuery))
            {
                echo"
                <li><a href='".getPageUrl($items['pageurl']).".html'>".$items['linktext']."</a><li>
                ";
            }
        }
        else{
            return null;
        }

    }
}
if (!function_exists('selectEvent')){
    function selectEvent($id = null){
        GLOBAL $conn;
        if(isset($id))
        {
            $query = "select  * from events where id = $id";
        }
        else{
            $query = "select * from events";
        }
        $eventSelectQuery = mysqli_query($conn, $query) or die(mysqli_error($conn));
        $num = mysqli_num_rows($eventSelectQuery);
        if($num >= 1)
        {
           while($results = mysqli_fetch_array($eventSelectQuery))
           {
               $results[] = $results;
           }
           return $results;
        }
        else{
            return 0;
        }
    }
}
if (!function_exists('insertEvent')){
    function insertEvent($title, $details, $image, $start, $end, $created, $modified){
        GLOBAL $conn;
        $query = "insert into events(title, details, image, startDateTime, endDateTime, created, modified) value ('$title', '$details', '$image', '$start', '$end', '$created', '$modified')";
        
        $eventInsertQuery = mysqli_query($conn, $query) or die(mysqli_error($conn));
    
        if($eventInsertQuery)
        {
           return 1;
        }
        else{
            return 0;
        }
    }
}
if (!function_exists('insertBlog')){
    function insertBlog($title, $details, $image, $postdatetime, $author, $created, $modified, $tags, $category, $videolink, $url){
        GLOBAL $conn;
        $query = "insert into blog(title, details, image, postDateTime, author, tags, category, videolink, url,  created, modified) value ('$title', '$details', '$image', '$postdatetime', '$author', '$tags', '$category', '$videolink', '$url', '$created', '$modified')";
        
        $eventInsertQuery = mysqli_query($conn, $query) or die(mysqli_error($conn));
    
        if($eventInsertQuery)
        {
           return 1;
        }
        else{
            return 0;
        }
    }
}
if (!function_exists('getContacts')){
    function getContacts(){
        GLOBAL $conn;
        $query = mysqli_query($conn, "select title, details from misc where type = 'contact'");
        if(mysqli_num_rows($query)>=1)
        {
            $array1 = array();
            while($row = mysqli_fetch_array($query))
            {
                $title = $row['title'];
                $details = $row['details'];
                $array1[$title]= $details;
            }
            return $array1;
        }
        else{
            return 0;
        }
    }
}
if (!function_exists('cleanDate')){
    function cleanDate($date){
        $split = explode(' ', $date);
        $date = $split[0];
        $time = $split[1];
        $split2 = explode('-', $date);

        switch ($split2[1]) {
            case '01':
                    $month = 'Jan';
                break;
            case '02':
                    $month = 'Feb';
                break;
            case '03':
                    $month = 'Mar';
                break;
            case '04':
                    $month = 'Apr';
                break;
            case '05':
                    $month = 'May';
                break;
            case '06':
                    $month = 'Jun';
                break;
            case '07':
                    $month = 'Jul';
                break;
            case '08':
                    $month = 'Aug';
                break;
            case '09':
                    $month = 'Sep';
                break;
            case '10':
                    $month = 'Oct';
                break;
            case '11':
                    $month = 'Nov';
                break;
            case '12':
                $month = 'Dec';
            break;
            
            default:
                # code...
                break;
        }
        $newDate = $split2[0].'/'.$split2[1].'/'.$split2[2];//.' '.$time ;
        return $newDate;
    }
}
if(!function_exists('getdonateinform'))
{
    function getdonateinform(){
        GLOBAL $conn;
        $donateQuery = mysqli_query($conn, "select details from misc where type = 'donate'");
        if(mysqli_num_rows($donateQuery)==1)
        {
            $row = mysqli_fetch_array($donateQuery);
            return $row['details'];
        }
        else{
            return NULL;
        }
    }
}
if(!function_exists('send_confirmation_email')){
    function send_confirmation_email($mail){
        GLOBAL $conn, $site_company, $site_address, $site_email;
        $to=$mail;
        $from='From:'.$site_company.' Subscriptions<'.$site_email.'>'."\r\n";
        $subject=$site_company.' Newsletter';
        $header=$from.'Content-Type: text/html; charset=ISO-8859-1'."\r\n".'MIME-Version: 1.0'."\r\n";
        $message="<html>
        <body>
        <div style='background:#dddddd; width:100%; margin:0; overflow:hidden'>
        <div style='max-width:400px; width:90%; min-width:10px; margin:20px auto 10px; border-top:solid 10px #005100; border-bottom:solid 5px #005100'>
        <h3 style='color:#1f6279; font-size:14px; padding:5px; border-bottom:#f1f1f2 solid 1px; background:#efefef; margin:0'>$site_company</h3>
        <div style='padding: 5px 0 10px 5px; color:#000; background:#fff; margin:0; overflow:hidden'>
        <p>Hello,</p>
        <p>You are receiving this email because we got an application to receive newsletters from $site_address. To confirm your subscription click the link at the bottom.  If the link does not work, use this address to confirm:<br>
        http://$site_address/subscribeemail?confirm=$mail</p>
        <p><span style='color:#999'>Note:</span><span style='color:#dc6200'> Ignore This if you have not made any requests.</span></p>
        <p>Thank you!</p>
        <a href='http://$site_address/subscribeemail?confirm=$mail' style=' background:#003200; color:#fff; padding:5px; text-decoration:none; margin:10px 0'>Confirm Subscription</a>
        <br>
        </div>
        </div>
        </div>
        </body>
        </html>";
        $send=mail($to, $subject, $message, $header);
    }
}
if(!function_exists('check_email')){
    function check_email($email){
        GLOBAL $conn;
        $query = mysqli_query($conn, "select * from subscriptions where email = '$email'") or die(mysqli_error($conn));
        if(mysqli_num_rows($query)>=1)
        {
            return 1;
        }
        else{
            return 0;
        }
    }
}
if(!function_exists('checkUsername')){
    function checkUsername($username)
    {
        GLOBAL $conn;
        $selectQuery=mysqli_query($conn, "select * from users where username = '$username'");
        $row=mysqli_num_rows($selectQuery);
        if($row>=1)
        {
            return 1;
        }
        else{
            return 0;
        }
    }
}
if (!function_exists('getAuthorName')){
    function getAuthorName($authorID){
        GLOBAL $conn;
        $authorSelectQuery=mysqli_query($conn, "select name from users where id = '$authorID'");
        $num = mysqli_num_rows($authorSelectQuery);
        if($num == 1)
        {
            $row = mysqli_fetch_array($authorSelectQuery);
            return $row['name'];
        }
        else{
            return null;
        }

    }
}
if (!function_exists('getAuthorImage')){
    function getAuthorImage($authorID){
        GLOBAL $conn;
        $authorSelectQuery=mysqli_query($conn, "select image from users where id = '$authorID'");
        $num = mysqli_num_rows($authorSelectQuery);
        if($num == 1)
        {
            $row = mysqli_fetch_array($authorSelectQuery);
            return $row['image'];
        }
        else{
            return null;
        }

    }
}
if (!function_exists('getCategoryName')){
    function getCategoryName($categoryID){
        GLOBAL $conn;
        $categorySelectQuery=mysqli_query($conn, "select title from categories where id = '$categoryID'");
        $num = mysqli_num_rows($categorySelectQuery);
        if($num == 1)
        {
            $row = mysqli_fetch_array($categorySelectQuery);
            return $row['title'];
        }
        else{
            return null;
        }

    }
}
if (!function_exists('getStoryTitle')){
    function getStoryTitle($storyID){
        GLOBAL $conn;
        $storySelectQuery=mysqli_query($conn, "select title from blog where id = '$storyID'");
        $num = mysqli_num_rows($storySelectQuery);
        if($num == 1)
        {
            $row = mysqli_fetch_array($storySelectQuery);
            return $row['title'];
        }
        else{
            return null;
        }

    }
}
if (!function_exists('pendingapproval')){
    function pendingapproval(){
        GLOBAL $conn;
        $approvalSelectQuery=mysqli_query($conn, "select * from blog where approved = '0'");
        $num = mysqli_num_rows($approvalSelectQuery);
        if($num >= 1)
        {
            return $num;
        }
        else{
            return 0;
        }

    }
}
if (!function_exists('pendingapproval')){
    function pendingapproval(){
        GLOBAL $conn;
        $approvalSelectQuery=mysqli_query($conn, "select * from blog where approved = '0'");
        $num = mysqli_num_rows($approvalSelectQuery);
        if($num >= 1)
        {
            return $num;
        }
        else{
            return 0;
        }

    }
}
if (!function_exists('getLiveStreamID')){
    function getLiveStreamID(){
        GLOBAL $conn;
        $approvalSelectQuery=mysqli_query($conn, "select * from misc where type = 'livestream'");
        $num = mysqli_num_rows($approvalSelectQuery);
        if($num >= 1)
        {
            $row = mysqli_fetch_array($approvalSelectQuery);
            if($row['details']!='')
            {
                $data = $row['details'];
                $videoID = substr($data, strpos($data, "v=") + 2);
                return $videoID;
            }
            else{
                return null;
            }
        }
    }
}
if (!function_exists('getpriceChange')){
    function getpriceChange($commodityID, $marketID, $date){
        GLOBAL $conn;
        $priceChangeQueryYesterday=mysqli_query($conn, "select amount from prices where commodity = '$commodityID' and market = '$marketID' and DATE(created) = DATE(date_sub('$date',interval 1 DAY))") or die(mysqli_error($conn));
        $priceChangeQueryToday=mysqli_query($conn, "select amount from prices where commodity = '$commodityID' and market = '$marketID' and DATE(created) = '$date'") or die(mysqli_error($conn));
        if(mysqli_num_rows($priceChangeQueryYesterday) >= 1 and mysqli_num_rows($priceChangeQueryToday) >= 1)
        {
            $rowYesterday = mysqli_fetch_array($priceChangeQueryYesterday);
            $rowToday = mysqli_fetch_array($priceChangeQueryToday);
            if($rowToday['amount']!='' and $rowYesterday['amount']!='')
            {
                if($rowToday['amount'] > $rowYesterday['amount'])
                {
                    return '<span class="text-success"><i class="fa fa-arrow-up"></i></span>';
                }
                elseif($rowToday['amount'] < $rowYesterday['amount'])
                {
                    return '<span class="text-danger"><i class="fa fa-arrow-down"></i></span>';
                }
                elseif ($rowToday['amount'] == $rowYesterday['amount']) {
                    return '<span class="text-info"><i class="fa fa-grip-lines"></i></span>';
                }
                else
                {
                    return NULL;
                }
            }
            else{
                return NULL;
            }
        }
    }
}

