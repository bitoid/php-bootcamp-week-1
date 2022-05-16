<?php 

    function fetch_data($base_url, $query_params) {
        $headers = [
            'user-agent: application/vnd.github.v3+json',
        ];  
        $url = $base_url . http_build_query($query_params);
        $ch = curl_init($url);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
        curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
  
        $response = curl_exec($ch);

        if ($response === false) {
            curl_close($ch);
            return array('error' => curl_error($ch));
        } else if (curl_getinfo($ch, CURLINFO_HTTP_CODE) == 404) {
            curl_close($ch);
            return array('error' => 'Not found');
        } else if (curl_getinfo($ch, CURLINFO_HTTP_CODE) == 403) {
            curl_close($ch);
            $error = json_decode($response, true);
            return array('error' => $error['message']);
        } else {
            curl_close($ch);
            return json_decode($response, true);
        } 

    } 

?>