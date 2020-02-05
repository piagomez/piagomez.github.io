<?php
header("Content-type: text/html; charset=utf-8");
//**********************************************
if(empty($_POST['js'])){

$log =="";
$error="no"; //the presence of errors

 

    $posName = addslashes($_POST['posName']);
    $posName = htmlspecialchars($posName);
    $posName = stripslashes($posName);
    $posName = trim($posName);
    
    $posTel = addslashes($_POST['posTel']);
    $posTel = htmlspecialchars($posTel);
    $posTel = stripslashes($posTel);
    $posTel = trim($posTel); 
    
    $posEmail = addslashes($_POST['posEmail']);
    $posEmail = htmlspecialchars($posEmail);
    $posEmail = stripslashes($posEmail);
    $posEmail = trim($posEmail);
    
    $posText = addslashes($_POST['posText']);
    $posText = htmlspecialchars($posText);
    $posText = stripslashes($posText);
    $posText = trim($posText);


//Checking name
if($posName == '')
    {
    $log .= "<li>Enter your Name</li>";
    $error = "yes";
    } 
 
//Checking phone
function isPhone($posTel)
    {
    return(preg_match("/(?:8|\+7)? ?\(?(\d{3})\)? ?(\d{3})[ -]?(\d{2})[ -]?(\d{2})/"
    ,$posTel));
    }

if($posTel == '')
    {
    $log .= "<li>Enter your Phone</li>";
    $error = "yes";
    }

else if(!isPhone($posTel))
    {
    $log .= "<li>Incorrect Phone.</li>";
    $error = "yes";
    }

    
//Checking Email
function isEmail($posEmail)
    {
    return(preg_match("/^[-_.[:alnum:]]+@((([[:alnum:]]|[[:alnum:]][[:alnum:]-]*[[:alnum:]])\.)+(ad|ae|aero|af|ag|ai|al|am|an|ao|aq|ar|arpa|as|at|au|aw|az|ba|bb|bd|be|bf|bg|bh|bi|biz|bj|bm|bn|bo|br|bs|bt|bv|bw|by|bz|ca|cc|cd|cf|cg|ch|ci|ck|cl|cm|cn|co|com|coop|cr|cs|cu|cv|cx|cy|cz|de|dj|dk|dm|do|dz|ec|edu|ee|eg|eh|er|es|et|eu|fi|fj|fk|fm|fo|fr|ga|gb|gd|ge|gf|gh|gi|gl|gm|gn|gov|gp|gq|gr|gs|gt|gu|gw|gy|hk|hm|hn|hr|ht|hu|id|ie|il|in|info|int|io|iq|ir|is|it|jm|jo|jp|ke|kg|kh|ki|km|kn|kp|kr|kw|ky|kz|la|lb|lc|li|lk|lr|ls|lt|lu|lv|ly|ma|mc|md|mg|mh|mil|mk|ml|mm|mn|mo|mp|mq|mr|ms|mt|mu|museum|mv|mw|mx|my|mz|na|name|nc|ne|net|nf|ng|ni|nl|no|np|nr|nt|nu|nz|om|org|pa|pe|pf|pg|ph|pk|pl|pm|pn|pr|pro|ps|pt|pw|py|qa|re|ro|ru|rw|sa|sb|sc|sd|se|sg|sh|si|sj|sk|sl|sm|sn|so|sr|st|su|sv|sy|sz|tc|td|tf|tg|th|tj|tk|tm|tn|to|tp|tr|tt|tv|tw|tz|ua|ug|uk|um|us|uy|uz|va|vc|ve|vg|vi|vn|vu|wf|ws|ye|yt|yu|za|zm|zw)$|(([0-9][0-9]?|[0-1][0-9][0-9]|[2][0-4][0-9]|[2][5][0-5])\.){3}([0-9][0-9]?|[0-1][0-9][0-9]|[2][0-4][0-9]|[2][5][0-5]))$/i"
    ,$posEmail));
    }

if($posEmail == '')
    {
    $log .= "<li>Enter your Email</li>";
    $error = "yes";
    }

else if(!isEmail($posEmail))
    {
    $log .= "<li>Incorrect e-mail.</li>";
    $error = "yes";
    }
//Checking the entered text comment
if (empty($posText))
{
    $log .= "<li>Enter your message</li>";
    $error = "yes";
}

//Check the length of the comment text
if(strlen($posText)>1000)
{
    $log .= "<li>More than 1000 characters prohibited.</li>";
    $error = "yes";
}

//Checking for the presence of long words
$mas = preg_split("/[\s]+/",$posText);
foreach($mas as $index => $val)
{
  if (strlen($val)>60)
  {
    $log .= "<li>More than 60 characters prohibited.</li>";
    $error = "yes";
    break;
  }
}
sleep(2);
if($error=="no")
{
//Sending letter
$to = "owlthemesnet@gmail.com"; //Your e-mail address
$mes = "Name: $posName \n\nPhone: $posTel \n\nEmail: $posEmail \n\nMessage - $posText";
$from = $posEmail;
$sub = '=?utf-8?B?'.base64_encode('Leave a Reply - DiDental').'?=';  // Your subject
$headers = 'From: '.$from.'
';
$headers .= 'MIME-Version: 1.0
';
$headers .= 'Content-type: text/plain; charset=utf-8
';
mail($to, $sub, $mes, $headers);
echo "1";
}
else
{
        echo "
        <div class='infobox infobox_warning'>
            <div class='close_button'><i class='fa fa-times'></i></div>
            <i class='fa fa-exclamation-triangle'></i>
            <b>Warning</b>
            <span>
                <ul>
                ".$log."
                </ul>
            </span>
        </div>";
}
}

?>
