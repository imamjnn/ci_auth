<!DOCTYPE html>
<html ng-app="authPage">
<head>
	<title>Auth</title>
	<?php $this->view('partial/head') ?>
</head>
<body>

	<div ng-controller="AppCtrl">
		<div layout="row" layout-align="center none">
			<md-card flex="30">
				<md-tabs md-dynamic-height md-border-bottom>
			      <md-tab label="login">
			        <md-content class="md-padding">
			          	<form name="userForm">
							<md-input-container class="md-block" flex-gt-sm>
		          				<label>Username</label>
		          				<input md-maxlength="13" required name="username" ng-model="user.username"/>
					          	<div ng-messages="userForm.username.$error">
						            <div ng-message="required">Username is required.</div>
						            <div ng-message="md-maxlength">Username is too short.</div>
					          	</div>
		        			</md-input-container>
		        			<md-input-container class="md-block" flex-gt-sm>
		        				<label>Password</label>
		          				<input type="password" required name="password" ng-model="user.password" />
					          	<div ng-messages="userForm.password.$error" ng-if="!showHints">
						            <div ng-message="required">Password is required.</div>
					          	</div>
		        			</md-input-container>
		        			<md-button type="submit" class="md-raised">Login</md-button>
		        		</form>
			        </md-content>
			      </md-tab>
			      <md-tab label="register">
			        <md-content class="md-padding">
				        <form name="userForm">
							<md-input-container class="md-block" flex-gt-sm>
		          				<label>Username</label>
		          				<input md-maxlength="10" required name="username" ng-model="user.username" />
					          	<div ng-messages="userForm.username.$error">
						            <div ng-message="required">Username is required.</div>
						            <div ng-message="md-maxlength">The username has to be less than 10 characters long.</div>
					          	</div>
		        			</md-input-container>
		        			<md-input-container class="md-block" flex-gt-sm>
		        				<label>Password</label>
		          				<input type="password" required name="password" ng-model="user.password" />
					          	<div ng-messages="userForm.password.$error" ng-if="!showHints">
						            <div ng-message="required">Password is required.</div>
					          	</div>
		        			</md-input-container>
		        			<md-input-container class="md-block" flex-gt-sm>
		        				<label>Confirm Password</label>
		          				<input type="password" required name="confirm_password" ng-model="user.confirm_password" compare-to="user.password"/>
					          	<div ng-messages="userForm.confirm_password.$error" ng-if="!showHints">
						            <div ng-message="required">Password is required.</div>
						            <div ng-message="compareTo">Must not match</div>
					          	</div>
		        			</md-input-container>
		        			<md-button type="submit" class="md-raised">Register</md-button>
		        		</form>
			        </md-content>
			      </md-tab>
			    </md-tabs>
			</md-card>
		</div>

	</div>

  	<?php $this->view('partial/foot') ?>
  	<!-- Your application bootstrap  -->
  	<script>
    	var app = angular.module('authPage', ['ngMaterial', 'ngMessages']);

		app.controller('AppCtrl', function($scope) {
			$scope.showHints = false;
		  	$scope.title1 = 'Button';
		  	$scope.title4 = 'Warn';
		  	$scope.isDisabled = true;
		  	$scope.user = {
	      		username: "",
	      		password: "",
	      		confirm_password: ""
    		};
		})
		.config(function($mdThemingProvider){
			$mdThemingProvider.theme('dark-orange').backgroundPalette('orange').dark();
		})
		.directive('compareTo', compareTo);
		compareTo.$inject = [];

	    function compareTo() {

	        return {
	            require: "ngModel",
	            scope: {
	                compareTolValue: "=compareTo"
	            },
	            link: function(scope, element, attributes, ngModel) {

	                ngModel.$validators.compareTo = function(modelValue) {

	                    return modelValue == scope.compareTolValue;
	                };

	                scope.$watch("compareTolValue", function() {
	                    ngModel.$validate();
	                });
	            }
	        };
	    }

  	</script>

</body>
</html>