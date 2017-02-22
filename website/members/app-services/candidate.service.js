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

        service.GetAll = GetAll;
        service.GetById = GetById;
        service.GetByManagerEmployeeId = GetByManagerEmployeeId;
        service.GetByUsername = GetByUsername;
        service.Create = Create;
        service.Update = Update;
        service.Delete = Delete;
        service.Search = Search;
        service.GetAllProfession = GetAllProfession;
        service.GetUserInstance = GetUserInstance;
        service.UpdateInstance = UpdateInstance;
        service.GetUserLast10Instance = GetUserLast10Instance;
        service.GetTodayUsage = GetTodayUsage;

        return service;

        function GetAll(company,manager,month) {
            return $http
                        .get('http://api.bulldog.shatkonlabs.com/companies/'+company+'/managers/'+manager+'/employees'+ "?month=" +month)
                        .then(handleSuccess, handleError('Error getting all users'));
        }

        function GetUserInstance(professionId,uType,month) {
            return $http
                .get('http://api.bulldog.shatkonlabs.com/profession/'+professionId+'/type/'+uType+"/instance?month=" +month)
                .then(handleSuccess, handleError('Error getting all users'));
        }

        function GetUserLast10Instance(userId,uType) {
            return $http
                .get('http://api.bulldog.shatkonlabs.com/instance/'+userId+'/last10')
                .then(handleSuccess, handleError('Error getting all users'));
        }

        function GetTodayUsage(userId) {
            return $http
                .get('http://api.bulldog.shatkonlabs.com/usage/'+userId)
                .then(handleSuccess, handleError('Error getting all users'));
        }

        function GetAllProfession() {
            return $http
                .get('http://api.shatkonjobs.com/professions')
                .then(handleSuccess, handleError('Error getting all users'));
        }

        function Search(userSearch) {

            console.log(userSearch);

            var conStr = "";
            if(userSearch.age != undefined) conStr += "&age=" + userSearch.age;
            if(userSearch.area != undefined) conStr += "&area=" + userSearch.area;
            if(userSearch.gender != undefined) conStr += "&gender=" + userSearch.gender;

            return $http
                .get('http://api.shatkonjobs.com/candidates/search?profession_id='
                                                        + userSearch.profession
                                                        + conStr
                )
                .then(handleSuccess, handleError('Error getting all users'));
        }

        function GetById(id) {
            return $http.get('/api/users/' + id).then(handleSuccess, handleError('Error getting user by id'));
        }

        function GetByManagerEmployeeId(id,month) {
            return $http.get('http://api.bulldog.shatkonlabs.com/companies/:company_id/managers/:manager_id/employees/' + id+ "?month=" +month).then(handleSuccess, handleError('Error getting user by id'));
        }

        function GetByUsername(username) {
            return $http.get('/api/users/' + username).then(handleSuccess, handleError('Error getting user by username'));
        }



        function Create(user) {
            return $http.post('http://api.shatkonjobs.com/candidates', user).then(handleSuccess, handleError('Error creating user'));
        }

        function Update(user) {
            return $http.put('http://api.shatkonjobs.com/candidates/' + user.id, user).then(handleSuccess, handleError('Error updating user'));
        }

        function UpdateInstance(instance) {
            return $http.post('http://api.bulldog.shatkonlabs.com/instance', instance).then(handleSuccess, handleError('Error updating user'));
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
