//**********************************************
url_base = "http://tucao-hot.com/index.php";
//=======================================base need change after upload to seriver

angular.module('starter.controllers', [])

.controller('AppCtrl', function($scope, $ionicModal, $timeout) {

    function ajax_index(Id , Cate ){
        $.getJSON( url_base,{ ajax:'ajax',id:Id,cate:Cate},function(Data){
            if(Data=="您访问的页面不存在"){
                alert("无更多内容");
                $(".button_next").remove();
                return;
            }
            $scope.items = $scope.items.concat(Data);
            $scope.$apply();// zhixing    zang check
        });
    }

    $scope.items = [];
    id = 1;
    cate = '';

    ajax_index( id);

    $scope.Next = function(){
        id++;
        ajax_index( id, cate);
    }

    $scope.catepop = function(){
        id = 1;
        cate = 'pop';
        $scope.items = [];
        ajax_index( id, cate);
    }

  // Form data for the login modal
  $scope.loginData = {};

  // Create the login modal that we will use later
  $ionicModal.fromTemplateUrl('templates/login.html', {
    scope: $scope
  }).then(function(modal) {
    $scope.modal = modal;
  });

  // Triggered in the login modal to close it
  $scope.closeLogin = function() {
    $scope.modal.hide();
  };

  // Open the login modal
  $scope.login = function() {
    $scope.modal.show();
  };

  // Perform the login action when the user submits the login form
  $scope.doLogin = function() {
    console.log('Doing login', $scope.loginData);

    // Simulate a login delay. Remove this and replace with your login
    // code if using a login system
    $timeout(function() {
      $scope.closeLogin();
    }, 1000);
  };
})

.controller('PlaylistsCtrl', function($scope) {
  $scope.playlists = [
    { title: 'Reggae', id: 1 },
    { title: 'Chill', id: 2 },
    { title: 'Dubstep', id: 3 },
    { title: 'Indie', id: 4 },
    { title: 'Rap', id: 5 },
    { title: 'Cowbell', id: 6 }
  ];
})

.controller('PlaylistCtrl', function($scope, $stateParams) {
});
