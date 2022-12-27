var myapp = angular.module('AAB_Bann1App', []);

myapp.controller('AAB_Bann1Controller', ['$scope','$http','$timeout', function($scope,$http,$timeout) {

  // order alert
  $scope.orderok = false;  

//----------------------------------------------------------
// publish or hide banner pro
//----------------------------------------------------------
$scope.ShowHideBannersAR = function(aab_bann1_id,aab_bann1_token,button) {

    $scope.aab_bann1_id = aab_bann1_id;  
    $scope.aab_bann1_token = aab_bann1_token;

    if($scope.aab_bann1_id) { 
      if($scope.aab_bann1_token) { 

          var miJson={'aab_bann1_id':$scope.aab_bann1_id, 'aab_bann1_token':$scope.aab_bann1_token,'button': button};

          $http({method: 'POST',url: '/aab-bann1-publish-pro', data: $.param(miJson),headers: {'Content-Type': 'application/x-www-form-urlencoded;charset=utf-8'}}).then(function(response) {
                                   
            $scope.status = response.status;
            $scope.backarray = response.data; 
            //console.log($scope.backarray);

            switch (button) {
              
              //-----------------------------------------
              // aab_bann1_enable=='1' (publicado)
              //-----------------------------------------
              
              case '1': //publicado1 to suspendido 2

                //myurl='/banners-hidden-pro';
                $scope['butt1on'+$scope.backarray.aab_bann1_id] = true; //ng-hide
                $scope['butt2on'+$scope.backarray.aab_bann1_id] = true; //ng-show
                $scope['bcolor'+$scope.backarray.aab_bann1_id] = { "background-color": "#FFEAE7" };
                break;

              //-----------------------------------------
                
              case '2': //suspendido2 to publicado1

                //myurl='/banners-publish-pro';
                $scope['butt1on'+$scope.backarray.aab_bann1_id] = false; //ng-hide
                $scope['butt2on'+$scope.backarray.aab_bann1_id] = false; //ng-show
                $scope['bcolor'+$scope.backarray.aab_bann1_id] = { "background-color": "#EBF9E4" };
                break;
      
              //-----------------------------------------
              // aab_bann1_enable=='0' (SUSPENDIDO)
              //-----------------------------------------
              
              case '3': //suspendido3 to publicado4

                //myurl='/banners-publish-pro';
                $scope['butt3on'+$scope.backarray.aab_bann1_id] = true; //ng-hide
                $scope['butt4on'+$scope.backarray.aab_bann1_id] = true; //ng-show
                $scope['bcolor'+$scope.backarray.aab_bann1_id] = { "background-color": "#EBF9E4" };
                break;

              //-----------------------------------------              
              case '4': //publicado4 to suspendido3

                //myurl='/banners-hidden-pro';
                $scope['butt3on'+$scope.backarray.aab_bann1_id] = false; //ng-hide
                $scope['butt4on'+$scope.backarray.aab_bann1_id] = false; //ng-show
                $scope['bcolor'+$scope.backarray.aab_bann1_id] = { "background-color": "#FFEAE7" };                
                break;
            }

          }, function(response) {
                                   
            $scope.data = response.data || 'Request failed';
            $scope.status = response.status;
                    
          }); 
           
      }  
    }  
}

//----------------------------------------------------------
// hide alert "updated succesfull" after 2 seconds
//----------------------------------------------------------

$scope.HideAlertTime = function() {
      $scope.orderok = true;
      $timeout(function() {
         $scope.orderok = false;
      }, 2500);
};

//----------------------------------------------------------
// order banner pro
//----------------------------------------------------------
$scope.OrderBannersAR = function(aab_bann1_id,aab_bann1_token,order) {

    $scope.aab_bann1_id = aab_bann1_id;  
    $scope.aab_bann1_token = aab_bann1_token;

    if($scope.aab_bann1_id) { 
      if($scope.aab_bann1_token) { 

          var miJson={'aab_bann1_id':$scope.aab_bann1_id, 'aab_bann1_token':$scope.aab_bann1_token,'order': order};

          $http({method: 'POST',url: '/aab-bann1-order-pro', data: $.param(miJson),headers: {'Content-Type': 'application/x-www-form-urlencoded;charset=utf-8'}}).then(function(response) {
                                   
            $scope.status = response.status;
            $scope.backarray = response.data; 

             $scope.HideAlertTime();

             //$scope.orderok = true;  
            //console.log($scope.backarray);            

          }, function(response) {
                                   
            $scope.data = response.data || 'Request failed';
            $scope.status = response.status;
                    
          }); 
           
      }  
    }  
}



//----------------
}]);