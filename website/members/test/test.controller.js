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

        vm.currentQuestionNo = 0;
        function loadTest(){
            vm.tests = JSON.parse($cookieStore.get('tests'));

            loadQuestion(0);


            console.log('test controller',vm.tests);
        }
        vm.uncheck = function (event) {
            if (vm.currentQuestion.response == event.target.value)
                vm.currentQuestion.response = false
        }

        vm.submitResponse = function(){
            console.log('response',vm.response, vm.tests.questions[vm.currentQuestionNo].response_id);
            CandidateService.SubmitRespnse(
                vm.inUser.md5,
                vm.tests.test_id,
                vm.tests.questions[vm.currentQuestionNo].response_id,
                {response:vm.currentQuestion.response})
                .then(function (response) {
                    vm.loadQuestion(vm.currentQuestionNo + 1);
                });

        }

        //vm.currentQuestion = {};
        function loadQuestion(index){

            CandidateService.GetQuestion(vm.inUser.md5, vm.tests.test_id, vm.tests.questions[index].id)
                .then(function (response) {
                    vm.currentQuestion = response.questions[0];


                    console.log(vm.currentQuestion.id);
                });

        }

        vm.loadQuestion = function (index){

            console.log(index);
            CandidateService.GetQuestion(vm.inUser.md5, vm.tests.test_id, vm.tests.questions[index].id)
                .then(function (response) {
                    vm.currentQuestion = response.questions[0];
                    vm.currentQuestionNo = index;

                    console.log(vm.currentQuestion.id);
                });

        }

        $timeout(function() {
            vm.showResults();
        }, 3000);

        vm.showResults = function(){
            CandidateService.ShowResults(vm.inUser.md5, vm.tests.test_id)
                .then(function (response) {

                    $cookieStore.put('tests', '');

                    console.log(response);
                    $location.path('/test/'+vm.tests.test_id+'/result');
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