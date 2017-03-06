/**
 * Created by spider-ninja on 6/4/16.
 */
(function () {
    'use strict';

    angular
        .module('app')
        .factory('CandidateService', CandidateService);

    CandidateService.$inject = ['$http'];

    function CandidateService($http) {
        var service = {};

        service.GetExams = GetExams;
        service.Create = Create;
        service.Update = Update;
        service.Delete = Delete;
        service.GetUserInstance = GetUserInstance;
        service.UpdateInstance = UpdateInstance;
        service.GetStatus = GetStatus;
        service.StartTest = StartTest;
        service.GetQuestion = GetQuestion;
        service.SubmitRespnse = SubmitRespnse;
        service.ShowResults = ShowResults;
        service.GetTopicMatter = GetTopicMatter;
        service.CheckOTP = CheckOTP;

        return service;



        function GetStatus(userMD5) {
            return $http
                .get('http://api.examhans.com/user/'+userMD5+'/status')
                .then(handleSuccess, handleError('Error getting all users'));
        }

        function GetTopicMatter(topicId) {
            return $http
                .get('http://api.examhans.com/topics/'+topicId+'/videos')
                .then(handleSuccess, handleError('Error getting all users'));
        }

        function ShowResults(userMD5,testId) {
            return $http
                .get('http://api.examhans.com/user/'+userMD5+'/test/'+testId+'/result')
                .then(handleSuccess, handleError('Error getting all users'));
        }

        function GetUserInstance(professionId,uType,month) {
            return $http
                .get('http://api.bulldog.shatkonlabs.com/profession/'+professionId+'/type/'+uType+"/instance?month=" +month)
                .then(handleSuccess, handleError('Error getting all users'));
        }





        function GetQuestion(userMd5,testId,id) {
            return $http.get('http://api.examhans.com/user/'+userMd5+'/test/'+testId+'/goto/' + id).then(handleSuccess, handleError('Error getting user by id'));
        }



        function GetExams(str) {
            return $http.get('http://api.examhans.com/exams' ).then(handleSuccess, handleError('Error getting user by username'));
        }

        function CheckOTP(userMd5,type,otp) {
            return $http.get('http://api.examhans.com/user/'+userMd5+'/verify/'+type+'/otp/'+otp ).then(handleSuccess, handleError('Error getting user by username'));
        }

        function Create(user) {
            return $http.post('http://api.examhans.com/user', user).then(handleSuccess, handleError('Error creating user'));
        }

        function Update(user) {
            return $http.put('http://api.shatkonjobs.com/candidates/' + user.id, user).then(handleSuccess, handleError('Error updating user'));
        }

        function UpdateInstance(instance) {
            return $http.post('http://api.bulldog.shatkonlabs.com/instance', instance).then(handleSuccess, handleError('Error updating user'));
        }

        function SubmitRespnse(userMd5,testId,responseId,instance) {
            ///user/:userMd5/test/:testId/question/:responseId
            return $http.post('http://api.examhans.com/user/'+userMd5+'/test/'+testId+'/question/'+responseId, instance).then(handleSuccess, handleError('Error updating user'));
        }

        function StartTest(userMd5, instance) {
            return $http.post('http://api.examhans.com/user/'+userMd5+'/test/', instance).then(handleSuccess, handleError('Error updating user'));
        }

        function Delete(id) {
            return $http.delete('/api/users/' + id).then(handleSuccess, handleError('Error deleting user'));
        }

        // private functions

        function handleSuccess(res) {
            return res.data;
        }

        function handleError(error) {
            return function () {
                return { success: false, message: error };
            };
        }
    }

})();
