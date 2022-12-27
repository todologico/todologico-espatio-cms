var myapp = angular.module('ZGFCP_Cate1App', []);

myapp.controller('ZGFCP_Cate1Controller', ['$scope','$http','$timeout', function($scope,$http,$timeout) {

  // order alert
  $scope.orderok = false;  

//----------------------------------------------------------
// publish or hide banner pro
//----------------------------------------------------------
$scope.ShowHideAR = function(zgfcp_cate1_id,zgfcp_cate1_token,button) {

    $scope.zgfcp_cate1_id = zgfcp_cate1_id;  
    $scope.zgfcp_cate1_token = zgfcp_cate1_token;

    if($scope.zgfcp_cate1_id) { 
      if($scope.zgfcp_cate1_token) { 

          var miJson={'zgfcp_cate1_id':$scope.zgfcp_cate1_id, 'zgfcp_cate1_token':$scope.zgfcp_cate1_token,'button': button};

          $http({method: 'POST',url: '/zgfcp-cate1-publish-pro', data: $.param(miJson),headers: {'Content-Type': 'application/x-www-form-urlencoded;charset=utf-8'}}).then(function(response) {
                                   
            $scope.status = response.status;
            $scope.backarray = response.data; 

            switch (button) {
              
              //-----------------------------------------
              // zgfcp_cate1_enable=='1' (publicado)
              //-----------------------------------------
              
              case '1': //publicado1 to suspendido 2

                //myurl='/banners-hidden-pro';
                $scope['butt1on'+$scope.backarray.zgfcp_cate1_id] = true; //ng-hide
                $scope['butt2on'+$scope.backarray.zgfcp_cate1_id] = true; //ng-show
                $scope['bcolor'+$scope.backarray.zgfcp_cate1_id] = { "background-color": "#FFEAE7" };
                break;

              //-----------------------------------------
                
              case '2': //suspendido2 to publicado1

                //myurl='/banners-publish-pro';
                $scope['butt1on'+$scope.backarray.zgfcp_cate1_id] = false; //ng-hide
                $scope['butt2on'+$scope.backarray.zgfcp_cate1_id] = false; //ng-show
                $scope['bcolor'+$scope.backarray.zgfcp_cate1_id] = { "background-color": "#EBF9E4" };
                break;
      
              //-----------------------------------------
              // zgfcp_cate1_enable=='0' (SUSPENDIDO)
              //-----------------------------------------
              
              case '3': //suspendido3 to publicado4

                //myurl='/banners-publish-pro';
                $scope['butt3on'+$scope.backarray.zgfcp_cate1_id] = true; //ng-hide
                $scope['butt4on'+$scope.backarray.zgfcp_cate1_id] = true; //ng-show
                $scope['bcolor'+$scope.backarray.zgfcp_cate1_id] = { "background-color": "#EBF9E4" };
                break;

              //-----------------------------------------              
              case '4': //publicado4 to suspendido3

                //myurl='/banners-hidden-pro';
                $scope['butt3on'+$scope.backarray.zgfcp_cate1_id] = false; //ng-hide
                $scope['butt4on'+$scope.backarray.zgfcp_cate1_id] = false; //ng-show
                $scope['bcolor'+$scope.backarray.zgfcp_cate1_id] = { "background-color": "#FFEAE7" };                
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
$scope.OrderAR = function(zgfcp_cate1_id,zgfcp_cate1_token,order) {

    $scope.zgfcp_cate1_id = zgfcp_cate1_id;  
    $scope.zgfcp_cate1_token = zgfcp_cate1_token;

    if($scope.zgfcp_cate1_id) { 
      if($scope.zgfcp_cate1_token) { 

          var miJson={'zgfcp_cate1_id':$scope.zgfcp_cate1_id, 'zgfcp_cate1_token':$scope.zgfcp_cate1_token,'order': order};

          $http({method: 'POST',url: '/zgfcp-cate1-order-pro', data: $.param(miJson),headers: {'Content-Type': 'application/x-www-form-urlencoded;charset=utf-8'}}).then(function(response) {
                                   
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