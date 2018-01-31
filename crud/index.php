<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8">
        <title>CRUD</title>

           
        
        <script src="http://ajax.googleapis.com/ajax/libs/angularjs/1.3.15/angular.min.js"></script>
        
        
        <script>

          var app = angular.module('myApp', []);
          app.controller('planetController', function($scope, $http) {
            
            //Pagination setting
            $scope.currentPage = 0;
            $scope.pageSize = 2;
            $scope.data = [];


            $http.get("http://localhost/crud/data.php")
            .success(function(response) 
                {
                    $scope.list = response;
                    $scope.numberOfPages=function(){
                    return Math.ceil($scope.data.length/$scope.pageSize);                
                    }


                    angular.forEach($scope.list, function(value, key){
                        $scope.data.push(value);
                     
                    });

                    console.log($scope.data);
                
                    
                
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
            $scope.search = function() {
                $http({
                    url: "http://localhost/crud/data.php",
                    method: "GET",
                    params: { 
                        'username' : $scope.username,
                        'password' : $scope.password,
                        'fullname' : $scope.fullname,
                        'city' : $scope.city,
                        'status' : $scope.status,
            
                    }
                    
                })
                .then(function(response) {
                        
                        $scope.data = response.data;
                        console.log($scope.data);
                }, 
                function(response) { // optional
                        console.log(response);
                        console.log("Gagal!");
                });

                
            }  
 
          });

          //Import Filter
            app.filter('startFrom', function() {
                return function(input, start) {
                    start = +start; //parse to int
                    return input.slice(start);
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
          <tr >
            <th><input type="text" name="username" ng-model="username" ng-change="search()"></th>
            <th><input type="text" name="password" ng-model="password" ng-change="search()"></th>
            <th><input type="text" name="fullname" ng-model="fullname" ng-change="search()"></th>
            <th><input type="text" name="city" ng-model="city" ng-change="search()"></th>
            <th><input type="text" name="status" ng-model="status" ng-change="search()"></th>
            <th></th>
          </tr>
          <tr ng-repeat="x in data | startFrom:currentPage*pageSize | limitTo:pageSize">
            <td>{{x.username}}</td>
            <td>{{x.password}}</td> 
            <td>{{x.fullname}}</td> 
            <td>{{x.city}}</td>
            <td>{{x.status}}</td>
            <td><a href="edit.php?username={{x.username}}">Edit</a> <a href="#" ng-click="hapus(username= x.username)">Hapus</a></td>
          </tr>
          
</table>


    
    <button ng-disabled="currentPage == 0" ng-click="currentPage=currentPage-1">
        Previous
    </button>
    {{currentPage+1}}/{{numberOfPages()}}
    <button ng-disabled="currentPage >= data.length/pageSize - 1" ng-click="currentPage=currentPage+1">
        Next
    </button>
 

  
     
    </body>

    
</html>
