(function () {
    'use strict';

    angular
        .module('app')
        .controller('TestController', TestController);

    TestController.$inject = ['UserService', '$cookieStore', 'CandidateService', '$rootScope', 'FlashService','$location'];
    function TestController(UserService, $cookieStore, CandidateService,  $rootScope, FlashService,$location) {
        var vm = this;

        vm.user = null;
        vm.inUser = null;
        vm.allUsers = [];
        vm.deleteUser = deleteUser;
        vm.loadUser = loadUser;

        vm.champs = 0;
        vm.good = 0;
        vm.improve = 0;
        vm.bad = 0;

        vm.successFilter = true;
        vm.dangerFilter = true;
        vm.warningFilter = true;
        vm.primaryFilter = true;

        vm.threeMonths = [];
        vm.whichMonth = {};
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
            loadTest();

        }

        vm.setCurrentMon = function(){
            //console.log("i am in setCurrentMonth",vm.currentMonthIndex);

            vm.whichMonth.name = vm.threeMonths[vm.currentMonthIndex].name;
            vm.whichMonth.num = vm.threeMonths[vm.currentMonthIndex].num;
            console.log("i am in setCurrentMonth",vm.whichMonth);
            loadToCallCandidates();

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

        vm.loadQuestion = 0;
        function loadTest(){
            vm.tests = JSON.parse($cookieStore.get('tests'));

            console.log('test controller',vm.tests);
        }

        vm.loadQuestion = function(index){

            CandidateService.GetQuestion(vm.inUser.md5, vm.tests.questions[index].id)
                .then(function (response) {

                    console.log(response);
                });

        }

        vm.loadToCallCandidates = loadToCallCandidates;




        function loadToCallCandidates(){
            vm.dataLoading = true;

            CandidateService.GetAll(vm.inUser.company_name,vm.inUser.md5_id,(vm.whichMonth.num+1))
                .then(function (response) {
                    vm.toCallCandidates = response.employees;

                    vm.date1 = new Date(2016, vm.whichMonth.num+1, 0).getDate();
                    if(vm.currentMonthIndex == 0)
                        vm.date1 = new Date().getDate();



                    for(var i=0;i < vm.toCallCandidates.length ; i++){

                        vm.champs += (vm.getColor(vm.toCallCandidates[i].time) == "primary")?1:0;
                        vm.good += (vm.getColor(vm.toCallCandidates[i].time) == "success")?1:0;
                        vm.improve += (vm.getColor(vm.toCallCandidates[i].time) == "warning")?1:0;
                        vm.bad += (vm.getColor(vm.toCallCandidates[i].time) == "danger")?1:0;
                    }
                    vm.dataLoading = false;

                    console.log(vm.toCallCandidates[1].name);
                });

        }

        /*function loadCurrentUser() {
            UserService.GetByUsername($rootScope.globals.currentUser.username)
                .then(function (user) {
                    vm.user = user;
                });
        }*/

        function loadAllUsers() {
            UserService.GetAll()
                .then(function (users) {
                    vm.allUsers = users;
                });
        }

        function deleteUser(id) {
            UserService.Delete(id)
            .then(function () {
                loadAllUsers();
            });
        }





    }

})();