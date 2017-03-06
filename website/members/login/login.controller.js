(function () {
    'use strict';

    angular
        .module('app')
        .controller('LoginController', LoginController);

    LoginController.$inject = ['$location', 'UserService', 'CandidateService', 'AuthenticationService', 'FlashService'];
    function LoginController($location, UserService, CandidateService, AuthenticationService, FlashService) {
        var vm = this;

        vm.login = login;
        vm.user = {};
        vm.user.username = "";
        vm.user.password = "";
        vm.inUser = null;

            (function initController() {
            // reset login status
            //vm.inUser = UserService.GetInUser();
            if(vm.inUser){

                    $location.path('/member');
            }else{

                CandidateService.GetExams(''
                    )
                    .then(function (response) {
                        console.log("resp",response);

                        vm.exams = response.exams;
                        console.log("exams",vm.exams);
                    });

            AuthenticationService.ClearCredentials();
            }
        })();



        vm.reg = function(){
            vm.dataLoadingReg = true;
            CandidateService.Create(vm.user
                )
                .then(function (response) {
                    console.log("resp",response);

                    if (response.results.id) {
                        AuthenticationService.SetCredentials(vm.user.reg_username, vm.user.reg_password);
                        vm.inUser = response.results;
                        vm.dataLoadingReg = false;

                        vm.showVerification = true;

                        console.log("auth success");
                        //$location.path('/member');

                    } else {
                        FlashService.Error(response.error.text);
                        vm.dataLoading = false;
                    }
                });

            console.log(vm.user);
        };

        vm.checkOTP = function(type){
          CandidateService.CheckOTP(vm.inUser.userMd5,type,vm.user[type+'_otp']
              )
              .then(function (response) {
                  console.log("resp",response);

                  if (response.auth == "true") {
                      alert('auth success');
                      vm.user.mobile_verified = true;
                  } else {
                      FlashService.Error(response.error.text);
                      vm.dataLoading = false;
                  }
              });

            console.log(vm.user);
        };


        function login() {
            vm.dataLoading = true;
            AuthenticationService.Login(vm.user, function (resp) {
                console.log("resp",resp);

                if (resp.success) {
                    AuthenticationService.SetCredentials(vm.user.username, vm.user.password);
                    vm.inUser = UserService.GetInUser();

                    console.log("auth success");
                        $location.path('/member');

                } else {
                    FlashService.Error(resp.message);
                    vm.dataLoading = false;
                }
            });
        };
    }

})();
