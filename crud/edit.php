<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8">
        <title>Edit</title>

        <script src="http://ajax.googleapis.com/ajax/libs/angularjs/1.3.15/angular.min.js"></script>
        
        <script type="text/javascript">
             var username = location.search.split('username=')[1]
            
        </script>
        <script>

          var app = angular.module('myApp', []);
          app.controller('planetController', function($scope, $http) {
            

            $http.get("http://localhost/crud/data.php?username="+username)
            .success(function(response) 
                {
                    $scope.data = response;
                    
                    
                
                });

             
            
          });
         
        </script>
      

         
    </head>
    <body ng-app="myApp" ng-controller="planetController">

         
                            <form method="post" action="http:\\localhost\crud\update.php" id="customer_login" accept-charset="UTF-8">
                            <table style="" border="1">
                            <tr >
                                <th>Username</th><th><input type="text" name="username" spellcheck="false" autocomplete="off" autocapitalize="off" autofocus 
                                value="{{data[0].username}}" readonly> </th>
                            </tr>
                            <tr >
                                <th>Password</th><th><input type="password" name="password" id="CustomerPassword" class=""
                                    value="{{data[0].password}}"></th>
                            </tr>
                            <tr >
                                <th>Fullname</th><th><input type="text" name="fullname"
                                    value="{{data[0].fullname}}"></th>
                            </tr>
                            <tr >    
                                <th>City</th> <th><input type="text" name="city"
                                    value="{{data[0].city}}"></th>
                            </tr>
                            <tr >    
                                <th>Status</th><th><input type="text" name="status"
                                    value="{{data[0].status}}"></th>
                            </tr>
                                
                              </tr></table>


                            <input type="submit" class="btn-large z-depth-0" value="Simpan">
        
        
                          
        

      
    </body>
</html>
