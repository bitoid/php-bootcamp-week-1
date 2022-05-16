<!DOCTYPE html>
<html lang="en">
<head>
	<meta name="viewport" content="width=device-width, initial-scale=1">
    <link href="https://netdna.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css" rel="stylesheet">
	<style>

body{
    margin-top:20px;
    background:#eee;
}

.avatar {
    position: relative;
    display: inline-block;
    width: 40px;
    white-space: nowrap;
    border-radius: 1000px;
    vertical-align: bottom
}

.avatar i {
    position: absolute;
    right: 0;
    bottom: 0;
    width: 10px;
    height: 10px;
    border: 2px solid #fff;
    border-radius: 100%
}

.avatar img {
    width: 100%;
    max-width: 100%;
    height: auto;
    border: 0 none;
    border-radius: 1000px
}

.avatar-online i {
    background-color: #4caf50
}

.avatar-off i {
    background-color: #616161
}

.avatar-busy i {
    background-color: #ff9800
}

.avatar-away i {
    background-color: #f44336
}

.avatar-100 {
    width: 100px
}

.avatar-100 i {
    height: 20px;
    width: 20px
}

.avatar-lg {
    width: 50px
}

.avatar-lg i {
    height: 12px;
    width: 12px
}

.avatar-sm {
    width: 30px
}

.avatar-sm i {
    height: 8px;
    width: 8px
}

.avatar-xs {
    width: 20px
}

.avatar-xs i {
    height: 7px;
    width: 7px
}

.list-group-item {
    position: relative;
    display: block;
    padding: 10px 15px;
    margin-bottom: -1px;
    background-color: #fff;
    border: 1px solid transparent;
}

</style>
</head>
<body>

<div class="container">
<div class="row bootstrap snippets bootdey">
    <div class="col-md-8 col-xs-12">
      <div class="panel" id="followers">
        <div class="panel-heading">
		<h1>დავალება N2: </h1>
          <h3 class="panel-title">
            <form action="<?=htmlspecialchars($_SERVER["PHP_SELF"]);?>" method="POST" enctype="multipart/form-data">
				

				<div class="form-outline mb-4">
				  <input type="text" name="username" class="form-control form-control-lg" placeholder="GitHub Username" />
				</div>

				<div class="form-outline mb-4">
					<select name="type">
					  <option value="repos" selected>Repositories</option>
					  <option value="followers">Followers</option>
					</select>
				</div>
			<input type="submit" value="ინფო" class="btn btn-primary btn-block mb-4">
			</form>
          </h3>
        </div>
<?php
if ($_SERVER["REQUEST_METHOD"] == "POST") {


function get_api( $url )
    {
        $user_agent='Mozilla/5.0 (Windows NT 6.1; rv:8.0) Gecko/20100101 Firefox/8.0';

        $options = array(

            CURLOPT_CUSTOMREQUEST  => "GET",
            CURLOPT_POST           => false,
            CURLOPT_USERAGENT      => $user_agent,
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_HEADER         => false,
            CURLOPT_FOLLOWLOCATION => true,
            CURLOPT_ENCODING       => "",
            CURLOPT_AUTOREFERER    => true,     
            CURLOPT_CONNECTTIMEOUT => 120,
            CURLOPT_TIMEOUT        => 120,
            CURLOPT_MAXREDIRS      => 10,
        );

        $ch      = curl_init( $url );
        curl_setopt_array( $ch, $options );
        $content = curl_exec( $ch );
        $err     = curl_errno( $ch );
        $errmsg  = curl_error( $ch );
        $header  = curl_getinfo( $ch );
        curl_close( $ch );

        $header['errno']   = $err;
        $header['errmsg']  = $errmsg;
        $header['content'] = $content;
        return $header;
    }

$url = "https://api.github.com/users/".$_POST['username']."/".$_POST['type']."";
$result = get_api($url);

if ($result['errno'] != 0) echo 'შეცდომა: არასწორი მისამართი';
if ($result['http_code'] != 200) echo 'შეცდომა: არ არის შედეგი';

$page = json_decode($result['content'], true);

foreach($page as $data)
{
	if (!$data['message'] == "Not Found")
		{
	
		if (strpos($_POST['type'], 'repos') !== false)
		{
		
		?>
     <div class="panel-body">
          <ul class="list-group list-group-dividered list-group-full">
            <li class="list-group-item">
              <div class="media">
                <div class="media-left">
                  <a class="avatar avatar-online" href="<?php echo $data['html_url']; ?>">
                    <img src="<?php echo $data['owner']['avatar_url']; ?>" alt="">
                  </a>
                </div>
                <div class="media-body">
                  <div><a class="name" href="<?php echo $data['html_url']; ?>"><?php echo $data['full_name']; ?></a></div>
                  <small><?php echo $data['html_url']; ?></small>
                </div>
              </div>
            </li>
          </ul>
        </div>
	<hr/>
<?php
		} 
		else 
		{
?>


        <div class="panel-body">
          <ul class="list-group list-group-dividered list-group-full">
            <li class="list-group-item">
              <div class="media">
                <div class="media-left">
                  <a class="avatar avatar-online" href="<?php echo $data['html_url']; ?>">
                    <img src="<?php echo $data['avatar_url']; ?>" alt="">
                  </a>
                </div>
                <div class="media-body">
                  <div><a class="name" href="<?php echo $data['html_url']; ?>"><?php echo $data['login']; ?></a></div>
                  <small><?php echo $data['html_url']; ?></small>
                </div>
              </div>
            </li>
          </ul>
        </div>
	<hr/>

<?php
			}
		}
	}
}

?>
		</div>
	</div>
</div>
</div>

</body>
</html>