<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8">
        <title>CRUD</title>

           
        
        <script src="http://ajax.googleapis.com/ajax/libs/angularjs/1.3.15/angular.min.js"></script>
        
        
        <script>

          var app = angular.module('myApp', []);
          app.controller('planetController', function($scope, $http) {
            
            


            $http.get("http://localhost/crud/data.php")
            .success(function(response) 
                {
                    $scope.data = response;
                    
                    //if($scope.session.id==null){window.location.assign("login.html");}else{}           
                
                });

            $scope.hapus = function(username) {
                

                $http({
                    url: "http://localhost/crud/hapus.php?username="+username,
                    method: "GET",
                    
                })
                .then(function(response) {
                        
                        $http.get("http://localhost/crud/data.php")
                        .success(function(response) 
                        {
                            $scope.data = response;
                            
                        });

                        //$scope.report = response;
                        console.log(response);
                }, 
                function(response) { // optional
                        console.log(response);
                        console.log("Gagal!");
                });
                
            } 
            
            




          });
         
        </script>

        
    </head>

<a href="add.php">Tambah</a>


    <body ng-app="myApp" ng-controller="planetController">

        <table style="width:100%" border="1">
          <tr >
            <th>Username</th>
            <th>Password</th>
            <th>Fullname</th>
            <th>City</th> 
            <th>Status</th>
            <th>Aksi</th>
          </tr>
          <tr ng-repeat="x in data">
            <td>{{x.username}}</td>
            <td>{{x.password}}</td> 
            <td>{{x.fullname}}</td> 
            <td>{{x.city}}</td>
            <td>{{x.status}}</td>
            <td><a href="edit.php?username={{x.username}}">Edit</a> <a href="#" ng-click="hapus(username= x.username)">Hapus</a></td>
          </tr>
          
</table>
        


  
     
    </body>
</html>
