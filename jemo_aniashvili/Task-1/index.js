<script>
var username=document.forms['myform']['username'];
    var errors=document.getElementById('error');
    var letters=/^[a-zA-Z]*$/;

    function validation()
    {
      if(username.value=='')
       {
         errors.innerHTML="Both first and last name must be filled in...!!!";
         errors.style.display="block";
          return false;
       }
      
            else if(!username.value.match(letters))
                  {
                     alert("Username and Last Name Must Contain only alphabets");
                     errors.innerHTML="Username and Last Name Must Contain only alphabets";
                     return false;
                  } 
            else if(!username.value=='')
            {
              return true;
              
    }
   }
</script>
