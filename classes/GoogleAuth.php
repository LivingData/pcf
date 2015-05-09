 <?php
 
 class GoogleAuth
 {
   protected $client;
   public function __construct(Google_Client $googleClient =null)
   {
     $this->client = $googleClient;
     if($this->client)
     {

       $this->client->setClientId('273747309689-otbleg4l4f706au8cc600j4e0nat3ipt.apps.googleusercontent.com');
       $this->client->setClientSecret('JAK5wQ6GIEdKu9l2tPg7WHum');
       $this->client->setRedirectUri('http://goo.gl/ZU0mWU');//('http://localhost/pcf/index.php ');
       $this->client->setScopes ('email');

     }
   }
   public function isLoggedIn()
   {
     return isset($_SESSION['access_token']);

     
   }
     public function getAuthUrl()
     {
      return $this->client->createAuthUrl();
     }

     public function checkRedirectCode()
     {

     if (isset($_GET['code']))
     {

      $this->client->authenticate($_GET['code']);
      $this->setToken($this->client->getAccessToken());

      return true;
     }
      echo "IcheckRedirectCode";
     return false;
     }
     
     public function setToken($token)
     {
       $_SESSION['access_token']=$token;
       
       $this->client->setAccessToken($token);
     }
 }