<!DOCTYPE html>
<html ng-app="authPage">
<head>
	<title>Auth</title>
	<?php $this->view('partial/head') ?>
</head>
<body>

	<div ng-controller="AppCtrl">
		
		<md-content layout="row" layout-align="space-around" layout-padding="layout-padding" ng-cloak="ng-cloak">
			<md-card flex="flex" flex-gt-sm="50" flex-gt-md="33">
				<md-toolbar>
					<div class="md-toolbar-tools">
            			<h2><span>Login Auth</span></h2>
          			</div>
				</md-toolbar>
				<div layout="row" layout-sm="column" layout-align="space-around">
      				<md-progress-circular ng-show="isLoading" md-mode="indeterminate"></md-progress-circular>
    			</div>
				<md-card-content>
					<form name="FormLogin" ng-submit="onSubmit()" novalidate>
						<md-input-container class="md-block" flex-gt-sm>
	          				<label>Username</label>
	          				<input type="text" required name="username" ng-model="user.username"/>
				          	<div ng-messages="FormLogin.username.$error">
					            <div ng-message="required">Please enter your username.</div>
				          	</div>
	        			</md-input-container>
	        			<md-input-container class="md-block" flex-gt-sm>
	        				<label>Password</label>
	          				<input type="password" required name="password" ng-model="user.password" />
				          	<div ng-messages="FormLogin.password.$error" ng-if="!showHints">
					            <div ng-message="required">Please enter your password.</div>
				          	</div>
	        			</md-input-container>
	        			<md-button ng-disabled="!FormLogin.$valid" type="submit" class="md-raised md-primary">
	        				Login
	        			</md-button>
					</form>
				</md-card-content>
			</md-card>
		</md-content>

	</div>

  	<?php $this->view('partial/foot') ?>
  	<!-- Your application bootstrap  -->
  	<script>
    	var app = angular.module('authPage', ['ngMaterial', 'ngMessages']);

		app.controller('AppCtrl', function($scope, $http, $location, $mdToast) {
			$scope.showHints = false;
		  	$scope.isDisabled = true;
		  	$scope.isLoading = false;
		  	$scope.user = {
	      		username: "",
	      		password: ""
    		};

    		$scope.onSubmit = function(){
    			$scope.isLoading = true;
    			var login = {
	    			method: 'POST',
	    			url: 'http://localhost:4545/ci_auth/auth/check_login',
	    			headers: {
	    				'Content-Type': 'application/x-www-form-urlencoded'
	    			},
	    			data: {
	    				'username': $scope.user.username,
	    				'password': $scope.user.password
	    			}
	    		};
	    		$http(login).then(function(res){
	    			$scope.isLoading = false;
	    			if(res.data.status === 'success'){
	    				console.log('login berhasil, selanjutnya terserah anda');
	    			}else{
	    				$mdToast.show(
      						$mdToast.simple()
					        .textContent(res.data.message)
					        .position('top')
					        .hideDelay(3000)
					    );
	    			}
	    		});
    		}

    		
		})
		.config(function($mdThemingProvider){
			$mdThemingProvider.theme('dark-orange').backgroundPalette('orange').dark();
		});
  	</script>

</body>
</html>