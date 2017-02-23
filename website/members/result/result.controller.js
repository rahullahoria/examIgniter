(function () {
    'use strict';

    angular
        .module('app')
        .controller('ResultController', ResultController);

    ResultController.$inject = ['UserService',  'CandidateService', '$routeParams', 'FlashService','$location'];
    function ResultController(UserService, CandidateService,  $routeParams, FlashService,$location) {
        var vm = this;

        vm.user = null;
        vm.inUser = null;
        vm.allUsers = [];

        vm.loadUser = loadUser;


        vm.loadUser = loadUser;
        vm.currentMonthIndex = 0;
        vm.dataLoading = false;

        initController();

        function initController() {
          //  loadCurrentUser();
           // loadAllUsers();

            //loadMonths();
            loadUser();
            //loadToCallCandidates();
            showResults();

        }

        function showResults (){
            CandidateService.ShowResults(vm.inUser.md5, $routeParams.test)
                .then(function (response) {
                    vm.results = response.results;


                    console.log(response);

                });

        }


        vm.logout = function(){
            vm.inUser = null;
            UserService.DeleteInUser();
            $location.path('#/login');
        };

        function loadUser(){
            vm.inUser = UserService.GetInUser();
            /*if(!vm.inUser.name)
                $location.path('/login');
            */console.log("in user",vm.inUser);


        }


    }

})();