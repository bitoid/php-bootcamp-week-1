<?php 
    function dataFromUrl($url){

        $param = [
            'http' => [
                'method' => 'GET',
                'header' => [
                    'User-Agent: Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/101.0.4951.54 Safari/537.36 Edg/101.0.1210.39',
                ]
            ]
        ];

        $data_decoded=file_get_contents( $url, false, stream_context_create($param));
        return json_decode($data_decoded, true);
    } ?>



<?php function nameValidaton($user_validation){
    if($user_validation["total_count"]===0) {
        return die("error: invalid github username '".$_POST['input_username']."'");
    }
}?>



<?php function getoperationvalue($operation,$user_info){
    if($operation==='repository'){                           
        $data_count=$user_info["public_repos"];
    }else{                               
        $data_count=$user_info["followers"];
    }
    return $data_count;
}?>

