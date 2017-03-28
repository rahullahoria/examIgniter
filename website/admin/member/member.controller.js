(function () {
    'use strict';

    angular
        .module('app')
        .controller('MemberController', MemberController);

    MemberController.$inject = ['UserService', '$cookieStore', 'CandidateService', '$rootScope', 'FlashService','$location'];
    function MemberController(UserService, $cookieStore, CandidateService,  $rootScope, FlashService,$location) {
        var vm = this;

        vm.user = {};
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

        vm.currentShow = 0;

        //nd/d/p
        vm.loadType = ($location.search().t != undefined)?$location.search().t:'nd';

        initController();

        function initController() {
          //  loadCurrentUser();
           // loadAllUsers();

            //loadMonths();
            loadUser();
            loadToCallCandidates();

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




        vm.userDetails = function(index){
            vm.loadUserId = index;
            CandidateService.GetRemarks(vm.users[vm.loadUserId].mobile)
                .then(function (response) {
                    vm.comments = response.feedbacks;




                    console.log('inside controller',vm.comments);
                });
            $("#userModel").modal("show");
        };

        vm.writeAboutUser = function(user){

            CandidateService.AddRemark(user.username,
                {
                    "feedback":vm.user.feedback,
                    "digieye_user_id":1
                }
                )
                .then(function (response) {
                    vm.user.feedback = '';
                });

        };

        vm.sendFBShareLink = function(mobile,id){
            var text = "To get amount transferred inside your account.\nPlease Share Us\n";
            text += "http://www.facebook.com/sharer.php?u=http://examhans.com/story.php?t="+id;

            CandidateService.SendSMS(mobile,text).then(function (response) {
                alert("SMS sent: "+text);
                vm.user.feedback = 'SMS sent as : ' + text;
                vm.writeAboutUser({username:mobile});
            });

        }

        vm.inviteForTest = function(mobile){
            var text = "Hi! You have not completed your demo test.\nEarn Your 150Rs Now.\n";
            text += "https://examhans.com/members/#/?rt=demo";

            CandidateService.SendSMS(mobile,text).then(function (response) {
                alert("SMS sent: "+text);
                vm.user.feedback = 'SMS sent as : ' + text;
                vm.writeAboutUser({username:mobile});
            });

        }

        vm.askToBuy = function(mobile,index){
            var text = "Congratulation!\nFor Earning Rs."+vm.users[index].amount_made+" on Examhans.com\nKeep learning and earning\n Buy Our Premium Plans\nCheck @\n";
            text += "https://examhans.com/#plans";

            CandidateService.SendSMS(mobile,text).then(function (response) {
                alert("SMS sent: "+text);
                vm.user.feedback = 'SMS sent as : ' + text;
                vm.writeAboutUser({username:mobile});
            });

        }

        vm.askForRef = function(mobile){
            var text = "Hi!\nShare Demo Link bellow with your friends\nGet Free Silver Membership Plan\n";
            text += "https://examhans.com/members/#/?rt=demo&ref_user="+mobile;

            CandidateService.SendSMS(mobile,text).then(function (response) {
                alert("SMS sent: "+text);
                vm.user.feedback = 'SMS sent as : ' + text;
                vm.writeAboutUser({username:mobile});
            });

        }




        vm.loadToCallCandidates = loadToCallCandidates;

        vm.date1 = new Date().getDate();
        vm.getFun = function(work){
           return Math.floor((Math.random() * (work/60/60)) + (work/60/60/4));
        };



        function loadToCallCandidates(){
            vm.dataLoading = true;

            CandidateService.GetStatus(vm.loadType)
                .then(function (response) {
                    vm.users = response.users;




                    console.log('inside controller',vm.users);
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