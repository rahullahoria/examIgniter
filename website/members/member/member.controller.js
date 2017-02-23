(function () {
    'use strict';

    angular
        .module('app')
        .controller('MemberController', MemberController);

    MemberController.$inject = ['UserService', '$cookieStore', 'CandidateService', '$rootScope', 'FlashService','$location'];
    function MemberController(UserService, $cookieStore, CandidateService,  $rootScope, FlashService,$location) {
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
        vm.subjectTotalQ = 0;

        initController();

        function initController() {
          //  loadCurrentUser();
           // loadAllUsers();

            //loadMonths();
            loadUser();
            loadToCallCandidates();

        }

        vm.setCurrentMon = function(){
            //console.log("i am in setCurrentMonth",vm.currentMonthIndex);

            vm.whichMonth.name = vm.threeMonths[vm.currentMonthIndex].name;
            vm.whichMonth.num = vm.threeMonths[vm.currentMonthIndex].num;
            console.log("i am in setCurrentMonth",vm.whichMonth);
            loadToCallCandidates();

        }

        function loadMonths(){
            var months = new Array(12);
            months[0] = "January";
            months[1] = "February";
            months[2] = "March";
            months[3] = "April";
            months[4] = "May";
            months[5] = "June";
            months[6] = "July";
            months[7] = "August";
            months[8] = "September";
            months[9] = "October";
            months[10] = "November";
            months[11] = "December";

            var myDate = new Date();
            vm.whichMonth.name = months[myDate.getMonth()];
            vm.whichMonth.num = myDate.getMonth();
            vm.threeMonths[0] = {"name":months[myDate.getMonth()],"num":myDate.getMonth()};
            vm.threeMonths[1] = {"name":months[myDate.getMonth()-1], "num":myDate.getMonth()-1};
            vm.threeMonths[2] = {"name":months[myDate.getMonth()-2],"num":myDate.getMonth()-2};
            console.log(vm.threeMonths);
        }

        vm.logout = function(){
            vm.inUser = null;
            UserService.DeleteInUser();
            $location.path('#/login');
        };

        function loadUser(){
            vm.inUser = UserService.GetInUser();
            if(!vm.inUser.name)
                $location.path('/login');
            console.log("in user",vm.inUser);


        }
        vm.startTest = function(topicId,noOfQuestion){
            console.log(topicId);

            CandidateService.StartTest(vm.inUser.md5,
                    {
                    "topic_id":topicId,
                    "no_of_question":noOfQuestion
                     }
                )
                .then(function (response) {
                    vm.subjects = response.response;

                    console.log('member',vm.subjects);

                    $cookieStore.put('test_id', JSON.stringify(vm.subjects.test_id));
                    $cookieStore.put('no_of_questions', JSON.stringify(noOfQuestion));
                    for(var i=0; i < noOfQuestion;i++ )
                        $cookieStore.put('question_'+i, JSON.stringify(vm.subjects.questions[i]));


                });


            $location.path('/test');

        }



        vm.loadToCallCandidates = loadToCallCandidates;

        vm.date1 = new Date().getDate();
        vm.getFun = function(work){
           return Math.floor((Math.random() * (work/60/60)) + (work/60/60/4));
        };

        vm.getColor = function(eff){

            eff = (eff/60/60/(vm.date1*6.85))*100;

            //return "danger";

            if(eff <= 30){
                return "danger";
            }
            if(eff <= 60){
                return "warning";
            }
            if(eff <= 80){
                return "success";
            }
            if(eff >= 80){
                return "primary";
            }

        };

        function loadToCallCandidates(){
            vm.dataLoading = true;

            CandidateService.GetStatus(vm.inUser.md5)
                .then(function (response) {
                    vm.subjects = response.subjects;


                    for(var i = 0; i < vm.subjects.length; i++){
                        var temp = 0;
                        for(var j = 0; j< vm.subjects[i].topics.length; j++){
                            temp += vm.subjects[i].topics[j].no_of_question*1;


                        }
                        vm.subjects[i].subjectTotalQ = temp;
                    }

                    console.log('inside controller',vm.subjects);
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