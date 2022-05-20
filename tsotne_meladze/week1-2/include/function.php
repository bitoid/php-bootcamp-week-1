<?php


        
        function tableHeader($a, $b, $c ) {
          echo '
          <table>
          <tr id="header">
          <th style="border-top-left-radius: 12px;">' . $a . '</th>
          <th>' . $b . '</th>
          <th style="border-top-right-radius: 12px;">' . $c . '</th>
          </tr>';
        }//to generate table th with different headers

        function parseJson($urls) {
          $c = curl_init($urls);
          curl_setopt($c, CURLOPT_RETURNTRANSFER, 1);
          curl_setopt($c, CURLOPT_USERAGENT, "Mozilla/5.0 (Windows NT 6.1; Win64; x64; rv:47.0) Gecko/20100101 Firefox/47.0");
          curl_setopt($c, CURLOPT_HTTPHEADER, array('Accept: application/json', 'Content-Type: application/json'));
          $content = curl_exec($c);
          return $content;      
        };
        //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


        function emptyUser($tag) {
          echo '<table>
          <tr>
          <tr id="header">
          <th id="comment" style="border-top-left-radius: 12px;" colspan=2>კომენტარი</th>
          </tr>
          <tr style="background-color: black;">
          <td style="color: white"; colspan=2 >'
          . $tag . '</td>
          </tr>
          </table>';
        }; //table with comment for empty results for existing user
?>