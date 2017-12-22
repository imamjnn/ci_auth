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
				<md-card-content>
					<form name="FormLogin" novalidate>
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
	        			<md-button ng-disabled="!FormLogin.$valid" type="submit" class="md-raised md-primary">Login</md-button>
					</form>
				</md-card-content>
			</md-card>
		</md-content>

	</div>

  	<?php $this->view('partial/foot') ?>
  	<!-- Your application bootstrap  -->
  	<script>
    	var app = angular.module('authPage', ['ngMaterial', 'ngMessages']);

		app.controller('AppCtrl', function($scope) {
			$scope.showHints = false;
		  	$scope.isDisabled = true;
		  	$scope.user = {
	      		username: "",
	      		password: ""
    		};
		})
		.config(function($mdThemingProvider){
			$mdThemingProvider.theme('dark-orange').backgroundPalette('orange').dark();
		});
  	</script>

</body>
</html>